<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    public function visits()
    {
        return  $this->hasMany(Visit::class);
    }
    public function reports(){
        return $this->hasMany(Report::class);
    }
    public function queues(){
        return $this->hasMany(Queue::class);
    }
}
