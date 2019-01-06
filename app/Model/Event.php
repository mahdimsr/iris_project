<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Morilog\Jalali\Jalalian;


/**
 * Class Event
 * @package App\Model
 *
 *
 *
 */

class Event extends Model
{
    protected $table = 'event';
    use SoftDeletes;

    protected $appends = ['SolarDate'];



	public function getsolarDateAttribute()
	{
		$jDate = \Morilog\Jalali\Jalalian::fromDateTime($this->date);

		return Jalalian::fromDateTime($this->date)->toArray();
    }
}
