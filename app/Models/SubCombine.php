<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCombine extends Model
{
    use HasFactory;

    protected $fillable = [
        'semester_id',
        'subject_id',
    ];
    
    // Define the relationships with other models
    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
    
}
