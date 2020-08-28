<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modal\Catagory;
use App\Modal\Serviceman;
use App\Helper\CheckData;
class ServicemanController extends Controller
{
    public function get(Request $request)
    {
        if ($request->view=='all') {
            $data= Serviceman::all();
            return CheckData::check($data);
        } else if ('location'===$request->view) {
            $lat=$request->lat;
            $lng=$request->lng;
            $radius=$request->radius??100;
            $data=[];
            if($request->cid) {
                $data=Serviceman::getByLocation($lat, $lng, $radius, $request->cid);
            } else {
                $data=Serviceman::getByLocation($lat, $lng, $radius);
            }
            
            return CheckData::check($data);

        } else if ($request->id) {
            $data = Serviceman::find($request->id);
            if($data) {
                if($data->status ==1) {
                    return CheckData::check($data);
                }
                return CheckData::check(null, "unverified user");    
            } 
            return CheckData::check($data);  
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

    public function add(Request $request)
    {
        $this->validate(
            $request, [
            'name'=>'string|required|max:255',
            'c_id'=>'integer|required|exists:catagories,id',
            'mobile'=>'digits:10|required',
            'price'=>'numeric|required',
            'email'=>'email',
            'image'=>'image',
            'address'=>'string|required',
            'description'=>'string',
            'lat'=>'numeric|required',
            'lng'=>'numeric|required'
            ]
        );
        $serviceman= new Serviceman;
        $imagePath='';
        if($request->hasFile('image')) {
            $original_filename = $request->file('image')->getClientOriginalName();
            $original_filename_arr = explode('.', $original_filename);
            $file_ext = end($original_filename_arr);
            $imageName=$request->name."_".time().".".$file_ext;
            $destinationPath='./upload/serviceman/';
            if($request->file('image')->move($destinationPath, $imageName)) {
                $imagePath='/upload/serviceman/' . $imageName;
            };
        }
        $serviceman->name=$request->name;
        $serviceman->status=0;
        $serviceman->image=$imagePath;
        $serviceman->c_id=$request->c_id;
        $serviceman->mobile=$request->mobile;
        $serviceman->price=$request->price??0;
        $serviceman->email=$request->email;
        $serviceman->address=$request->address;
        $serviceman->description=$request->description;
        $serviceman->latitude=$request->lat;
        $serviceman->longitude=$request->lng;
        try{
            $serviceman->save();
        }catch(Exeption $e){
            return \response(['message'=>'unable to save your adata'], 422);
        }
        return ['status'=>'success','message'=>'waiting for conformation your tracking number is '.$serviceman->id];

    }
}
