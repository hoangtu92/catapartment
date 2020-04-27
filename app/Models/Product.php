<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'products';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function category(){
        return $this->belongsTo("App\Models\ProductCategory", 'category_id');
    }

    public function colors(){
        return $this->belongsToMany("App\Models\Color", "product_colors", "product_id", "color_id");
    }

    public function brand(){
        return $this->belongsTo("App\Models\Brand", "brand_id", "id");
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */

    public function getPermalinkAttribute(){
        return route("product_detail", ["slug" => $this->slug | $this->name]);
    }

    public function getColornameAttribute(){
        $colors = [];
        foreach ($this->colors as $color){
            $colors[] = $color->name;
        }

        return $colors;
    }

    public function getImagesAttribute(){

        if($this->attributes['images'] == null) return [];
        return json_decode($this->attributes['images']);
    }

    /*public function setImagesAttribute($images){
        $this->images = json_encode($images);
    }*/
}
