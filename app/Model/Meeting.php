<?php

namespace App\Model;

use App\Lib\Enum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Morilog\Jalali\CalendarUtils;
use Morilog\Jalali\Jalalian;


/**
 * Class Meeting
 * @package App\Model
 *
 * @property string title
 * @property string place
 * @property string state
 * @property int creatorId
 *
 */
class Meeting extends Model
{
	protected $table = 'meeting';

	use SoftDeletes;

	protected $appends = ['jalaliDate','persianState'];



	public function getjalaliDateAttribute()
	{

		return CalendarUtils::strftime('Y-d-m h:m:s', $this->date);
	}



	public function getpersianStateAttribute()
	{
		return Enum::meetingState($this->state);
	}



	public function agenda()
	{
		return $this->hasMany(Agenda::class, 'meetingId')->with('user');
	}



	public function creator()
	{
		return $this->belongsTo(User::class, 'creatorId')->with('post');
	}
}
