<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Annotation extends Model
{
    use HasFactory;

    protected $fillable = [
        'anotacao',
        'subject_id'
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
