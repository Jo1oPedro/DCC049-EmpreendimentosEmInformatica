<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    use HasFactory;

    protected $fillable = [
        'membros',
        'data_entrega',
        'trabalho',
        'subject_id'
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
