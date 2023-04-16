<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
      'nome',
      'professor'
    ];

    public function periods()
    {
        return $this->belongsToMany(Period::class);
    }

    public function periodsArrayId()
    {
        return array_map(function ($period) {
            return $period['id'];
        }, $this->periods->toArray());
    }

    public function attach_detach_periods(array $periods_to_detach, array $periods_to_attach)
    {
        foreach($periods_to_detach as $period) {
            $this->periods()->detach($period);
        }

        foreach($periods_to_attach as $period) {
            $this->periods()->attach($period);
        }
    }
}
