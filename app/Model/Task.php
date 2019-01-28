<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Morilog\Jalali\Jalalian;


/**
 * Class Task
 *
 * @package App\Model
 * @property integer userId
 * @property integer meetingId
 * @property string type
 * @property string title
 * @property string description
 * @property int $id
 * @property string|null $date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\Model\User $user
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Task newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Task newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Task onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Task query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Task whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Task whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Task whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Task whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Task whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Task whereMeetingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Task whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Task whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Task whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Task whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Task withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Task withoutTrashed()
 * @mixin \Eloquent
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



	public function meeting()
	{
		return $this->belongsTo(Meeting::class, 'meetingId');
    }

}
