<?php

namespace App\Http\Controllers;

use function PHPUnit\Framework\isNumeric;
use function PHPUnit\Framework\isString;

class ControllerVerification extends Controller
{
    static public function check_number($num=0){
        if(is_null($num) || empty($num) || !isNumeric($num)){
            return 0;
        }else{
            return $num;
        }
    }
    static public function check_string($str=''){
        if(is_null($str) || empty($str) || !isString($str)){
            return '';
        }else{
            return $str;
        }
    }
    static public function check_array($array=[]){
        if(is_null($array) || empty($array) || count($array) == 0){
            return [];
        }else{
            return $array;
        }
    }
    static public function check_date($date=''){
        if(is_null($date) || empty($date)){
            return null;
        }else{
            return $date;
        }
    }



    static public function array_to_string($array=[]){
        if(is_null($array) || empty($array) || count($array) == 0){
            return '';
        }else{
            return implode(",", $array);
        }
    }
    
}
