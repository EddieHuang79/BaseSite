<?php

namespace App\logic;


abstract class Basetool
{
    public function strFilter( $str = '' )
    {

    	$str = trim($str);
		
		$result = preg_replace("/[ '.,:;*?~`!@#$%^&+=)(<>{}]|\]|\[|\/|\\\|\"|\|/", "", $str);

		return $result;

    }

    public function get_object_or_array_key( $data )
    {

    	$result = array();

    	foreach ($data as $key => $value) 
    	{
    		$result[] = intval($key);
    	}

    	return $result;

    }

}