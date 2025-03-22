<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    use HasFactory;
    protected $guarded=[];

    function notes(){
        return $this->hasMany(Note::class);
    }

    function user() {
        return $this->belongsTo(User::class);
    }
}
