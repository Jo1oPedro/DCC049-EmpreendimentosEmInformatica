<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'data_prova',
        'prova',
        'nota',
        'subject_id'
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function scopeWithSubjectPeriods($query)
    {
        return $query->with('subject.periods');
    }

}
