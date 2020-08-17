<?php


namespace App\Classes;


use App\Models\OrderItem;
use DOMDocument;
use Illuminate\Support\Facades\Log;

class ARCRMA
{

    private $ch;

    public function __construct(){
        $this->ch = curl_init();
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->ch, CURLOPT_TIMEOUT, 100);
    }

    function SendProductInfo($ExecUrl, $doc ){

        $headers = array(
            "Content-type: text/xml"
        ,"Content-length: ".strlen($doc->saveXML())
        ,"Connection: close"
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $ExecUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 100);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $doc->saveXML());
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $data = curl_exec($ch);

        if(curl_errno($ch)){
            print curl_error($ch);
        }else{
            curl_close($ch);
        }


        Log::info(date("Y-m-d H:i:s"));
        Log::info($ExecUrl);
        Log::info($doc->saveXML());
        Log::info($data);


        return $data;
    }

    public function get($url, $params, $headers = []){
        curl_setopt($this->ch, CURLOPT_URL, $url."?".http_build_query($params));
        curl_setopt($this->ch, CURLOPT_POST, false);
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
        $data = curl_exec($this->ch);

        if(curl_errno($this->ch)){
            print curl_error($this->ch);
        }else{
            curl_close($this->ch);
        }

        return $data;
    }


    public function post($url, $data, $headers = []){
        curl_setopt($this->ch, CURLOPT_URL, $url);
        curl_setopt($this->ch, CURLOPT_POST, true);
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
        $data = curl_exec($this->ch);

        if(curl_errno($this->ch)){
            print curl_error($this->ch);
        }else{
            curl_close($this->ch);
        }

        return $data;
    }


    public function sendOrder($order){
        $StoreId = env("arcrma_store");
        $OrderNo = $order->order_id; //���a�q��s�� ex: 120323121514
        $OrderName = "CatsApartment's order";
        $ReturnUrl = route("arcrma_order_completed"); //��I�_�^�����}
        $OrderTime = date("YmdHis"); // �������ɶ� ex: 20120323123142

        $orderItems = OrderItem::where("order_id", $order->id)->get();

        $ProductList = [];
        if($orderItems)
            foreach ($orderItems as $item){
                $ProductList[] = [
                    'ProductId' => $item->product_id,
                    'ProductQty' => (int) $item->qty,
                    'ProductPrice' => (int) $item->price
                ];
            }

        // �]�w�ӫ~���}�Ѽ�
        $ProductUrlArg = ""; //�ӫ~���}�Ѽ� ex: &pid0=00001&qty0=1&pid1=00002&qty1=2
        $ProductCount = count($ProductList); //�ӫ~�`��
        $ProductAmount = 0; //����`���B
        for($i=0; $i<count($ProductList); $i++) {
            $ProductUrlArg = $ProductUrlArg . "&pid" . $i . "=" . $ProductList[$i]['ProductId']; //�հӫ~�s���Ѽ�
            $ProductUrlArg = $ProductUrlArg . "&qty" . $i . "=" . $ProductList[$i]['ProductQty']; //�ռƶq�Ѽ�
            $ProductAmount = $ProductAmount + ($ProductList[$i]['ProductPrice'] * $ProductList[$i]['ProductQty']) ; //�p���`���B
        }

        // �إߥ�������ˬd�s�X,�N�S���N�X,���a�q��s��,����`���B,��I�_�^�����},�������ɶ���md5�s�X
        $md5_code = md5($StoreId.$OrderNo.$ProductAmount.$ReturnUrl.$OrderTime);

        $url = env("TEST_MODE") ? "https://ordertest.esuntrade.com/Payment.aspx" : "http://eorder.arcrma.com/Payment.aspx";

        $url .= "?action=order&seller_id=".$StoreId."&pno=".$OrderNo."&ntd=".$ProductAmount."&return_url=".$ReturnUrl."&pcode=".$md5_code."&pname=".$OrderName."&ttime=".$OrderTime."&count=".$ProductCount.$ProductUrlArg;

        return $url;
    }

    public function newProduct($product){
        // �]�w�Ѽ�
        //$ServerPage = "https://apitest.esuntrade.com/Product.aspx";
        $ServerPage = "http://api.arcrma.com/Product.aspx";
        $Action = "new"; //����ʧ@
        $StoreId = env("arcrma_store"); //�S���s��
        $ProductId = $product->id; //�ӫ~�s��
        $ProductName = $product->name; //�ӫ~�W��
        $ProductType = "1"; //�ӫ~�����N��
        $ProductUrl = $product->permalink; //�ӫ~�s�����}
        $ProductPrice = $product->realPrice; //�ӫ~����
        $ProductWeight = "0"; //�ӫ~���q
        $ProductLength = "0"; //�ӫ~����
        $ProductHeight = "0"; //�ӫ~����
        $ProductWidth = "0"; //�ӫ~�e��
        $ShipMode = "1"; //�B�O�Ҧ� 0:�K�B�O(�ӫ~���e���M���q����0) 1:�n�B�O(�ӫ~���e���M���q���i���ŭ�)
        if ($ShipMode == "0"){
            $ProductWeight = "0"; //�ӫ~���q
            $ProductLength = "0"; //�ӫ~����
            $ProductHeight = "0"; //�ӫ~����
            $ProductWidth = "0"; //�ӫ~�e��
        }
        $ModifyDate = date("Y-m-d") . "T" . date("H:i:s") . "+08:00"; //���ʤ���ɶ�
        $ExecUrl = $ServerPage . "?action=" . $Action . "&Seller_id=" . $StoreId; //������}

        // �إ�XML
        $doc = new DOMDocument('1.0','utf-8');
        $doc->xmlStandalone = true;
        $doc->formatOutput = true;

        $r = $doc->createElement( "Product" );
        $doc->appendChild( $r );

        $xProductSellerId = $doc->createElement( "seller_id" );
        $xProductSellerId->appendChild($doc->createTextNode( $StoreId ));
        $r->appendChild( $xProductSellerId );

        $xProductId = $doc->createElement( "outer_id" );//�ӫ~�s��
        $xProductId->appendChild($doc->createTextNode( $ProductId ));
        $r->appendChild( $xProductId );

        $xProductName = $doc->createElement( "title" ); //�ӫ~�W��
        $xProductName->appendChild($doc->createTextNode( $ProductName ));
        $r->appendChild( $xProductName );

        $xProductType = $doc->createElement( "scids" ); //�ӫ~�����N��
        $xProductType->appendChild($doc->createTextNode( $ProductType ));
        $r->appendChild( $xProductType );

        $xProductUrl = $doc->createElement( "href" ); //�ӫ~�s�����}
        $xProductUrl->appendChild($doc->createTextNode( $ProductUrl ));
        $r->appendChild( $xProductUrl );

        $xProductPrice = $doc->createElement( "price" ); //�ӫ~����
        $xProductPrice->appendChild($doc->createTextNode( $ProductPrice ));
        $r->appendChild( $xProductPrice );

        $xProductWeight = $doc->createElement( "weight" ); //�ӫ~���q
        $xProductWeight->appendChild($doc->createTextNode( $ProductWeight ));
        $r->appendChild( $xProductWeight );

        $xProductLength = $doc->createElement( "length" ); //�ӫ~����
        $xProductLength->appendChild($doc->createTextNode( $ProductLength ));
        $r->appendChild( $xProductLength );

        $xProductHeight = $doc->createElement( "height" ); //�ӫ~����
        $xProductHeight->appendChild($doc->createTextNode( $ProductHeight ));
        $r->appendChild( $xProductHeight );

        $xProductWidth = $doc->createElement( "width" ); //�ӫ~�e��
        $xProductWidth->appendChild($doc->createTextNode( $ProductWidth ));
        $r->appendChild( $xProductWidth );

        $xShipMode = $doc->createElement( "shipmode" ); //�B�O�Ҧ�
        $xShipMode->appendChild($doc->createTextNode( $ShipMode ));
        $r->appendChild( $xShipMode );

        $xModifyDate = $doc->createElement( "modified" ); //���ʤ���ɶ�
        $xModifyDate->appendChild($doc->createTextNode( $ModifyDate ));
        $r->appendChild( $xModifyDate );

        // �ǰe��T�ܤ�I�_����
        $data = $this->SendProductInfo($ExecUrl, $doc);

        return $data;
    }

    public function newOrder($order){

        $url = "http://eorder.arcrma.com/Payment.aspx";
        $HASHKey = env("arcrma_hashkey"); //此為貴公司的hashkey值
        $pno = $order->order_id;
        $seller_id = env("arcrma_store"); //此為貴公司的特店編號
        $validate_method = "sign";
        $ntd = $order->total_amount;
        $return_url = route("arcrma_order_completed"); //此為交易完成後欲返回之頁面
        $ttime = date("Ymdhis");
        $pname = $order->pname;
        $tel = $order->shipping_phone;
        $tel2 = "456456";
        $pdesc="test";
        $timeout_rule = "12h";
        $receiver = $order->shipping_name;
        $ship_addr = $order->shipaddr;
        $email = $order->email;
        $count = "1";
        $pcode = SHA1($count . $ntd . $pid0 . $pname . $pno . $qty0 . $receiver . $return_url . $seller_id . $ttime . $validate_method . $HASHKey);

        $orderItems = OrderItem::where("order_id", $order->id)->get();


        return view("frontend.payment.new_order", compact("url", "seller_id", "pno", "ntd", "ttime", "validate_method", "count", "orderItems", "return_url", "receiver", "pname", "pcode", "email"));
    }


}
