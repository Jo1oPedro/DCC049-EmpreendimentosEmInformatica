<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'tempo_execucao',
        'realizado',
        'titulo',
        'subject_id',
        'type_id',
        'user_id'
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function scopeWithTypeSubject($query)
    {
        return $query->with('type')->with('subject');
    }
}
