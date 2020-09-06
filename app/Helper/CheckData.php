<?php
/**
 * Checks fetched data of user or catagory and response with appropriate 
 * status
 * 
 * PHP version: 7.0
 * 
 * @category ExtraClass
 * @package  Helper
 * @author   Adil Hussain <adil.cs.work@gmail.com>
 * @license  https://opensource.org/licenses/PHP-3.0 statdard
 * @link     https://github.com/adilcse/service-app-api/blob/master/app/Helper/CheckData.php
 */
namespace App\Helper;

/**
 * Check for valid response and give response with appropriate message
 *
 * @category ExtraClass
 * @package  Helper
 * @author   Adil Hussain <adil.cs.work@gmail.com>
 * @license  https://opensource.org/licenses/PHP-3.0 statdard
 * @link     https://github.com/adilcse/service-app-api/blob/master/app/Helper/CheckData.php
 */
class CheckData
{
    private static $_MESSAGE="request not found";
    /**
     * Check the string begins with a specified charecter set
     *
     * @param [type] $str        whole string to be checked
     * @param [type] $begnString string to be be matched
     * 
     * @return void
     */
    public static function begnWith($str, $begnString) 
    {

        $len = strlen($begnString);
        return (substr($str, 0, $len) === $begnString);
    }

    /**
     * Check for valid response 
     *
     * @param [type]    $data    to be checked
     * @param [boolean] $isArray if the input is array
     * @param [string]  $msg 
     * 
     * @return void
     */
    public static function check($data,$isArray=null,$msg=null)
    {
        if ($data) {
            return response(['status'=>'success','data'=>$data], 200);
        } else {
            return response(
                ['status'=>'failed','message'=>$msg??self::$_MESSAGE],
                404
            );
        }
    }
 
   
}