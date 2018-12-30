<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class Post
 * @package App
 * @property string title
 * @property int parentId
 *
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
