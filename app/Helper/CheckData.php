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
            return response(['status'=>'success','data'=>$data], 200);
        } else {
            return response(['status'=>'failed','message'=>$msg??self::$MESSAGE], 404);
        }
    }
 
   
}