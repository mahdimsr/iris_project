<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


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


	public function user()
	{
		return $this->belongsTo(User::class,'userId');
    }

}
