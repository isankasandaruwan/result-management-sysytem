<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'semester_id',
        'subject_id',
        'mark',
    ];

    // Define relationships with other models
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function subCombine()
    {
        return $this->belongsTo(SubCombine::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }
}
