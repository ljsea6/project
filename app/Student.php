<?php

namespace App;

use App\Note;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';

    protected $guarded = ['id'];

    public function notes()
    {
        return $this->hasMany(Note::class, 'student_id');
    }
}
