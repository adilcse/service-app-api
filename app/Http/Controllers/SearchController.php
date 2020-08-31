<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modal\Serviceman;
use App\Modal\Catagory;
use App\Helper\CheckData;

class SearchController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }
    public function search(Request $request)
    {
        if ($request->q) {
            $keyword=$request->q;
            $data= Serviceman::select('*')->where('name', 'like', '%'.$keyword.'%')
                ->where('status', 1)
                ->limit(10)
                ->get();
            return CheckData::check($data, true);
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
