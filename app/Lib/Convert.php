<?php
/**
 * Created by PhpStorm.
 * User: Mahdi
 * Date: 12/30/2018
 * Time: 2:04 AM
 */
namespace App\Lib;

class Convert
{

	public static function convertNumber($string)
	{
		$farsi_array   = ["۰", "۱", "۲", "۳", "۴", "۵", "۶", "۷", "۸", "۹"];
		$english_array = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9"];

		return str_replace($farsi_array, $english_array, $string);
	}

}