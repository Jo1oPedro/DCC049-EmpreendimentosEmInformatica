<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    use HasFactory;

    protected $fillable = [
        'ano',
        'digito',
        'user_id'
    ];

    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }

    public function subjectsArrayId()
    {
        return array_map(function($subject) {
            return $subject['id'];
        }, $this->subjects->toArray());
    }

    public function attach_detach_subjects(array $subjects_to_detach, array $subjects_to_attach)
    {
        foreach($subjects_to_detach as $subject) {
            $this->subjects()->detach($subject);
        }

        foreach($subjects_to_attach as $subject) {
            $this->subjects()->attach($subject);
        }
    }
}
