<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CustomizedProduct;
use App\Models\Frame;
use App\Models\Product;
use Backpack\Settings\app\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class ApiController extends Controller
{
    //

    public function getProducts(Request $request){
        $perPage = $request->filled("perPage") ? (int) $request->input("perPage") : 9;
        $orderBy = $request->filled("orderBy") ? $request->input("orderBy") : 'id';
        $order = $request->filled("order") ? $request->input("order") : 'asc';
        $page = $request->filled("page") ? $request->input("page") : 1;

        if($request->filled("sort")){
            $order = "desc";

            if($request->input("sort") == "latest"){
                $orderBy = "id";
            }

            if($request->input("sort") == "populated"){
                $orderBy = "view";
            }

        }

        $where = ["type = '".NORMAL."'" ,];

        if($request->filled("category_id")){
            $where[] = "category_id = {$request->input("category_id")}";
        }

        if($request->filled("min") && $request->filled("max")){
            $where[] = "sale_price >= {$request->input("min")}";
            $where[] = "sale_price <= {$request->input("max")}";
        }


        if($request->filled("brands_arr") && count($request->input("brands_arr")) > 0){
            $orWhere = [];
            foreach ($request->input("brands_arr") as $item){
                if($item == null) continue;

                $orWhere[] = "brand_id = {$item}";
            }

            $where[] = "(".implode(" OR ", $orWhere).")";

        }

        if($request->filled("origins_arr") && count($request->input("origins_arr")) > 0){
            $orWhere = [];
            foreach ($request->input("origins_arr") as $item){
                if($item == null) continue;
                $orWhere[] = "origin_id = {$item}";
            }

            $where[] = "(".implode(" OR ", $orWhere).")";

        }

        if($request->filled("pieces_arr") && count($request->input("pieces_arr")) > 0){
            $orWhere = [];
            foreach ($request->input("pieces_arr") as $item){
                if($item == null) continue;
                $orWhere[] = "piece_id = {$item}";
            }

            $where[] = "(".implode(" OR ", $orWhere).")";

        }

        $whereConcat = "(".implode(" AND ", $where).")";

        $products = Product::whereRaw("{$whereConcat}");

        $total_items = $products->count();
        $products = $products->orderBy($orderBy, $order)->offset(($page-1)*$perPage)->take($perPage)->get();

        //echo $whereConcat;


        echo json_encode([
            'page' => $page,
            'perPage' => $perPage,
            "items" => $products->toArray(),
            'total_items' => $total_items
        ]);


    }

    public function getFrames()
    {
        $frames = Product::where("type", FRAME)->get()->toJson();
        echo $frames;
    }

    public function getShippingFee()
    {
        $shipping_fee = Setting::get("shipping_fee");
        echo $shipping_fee;
    }

    public function create_customized_product(Request $request)
    {
        try {
            $this->validate($request, [
                'frame_id' => 'required',
                'thickness' => 'required',
                'total_length' => 'required'
            ]);

            $frame = Product::find($request->input("frame_id"));
            $frame->thickness = $request->input("thickness");
            $frame->total_length = $request->input("total_length");

            echo $frame->toJson();

        } catch (ValidationException $e) {
            Log::info($e->getMessage());
            echo json_encode([
                'status' => false,
                'error' => $e->getMessage()
            ]);
        }
    }
}
