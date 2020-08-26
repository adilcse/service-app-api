<?php

namespace App\Modal;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;
class Serviceman extends Model
{
    protected $table='serviceman';

    public function catagory()
    {
        return $this->belongsTo('App\Modal\Catagory', 'c_id');
    }
    public static function getByLocation($latitude,$longitude,$radius=100,$cid=null)
    {
        /** 
        * using eloquent approach, make sure to replace the "Restaurant" with your actual model name
        * replace 6371000 with 6371 for kilometer and 3956 for miles
        */
        $data = Serviceman::selectRaw(
            "* ,
                        ( 6371 * acos( cos( radians(?) ) *
                          cos( radians( latitude ) )
                          * cos( radians( longitude ) - radians(?)
                          ) + sin( radians(?) ) *
                          sin( radians( latitude ) ) )
                        ) AS distance", [$latitude, $longitude, $latitude]
        )->where(
            function ($query) use ($cid) {
                if($cid) {
                    return $query->where('c_id', $cid);
                }else {
                    return true;
                }
            }
        )
           ->having("distance", "<", $radius)
           ->orderBy("distance", 'asc')->get();
            return $data;
    }

}
