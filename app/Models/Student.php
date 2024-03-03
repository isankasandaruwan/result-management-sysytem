<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'st_name',
        'st_idno',
        'st_index',
        'email',
        'batch_id',
    ];

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }
    public function examResults()
    {
        return $this->hasMany(ExamResult::class);
    }
}
