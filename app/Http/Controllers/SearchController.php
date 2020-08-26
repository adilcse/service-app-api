<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modal\Serviceman;
use App\Modal\Catagory;
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
            $data= Serviceman::select('name', 'id', 'c_id', 'image', 'price')->where('name', 'like', '%'.$keyword.'%')
            ->orWhereHas(
                'catagory', function ($q) use ($keyword) {
                    return $q->where('name', 'like', '%'. $keyword . '%');
                }
            )->get();
            return $this->_checkData($data);
        }  else {
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
