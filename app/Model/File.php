<?php

namespace App\Model;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class File extends Model
{
    //
    protected $table = 'file';
    use SoftDeletes;

    public function uploader() {
        return $this->belongsTo(User::class, 'uploader_id');
    }

    public function meeting() {
        return $this->belongsTo(Meeting::class, 'meeting_id');
    }

}
