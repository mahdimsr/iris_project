<?php

namespace App\Model;

use App\Lib\Enum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class Agenda
 * @package App\Model
 * @property integer userId
 * @property integer meetingId
 * @property string title
 * @property integer value_time
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\Model\Meeting $meeting
 * @property-read \App\Model\User $user
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Agenda newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Agenda newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Agenda onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Agenda query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Agenda whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Agenda whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Agenda whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Agenda whereMeetingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Agenda whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Agenda whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Agenda whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Agenda whereValueTime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Agenda withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Agenda withoutTrashed()
 * @mixin \Eloquent
 */

class Agenda extends Model
{
    protected $table = 'agenda';
    use SoftDeletes;
    protected $appends = ['persianState'];



	public function getpersianStateAttribute()
	{
		return Enum::agendaState($this->state);
    }

	public function meeting()
	{
		return $this->belongsTo(Meeting::class,'meetingId');
    }



	public function user()
	{
		return $this->belongsTo(User::class,'userId')->with('post');
    }
}
