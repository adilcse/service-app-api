<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modal\Slider;
use App\Helper\CheckData;
class SliderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }
    public function get(Request $request)
    {
        if ($request->view=='all') {
            $cats= Slider::limit(5)->get();
            return CheckData::check($cats, true);
        } else if ($request->id) {
            $cat = Slider::find($request->id);
            return CheckData::check($cat, false);
        } else {
            return  CheckData::check(null);
        }
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
