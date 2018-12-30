<?php

namespace App\Model;

use App\Model\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class User
 * @package App
 * @property string name
 * @property string password
 * @property int postId
 */

class User extends Model
{
	protected $table = 'user';
	use SoftDeletes;
	protected $dates = ['deleted_at'];



	public function post()
	{
		return $this->belongsTo(Post::class,'postId');
	}

}
