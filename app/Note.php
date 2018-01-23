<?php

namespace App;

use App\Student;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $table = 'notes';

    protected $guarded = ['id'];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
