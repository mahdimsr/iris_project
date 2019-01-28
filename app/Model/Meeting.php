<?php

namespace App\Model;

use App\Lib\Enum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Morilog\Jalali\CalendarUtils;
use Morilog\Jalali\Jalalian;


/**
 * Class Meeting
 *
 * @package App\Model
 * @property string title
 * @property string place
 * @property string state
 * @property int creatorId
 * @property int $id
 * @property string $date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Agenda[] $agenda
 * @property-read \App\Model\User $creator
 * @property-read mixed $jalali_date
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Meeting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Meeting newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Meeting onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Meeting query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Meeting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Meeting whereCreatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Meeting whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Meeting whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Meeting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Meeting wherePlace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Meeting whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Meeting whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Meeting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Meeting withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Meeting withoutTrashed()
 * @mixin \Eloquent
 */
class Meeting extends Model
{
	protected $table = 'meeting';

	use SoftDeletes;

	protected $appends = ['jalaliDate','persianState'];



	public function getjalaliDateAttribute()
	{

		return CalendarUtils::strftime('Y-d-m h:m:s', $this->date);
	}



	public function getpersianStateAttribute()
	{
		return Enum::meetingState($this->state);
	}



	public function agenda()
	{
		return $this->hasMany(Agenda::class, 'meetingId')->with('user');
	}



	public function agendaUser($userId)
	{
		return $this->hasMany(Agenda::class, 'meetingId')->where('userId','=',$userId);
	}

	public function creator()
	{
		return $this->belongsTo(User::class, 'creatorId')->with('post');
	}
}
