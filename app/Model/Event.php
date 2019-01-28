<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Morilog\Jalali\Jalalian;


/**
 * Class Event
 *
 * @package App\Model
 * @property int $id
 * @property string $title
 * @property string|null $type
 * @property int|null $isHoliday
 * @property string $date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read mixed $solar_date
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Event newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Event newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Event onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Event query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Event whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Event whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Event whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Event whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Event whereIsHoliday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Event whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Event whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Event whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Event withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Event withoutTrashed()
 * @mixin \Eloquent
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
