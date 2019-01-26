<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Morilog\Jalali\Jalalian;


/**
 * Class Task
 * @package App\Model
 *
 * @property integer userId
 * @property integer meetingId
 * @property string type
 * @property string title
 * @property string description
 *
 */

class Task extends Model
{
    protected $table = 'task';
    use SoftDeletes;

	protected $appends = ['SolarDate'];

	public function getsolarDateAttribute()
	{
		return Jalalian::fromDateTime($this->date)->toArray();
	}

	public function user()
	{
		return $this->belongsTo(User::class,'userId');
    }

}
