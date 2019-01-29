<?php

namespace App\Model;

use App\Model\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 *
 * @package App
 * @property string name
 * @property string password
 * @property int postId
 * @property int $id
 * @property string $email
 * @property string|null $email_verified_at
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $genre
 * @property string $phone
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Model\Post $post
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Task[] $task
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\User newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\User query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\User whereGenre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\User wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\User whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\User withoutTrashed()
 * @mixin \Eloquent
 */

class User extends Authenticatable
{
    use Notifiable;
	protected $table = 'user';
	use SoftDeletes;
	protected $guarded = [];
	protected $dates = ['deleted_at'];



	public function post()
	{
		return $this->belongsTo(Post::class,'postId');
	}



	public function task()
	{
		return $this->hasMany(Task::class,'userId');
	}

}
