<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'comment', 'date', 'time_spent', 'user_id'];

  
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function scopeGetTasks($query, $dateFrom, $dateTo){
        return $query->when($dateFrom, function ($query) use ($dateFrom) {
            return $query->where('date', '>=', $dateFrom);
        })->when($dateTo, function ($query) use ($dateTo) {
                return $query->where('date', '<=', $dateTo);
        })->select('title', 'comment', 'date', 'time_spent');
    }
}
