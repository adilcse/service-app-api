<?php

namespace App\Modal;

use Illuminate\Database\Eloquent\Model;


class Catagory extends Model
{
    protected $table='catagories';
    public function serviceman()
    {
        return $this->hasMany('App\Modal\Serviceman', 'c_id', 'id');
    }
}
