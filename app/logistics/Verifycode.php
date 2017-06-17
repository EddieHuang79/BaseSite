<?php

namespace App\logistics;

use Illuminate\Support\Facades\Session;

class Verifycode{

	private $rules = array(
						1 => array(
							0 => "零",
							1 => "壹",
							2 => "貳",
							3 => "參",
							4 => "肆",
							5 => "伍",
							6 => "陸",
							7 => "柒",
							8 => "捌",
							9 => "玖"
						),
						2 => array(
							0 => "0",
							1 => "1",
							2 => "2",
							3 => "3",
							4 => "4",
							5 => "5",
							6 => "6",
							7 => "7",
							8 => "8",
							9 => "9"
						),
						3 => array(
							0 => "零",
							1 => "一",
							2 => "二",
							3 => "三",
							4 => "四",
							5 => "五",
							6 => "六",
							7 => "七",
							8 => "八",
							9 => "九"
						)
					);

	private $use_rules = array();

	private $verifycode = "";

	private $verifycode_length = 4;

	private $filename = array();

	private function random_num( $length = 4, $min = 0, $max = 9999 )
	{
		
		$num = rand($min, $max);
		
		$result = str_pad($num, $length, "0", STR_PAD_LEFT);
		
		return $result;

	}

	private function encode_num( $num )
	{
		return md5($num);
	}

	private function set_rules()
	{
		
		$tmp = array();

		$rules_map = $this->rules;

		$key = $this->random_num(1,1,3);

		$this->use_rules = $rules_map[$key];

		$this->verifycode = $this->random_num($this->verifycode_length,0,9999);

		for ($i=0; $i < $this->verifycode_length; $i++) 
		{ 
			$tmp[$i] = $this->encode_num($this->use_rules[$this->verifycode[$i]]);
		}

		$this->filename = $tmp;

	}

	public function get_verify_img()
	{

		return $this->filename; 	
	
	}

	public static function auth_verify_code( $input )
	{

		$result = $input == Session::get('Verifycode') ? true : false ;

        Session::forget('Verifycode');

        Session::forget('Verifycode_img');

		return $result;

	}

	public static function get_verify_code()
	{

		$_this = new self();

		$Verifycode = Session::get('Verifycode');
		$Verifycode_img = Session::get('Verifycode_img');

		if ( !isset($Verifycode) && !isset($Verifycode_img) )
		{
	
			$_this->set_rules();

			Session::put('Verifycode', $_this->verifycode);
			
			Session::put('Verifycode_img', $_this->get_verify_img());
	
		}
	
	}

}

?>