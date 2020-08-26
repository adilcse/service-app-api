<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modal\Catagory;
class CatagoriesController extends Controller
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
            $cats= Catagory::all();
            return $this->_checkData($cats);
        } else if ($request->id) {
            $cat = Catagory::find($request->id);
            return $this->_checkData($cat);
        } else {
            return $this->_checkData(null);
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
