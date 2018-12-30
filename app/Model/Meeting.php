<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class Meeting
 * @package App\Model
 *
 * @property string title
 * @property string place
 * @property string state
 *
 *
 */


class Meeting extends Model
{
    protected $table = 'meeting';
    use SoftDeletes;
    protected $appends = ['deleted_at'];



	public function agenda()
	{
		return $this->hasMany(Agenda::class,'meetingId');
    }
}
