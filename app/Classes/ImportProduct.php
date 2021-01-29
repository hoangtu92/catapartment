<?php


namespace App\Classes;


use App\Models\Brand;
use App\Models\Origin;
use App\Models\Piece;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ImportProduct
{

    public static function import($file_name){
        $reader = IOFactory::createReader('Xlsx');
        $reader->setReadDataOnly(TRUE);

        $spreadsheet = $reader->load(resource_path("/source/{$file_name}"));
        $sheet = $spreadsheet->getActiveSheet();

        $mapper = [
            "A"=> "name",
            "B" => "keywords",
            "C" => "category_id",
            "D" => "sku",
            /*"E" => "slug",*/
            "F" => "barcode",
            "G" => "status",
            "H" => "price",
            "I" => "measures",
            "J" => "origin_id",
            "K" => "piece_value",
            "L" => "brand_id"
        ];

        $products = [];

        foreach ($sheet->getRowIterator() as $index => $row) {

            if($index <= 1) continue;


            $products[$index] = [];

            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(FALSE); // This loops through all cells,
            //    even if a cell value is not set.
            // By default, only cells that have a value
            //    set will be iterated.
            foreach ($cellIterator as $j => $cell) {
                if(isset($mapper[$j])) {

                    if (!empty($cell->getValue())) {
                        $products[$index][$mapper[$j]] = $cell->getValue();

                        switch ($mapper[$j]) {

                            case "sku":
                            case "barcode":

                                $new = true;
                                if(isset($products[$index]["image"]) && $products[$index]["image"]){
                                    $filename = $products[$index]["image"];
                                    if(file_exists(public_path($filename))){
                                        $new = false;
                                    }
                                }

                                if($new){
                                    $filename = "/uploads/products/{$cell->getValue()}.jpg";
                                    if (!file_exists(public_path($filename))) {
                                        $filename = "/uploads/products/{$cell->getValue()}.png";

                                        if (!file_exists(public_path($filename))) {
                                            $filename = "/uploads/products/{$cell->getValue()}.webp";

                                            if (!file_exists(public_path($filename))) {
                                                $filename = "/uploads/products/{$cell->getValue()}.gif";

                                                if (!file_exists(public_path($filename))) {
                                                    $filename = "/uploads/products/{$cell->getValue()}.bmp";
                                                }
                                            }
                                        }

                                    }

                                    $products[$index]["image"] = $filename;
                                }

                                break;
                            case "category_id":

                                $category = ProductCategory::where("name", $cell->getValue())->first();
                                if (!$category) {
                                    $category = new ProductCategory([
                                        "name" => $cell->getValue(),
                                        "icon" => "/images/cat-icon01.png"
                                    ]);
                                    $category->save();
                                }
                                $products[$index][$mapper[$j]] = $category->id;


                                break;
                            case "status":
                                switch ($cell->getValue()) {
                                    case "現貨":
                                        $status = IN_STOCK;
                                        $products[$index]["stock"] = 100;
                                        break;
                                    default:
                                        $status = PRE_ORDER;
                                        break;
                                }
                                $products[$index][$mapper[$j]] = $status;

                                break;
                            case "origin_id":
                                $origin = Origin::where("name", $cell->getValue())->first();
                                if (!$origin) {
                                    $origin = new Origin([
                                        "name" => $cell->getValue(),
                                        "icon" => "/images/country-icon01.png"
                                    ]);
                                    $origin->save();
                                }
                                $products[$index][$mapper[$j]] = $origin->id;
                                break;
                            case "piece_value":

                                $name = "";
                                if ($cell->getValue() <= 100) {
                                    $name = "～100 片";
                                } elseif ($cell->getValue() <= 300) {
                                    $name = "101～300 片";
                                } elseif ($cell->getValue() <= 500) {
                                    $name = "301~500 片";
                                } elseif ($cell->getValue() <= 800) {
                                    $name = "501片~800 片";
                                } elseif ($cell->getValue() <= 1000) {
                                    $name = "801~1,000 片";
                                } elseif ($cell->getValue() <= 1200) {
                                    $name = "1,001~1,200 片";
                                } elseif ($cell->getValue() <= 1500) {
                                    $name = "1,201~1,500 片";
                                } elseif ($cell->getValue() <= 2000) {
                                    $name = "1,501~2,000 片";
                                } elseif ($cell->getValue() > 2000) {
                                    $name = "2,000片以上";
                                }

                                $piece = Piece::where("name", $name)->first();
                                if (!$piece) {
                                    $piece = new Piece([
                                        "name" => $name,
                                        "icon" => "/images/country-icon01.png"
                                    ]);
                                    $piece->save();
                                }
                                $products[$index]["piece_id"] = $piece->id;
                                break;
                            case "brand_id":
                                $brand = Brand::where("name", $cell->getValue())->first();
                                if (!$brand) {
                                    $brand = new Brand([
                                        "name" => $cell->getValue(),
                                        "logo" => "",
                                        "country" => "",
                                        "description" => ""
                                    ]);
                                    $brand->save();
                                }
                                $products[$index][$mapper[$j]] = $brand->id;
                                break;
                            default:
                                break;

                        }
                    }
                }

            }

            if(!empty($products[$index]['name'])){

                Log::info($products[$index]['name']."\n");

                //$products[$index]['slug'] = mb_substr($products[$index]['slug'], 0, 255);

                $products[$index]["slug"] = md5($products[$index]["name"] . $products[$index]["barcode"]);

                $exists = Product::where("slug", $products[$index]['slug'])->first();
                if($exists){

                    $exists->update($products[$index]);

                    #$products[$index]['slug'] = mb_substr($products[$index]['slug'], 0, 249);

                    #$products[$index]['slug'] .= "-".str_pad(rand(0,999), 5, "0", STR_PAD_LEFT);

                }
                else{
                    Product::create($products[$index]);
                }



            }




        }
    }
}
