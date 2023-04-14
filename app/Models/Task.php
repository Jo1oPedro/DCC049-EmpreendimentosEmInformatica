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
}
