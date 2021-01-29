<?php


namespace App\Classes;


use App\Models\Product;
use DateInterval;
use DateTime;
use Exception;
use Illuminate\Support\Facades\Log;
use SimpleXMLElement;

class ARCRMA
{
    public function __construct()
    {
        $this->ch = curl_init();
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->ch, CURLOPT_TIMEOUT, 100);
    }

    /**
     * @param $ExecUrl
     * @param SimpleXMLElement $doc
     * @return SimpleXMLElement
     */
    function sendXML($ExecUrl, SimpleXMLElement $doc)
    {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $ExecUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $doc->asXML());
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/xml",
            "Content-Length: " . strlen($doc->asXML()),
        ));
        $data = curl_exec($ch);

        if (curl_errno($ch)) {
            print curl_error($ch);

        } else {
            curl_close($ch);
        }
        Log::info($doc->asXML());
        Log::info($data);
        //return new SimpleXMLElement($data);
        return $data;
    }

    public function sendOrderForm($order){
        $url = "https://ordertest.esuntrade.com/Payment.aspx";
        $HASHKey = env("arcrma_hashkey"); //此為貴公司的hashkey值
        $channel_id = "tenpay";
        $email = $order->email;
        $ntd = $order->total_amount;

        $pname = $order->pname;
        $pno = $order->order_id; //$pno=date("Ymdhis");
        $receiver = $order->shipping_name;
        $return_url = route("arcrma_order_completed"); //此為交易完成後欲返回之頁面
        $seller_id = env("arcrma_store"); //此為貴公司的特店編號
        $ttime = date("Ymdhis");
        $validate_method = "sign";

        $pidn = "";
        $qtyn = "";
        foreach ($order->items as $item) {
            $pidn.=$item->product_id;//此為貴公司於後台上架的產品編號，須存在於後台才能進行交易。
            $qtyn.=$item->qty;
        }
        $count = count($order->items);

        $ship_addr = $order->shipping_address;
        $area_code = $order->shipping_zipcode;
        $tel = $order->shipping_phone;

        $pdesc = "";
        $timeout_rule = "12h";

        $pcode = SHA1($area_code. $channel_id . $count . $email . $ntd . $pidn . $pname . $pno . $qtyn . $receiver . $return_url . $seller_id . $ship_addr. $tel. $ttime . $validate_method . $HASHKey);

        $postData = [
            "seller_id" => $seller_id,
            "pno" => $pno,
            "ntd" => $ntd,
            "ttime" => $ttime,
            "validate_method" => $validate_method,
            "count" => $count,
            "return_url" => $return_url,
            "receiver" => $receiver,
            "ship_addr" => $ship_addr,
            "area_code" => $area_code,
            "tel" => $tel,
            "email" => $email,
            "pname" => $pname,
            "pcode" => $pcode,
            "channel_id" => $channel_id,
        ];

        foreach($order->items as $index => $item){
            $postData["pid".$index] = $item->product_id;
            $postData["qty".$index] = $item->qty;
        }

        // creating object of SimpleXMLElement
        $xml_data = new SimpleXMLElement('<?xml version="1.0" encoding="utf-8" standalone="yes"?><Payment></Payment>');

        // function call to convert array to xml
        self::array_to_xml($postData, $xml_data);

        return self::sendXML($url, $xml_data);
    }

    public function sendOrderForm2($order)
    {
        $url = env("arcrma_order_url");
        $HASHKey = env("arcrma_hashkey"); //此為貴公司的hashkey值
        $channel_id = "alipay";
        $email = $order->email;
        $ntd = $order->total_amount;

        $pname = $order->pname;
        $pno = $order->order_id; //$pno=date("Ymdhis");
        $receiver = $order->shipping_name;
        $return_url = route("arcrma_order_completed"); //此為交易完成後欲返回之頁面
        $seller_id = env("arcrma_store"); //此為貴公司的特店編號
        $ttime = date("Ymdhis");
        $validate_method = "sign";

        $pidn = "";
        $qtyn = "";
        foreach ($order->items as $item) {
            $pidn.=$item->product_id;//此為貴公司於後台上架的產品編號，須存在於後台才能進行交易。
            $qtyn.=$item->qty;
        }
        $count = count($order->items);

        $ship_addr = $order->shipping_address;
        $area_code = $order->shipping_zipcode;
        $tel = $order->shipping_phone;

        $pdesc = "";
        $timeout_rule = "12h";

        $pcode = SHA1($area_code. $channel_id . $count . $email . $ntd . $pidn . $pname . $pno . $qtyn . $receiver . $return_url . $seller_id . $ship_addr. $tel. $ttime . $validate_method . $HASHKey);

        return view("frontend.payment.new_order")->with(compact("order", "ship_addr", "area_code", "seller_id", "url", "pno", "ntd", "ttime", "validate_method", "count", "return_url", "receiver", "email", "pname", "tel",  "pcode"));
    }


    function array_to_xml($data, SimpleXMLElement &$xml_data)
    {
        foreach ($data as $key => $value) {
            if (is_numeric($key)) {
                $key = 'item' . $key; //dealing with <0/>..<n/> issues
            }
            if (is_array($value)) {
                $subnode = $xml_data->addChild($key);
                self::array_to_xml($value, $subnode);
            } else {
                $xml_data->addChild("$key", htmlspecialchars("$value"));
            }
        }
    }

    /**
     * @param Product $product
     * @param string $action
     * @return SimpleXMLElement
     * @throws Exception
     */
    public function updateProduct(Product $product, $action = "new")
    {
        ///	basic configure

        //$cRqstUrl = 'https://api.arcrma.com//Product.aspx';
        $cRqstUrl = 'https://apitest.esuntrade.com/Product.aspx';

        $seller_id = env("arcrma_store");
        $outer_id = $product->id; //'2020110301';

        $postData = array(
            "action" => $action,
            "seller_id" => $seller_id,
            "outer_id" => $outer_id,
        );

        if($action != "delete"){
            date_default_timezone_set('Asia/Taipei');
            $date = new DateTime('now');
            $dateExpire = new DateTime('now');
            $dateExpire->add(new DateInterval('PT2H'));

            $title = $product->name;    //.$date->format('YmdHiss');
            $scids = '1';
            $href = $product->permalink;
            $price = $product->realPrice;
            $weight = '1';
            $length = '1';
            $height = '1';//GetNonce();
            $width = '1';
            $shipmode = '0';
            $modified = $date->format('YmdHiss');

            $postData = array_merge($postData, array(
                "title" => $title,
                "scids" => $scids,
                "href" => $href,
                "price" => $price,
                "weight" => $weight,
                "length" => $length,
                "height" => $height,
                "width" => $width,
                "shipmode" => $shipmode, //optional
                "modified" => $modified, //optional
            ));
        }


        // creating object of SimpleXMLElement
        $xml_data = new SimpleXMLElement('<?xml version="1.0" encoding="utf-8" standalone="yes"?><Product></Product>');

        // function call to convert array to xml
        self::array_to_xml($postData, $xml_data);

        return self::sendXML($cRqstUrl, $xml_data);
    }



}
