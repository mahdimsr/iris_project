<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Agenda extends Model
{
    protected $table = 'agenda';
    use SoftDeletes;
    protected $appends = ['deleted_at'];



	public function meeting()
	{
		return $this->belongsTo(Meeting::class,'meetingId');
    }
}
