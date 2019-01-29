<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Morilog\Jalali\CalendarUtils;


class Message extends Model
{
	//
	protected $table = 'message';

	use SoftDeletes;

	protected $appends = ['senderName','jalaliDate'];


	public function getjalaliDateAttribute() {

		return CalendarUtils::strftime('Y-d-m h:m:s', $this->created_at);
	}

	public function getsenderNameAttribute()
	{
		if ($this->sender_id == '0')
		{
			return 'سیستم';
		}
		else
		{
			return null;
		}
	}



	public function sender()
	{
		return $this->belongsTo(User::class, 'sender_id')->with('post');
	}



	public function receiver()
	{
		return $this->belongsTo(User::class, 'receiver_id');
	}


}
