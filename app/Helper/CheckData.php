<?php
namespace App\Helper;
class CheckData
{
    private static $MESSAGE="request not found";
    public static function begnWith($str, $begnString) 
    {

        $len = strlen($begnString);
        return (substr($str, 0, $len) === $begnString);
    }
    public static function check($data,$isArray=null,$msg=null)
    {
        if($data) {
            if($isArray) {
                foreach ($data as $key => $item) {
                    if($item->image && CheckData::begnWith($item->image, "/")) {
                        $item->image=$_SERVER['APP_URL'].":".$_SERVER['SERVER_PORT'].$item->image;
                    }        
                    $data[$key]=$item;
                }
            }
            else if(array_key_exists('image', $data) && CheckData::begnWith($data['image'], "/")) {
                $data['image']=$_SERVER['APP_URL'].":".$_SERVER['SERVER_PORT'].$data['image'];
            }
            return response(['status'=>'success','data'=>$data], 200);
        } else {
            return response(['status'=>'failed','message'=>$msg??self::$MESSAGE], 404);
        }
    }
 
   
}