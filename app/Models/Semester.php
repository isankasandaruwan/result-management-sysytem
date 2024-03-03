<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    use HasFactory;
    protected $fillable = ['semester'];

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'sub_combines');
    }
}
