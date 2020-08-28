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
    public static function check($data,$msg=null)
    {
        if($data) {
            if(array_key_exists('image', $data) && CheckData::begnWith($data['image'], "/")) {
                $data['image']=$_SERVER['APP_URL'].":".$_SERVER['SERVER_PORT'].$data['image'];
            }
            return ['status'=>'success','data'=>$data];
        } else {
            return ['status'=>'failed','message'=>$msg??self::$MESSAGE];
        }
    }
 
   
}