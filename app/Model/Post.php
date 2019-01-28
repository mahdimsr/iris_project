<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class Post
 *
 * @package App
 * @property string englishTitle
 * @property string persianTitle
 * @property int parentId
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Model\Post|null $parent
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Post newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Post onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Post query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Post whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Post whereEnglishTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Post whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Post wherePersianTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Post whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Post withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Post withoutTrashed()
 * @mixin \Eloquent
 */


class Post extends Model
{
    protected $table = 'post';
    use SoftDeletes;
    protected $dates = ['deleted_at'];



	public function parent()
	{
		return $this->belongsTo($this,'parentId');
    }

}
