<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modal\Catagory;
use App\Modal\Serviceman;
class ServicemanController extends Controller
{
    public function get(Request $request)
    {
        if ($request->view=='all') {
            $data= Serviceman::all();
            return $this->_checkData($data);
        } else if ('location'===$request->view) {
            $lat=$request->lat;
            $lng=$request->lng;
            $radius=$request->radius;
            $data=[];
            if($request->cid) {
                $data=Serviceman::getByLocation($lat, $lng, $radius, $request->cid);
            }else {
                $data=Serviceman::getByLocation($lat, $lng, $radius);
            }
            
            return $this->_checkData($data);

        } else if ($request->id) {
            $data = Serviceman::find($request->id);
            return $this->_checkData($data);
        } else if($request->catagory) {
            $data = Catagory::find($request->catagory);
            return $this->_checkData($data->serviceman);
        }
            return $this->_checkData(null);
    }

    private function _checkData($data)
    {
        if($data) {
            return ['status'=>'success','data'=>$data];
        } else {
            return ['status'=>'failed','message'=>'request not found'];
        }
    }
}
