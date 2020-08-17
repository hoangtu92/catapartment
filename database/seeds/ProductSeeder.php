<?php

use App\Models\Brand;
use App\Models\Origin;
use App\Models\Piece;
use App\Models\ProductCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $reader = IOFactory::createReader('Xlsx');

        $reader->setReadDataOnly(TRUE);
        $spreadsheet = $reader->load(resource_path("/source/products.xlsx"));
        $sheet = $spreadsheet->getActiveSheet();

        $mapper = [
            "A"=> "name",
            "B" => "keywords",
            "C" => "category_id",
            "D" => "sku",
            "E" => "slug",
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
                if(isset($mapper[$j])){

                    $products[$index][$mapper[$j]] = $cell->getValue();

                    switch($mapper[$j]){
                        case "barcode":
                            $products[$index]["image"] = "/uploads/products/{$cell->getValue()}.jpg";
                            $products[$index]["slug"] = "P{$cell->getValue()}";
                            break;
                        case "category_id":
                            $category = ProductCategory::where("name", $cell->getValue())->first();
                            if(!$category){
                                $category = new ProductCategory([
                                    "name" => $cell->getValue(),
                                    "icon" => "/images/cat-icon01.png"
                                ]);
                                $category->save();
                            }
                            $products[$index][$mapper[$j]] = $category->id;
                            break;
                        case "status":
                            switch($cell->getValue()){
                                case "現貨":
                                    $status = IN_STOCK;
                                    break;
                                default:
                                    $status = PRE_ORDER;
                                    break;
                            }
                            $products[$index][$mapper[$j]] = $status;

                            break;
                        case "origin_id":
                            $origin = Origin::where("name", $cell->getValue())->first();
                            if(!$origin){
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
                            if($cell->getValue() <= 100){
                                $name = "～100 片";
                            }
                            elseif($cell->getValue() <= 300){
                                $name = "101～300 片";
                            }
                            elseif($cell->getValue() <= 500){
                                $name = "301~500 片";
                            }
                            elseif($cell->getValue() <= 800){
                                $name = "501片~800 片";
                            }
                            elseif($cell->getValue() <= 1000){
                                $name = "801~1,000 片";
                            }
                            elseif($cell->getValue() <= 1200){
                                $name = "1,001~1,200 片";
                            }
                            elseif($cell->getValue() <= 1500){
                                $name = "1,201~1,500 片";
                            }
                            elseif($cell->getValue() <= 2000){
                                $name = "1,501~2,000 片";
                            }
                            elseif($cell->getValue() > 2000){
                                $name = "2,000片以上";
                            }

                            $piece = Piece::where("name", $name)->first();
                            if(!$piece){
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
                            if(!$brand){
                                $brand = new Brand([
                                    "name" => $cell->getValue(),
                                    "logo" => "",
                                    "country"=> "",
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

            DB::table("products")->insert($products[$index]);

        }


    }
}
