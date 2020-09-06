<?php
/**
 * Handel Serviceman post and get request
 * 
 * PHP version: 7.0
 * 
 * @category Controller
 * @package  Http/Controllers
 * @author   Adil Hussain <adil.cs.work@gmail.com>
 * @license  https://opensource.org/licenses/PHP-3.0 statdard
 * @link     https://github.com/adilcse/service-app-api/blob/master/app/Http/Controllers/ServicemanController.php
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modal\Catagory;
use App\Modal\Serviceman;
use App\Helper\CheckData;

/**
 * Serviceman post and get request
 *
 * @category Controller
 * @package  Http/Controllers
 * @author   Adil Hussain <adil.cs.work@gmail.com>
 * @license  https://opensource.org/licenses/PHP-3.0 statdard
 * @link     https://github.com/adilcse/service-app-api/blob/master/app/Http/Controllers/ServicemanController.php
 */
class ServicemanController extends Controller
{
    /**
     * Handel get request 
     * Gives all serviceman if view=all
     * Search by location and specified radius
     *
     * @param Request $request http request 
     * 
     * @return void
     */
    public function get(Request $request)
    {
        //gets all records
        if ($request->view=='all') {
            $data= Serviceman::all();
            return CheckData::check($data);
            //get records by location
        } else if ('location'===$request->view) {
            $lat=$request->lat;
            $lng=$request->lng;
            $radius=$request->radius??$_ENV['RADIUS'];
            $data=[];
            //get records of a specified catagory
            if ($request->cid) {
                $data=Serviceman::getByLocation($lat, $lng, $radius, $request->cid);
            } else {
                $data=Serviceman::getByLocation($lat, $lng, $radius);
            }
            
            return CheckData::check($data, true);
            //get a perticular record by its id
        } else if ($request->id) {
            $data = Serviceman::find($request->id);
            if ($data) {
                if ($data->status ==1) {
                    return CheckData::check($data);
                }
                return CheckData::check(null, null, "unverified user");    
            } 
            return CheckData::check($data);  
        } else if ($request->catagory) {
            $data = Catagory::find($request->catagory);
            return CheckData::check(
                $data->serviceman()->where('status', "1")->get(),
                true
            );
        }
            return CheckData::check(null);
    }

    /**
     * Gives status of a serviceman if track id and mobile number is correct
     *
     * @param Request $request http request
     * 
     * @return void
     */
    public function status(Request $request)
    {
        $this->validate(
            $request,
            [
            'id'=>'exists:serviceman',
            'mobile'=>'string'
            ]
        );
        $serviceman=Serviceman::find($request->id);
        if ($serviceman->mobile == $request->mobile) {
            return \response(
                [
                    'status'=>'success',
                    'data'=>[
                        'id'=>$serviceman->id,
                        'catagory'=>$serviceman->catagory->name,
                        'name'=>$serviceman->name,
                        'mobile'=>$serviceman->mobile,
                        'status'=>$serviceman->status,
                        'registered_at'=>$serviceman->created_at,
                        'updated_at'=>$serviceman->updated_at]
                    ],
                200
            );
        }
        return \response(
            ['status'=>'failed','message'=>"mobile number does not matched",
            ], 
            403
        );
    }


    /**
     * Add a new record in the database
     * Post request
     *
     * @param Request $request http request with specifed parameter
     *
     * @return void
     */
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
        if ($request->hasFile('image')) {
            $original_filename = $request->file('image')->getClientOriginalName();
            $original_filename_arr = explode('.', $original_filename);
            $file_ext = end($original_filename_arr);
            $imageName=$request->name."_".time().".".$file_ext;
            $destinationPath='./upload/serviceman/';
            if ($request->file('image')->move($destinationPath, $imageName)) {
                $imagePath=$_ENV['APP_URL'].'/upload/serviceman/' . $imageName;
            };
        }
        $serviceman->name=$request->name;
        $serviceman->status=0; // change this to 0 in production
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
            return \response(['message'=>'unable to save your data'], 422);
        }
        return response(
            [
                'status'=>'success',
                'message'=>'waiting for conformation, your tracking number is ',
                "id"=>$serviceman->id
            ], 200
        );
    }
}
