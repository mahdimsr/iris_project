<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class Agenda
 * @package App\Model
 * @property integer userId
 * @property integer meetingId
 * @property string title
 * @property integer value_time
 *
 *
 */

class Agenda extends Model
{
    protected $table = 'agenda';
    use SoftDeletes;



	public function meeting()
	{
		return $this->belongsTo(Meeting::class,'meetingId');
    }



	public function user()
	{
		return $this->belongsTo(User::class,'userId')->with('post');
    }
}
