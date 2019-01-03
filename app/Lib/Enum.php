<?php
/**
 * Created by PhpStorm.
 * User: Mahdi
 * Date: 1/3/2019
 * Time: 1:43 AM
 */

namespace App\Lib;


class Enum
{

	//meeting state enum control
	public static function meetingState($state)
	{
		switch ($state)
		{
			case 'SUSPEND':

				return 'معلق';

				break;

			case 'ON';

				return 'برقرار';

				break;

			case 'CANCEL';

				return 'کنسل شده';

				break;

			case 'FINISHED';

				return 'به اتمام رسیده';

				break;
		}

		return null;
	}



	//task type
	public static function taskType($type)
	{
		switch ($type)
		{
			case 'PERSONAL':

				return 'شخصی';

				break;

			case 'MEETING':

				return 'جلسه';

				break;
		}

		return null;
	}


}