<?php


namespace App;

use Illuminate\Database\Eloquent\Model;


class ExpireModel extends Model {

    public function isVisible() {
        return $this->display
               || ( ! is_null( $this->valid_from )
                    && ! is_null( $this->valid_until )
                    && now() >= date_create( $this->valid_from )
                    && now() <= date_create( $this->valid_until ) );
    }

    public static function getVisibleList(){
        return self::where("display", true)
            ->orWHere(function ($query){
                $query->whereNotNull("valid_from")
                    ->whereNotNull("valid_until")
                    ->where("valid_from", "<=", now())
                    ->where("valid_until", ">=", now());
            })
            ->get();
    }

}
