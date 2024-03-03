<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject_code',
        'subject_name',
    ];

    public function semesters()
    {
        return $this->belongsToMany(Semester::class, 'sub_combines');
    }
}
