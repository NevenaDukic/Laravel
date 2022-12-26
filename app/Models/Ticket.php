<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $fillable = ['seats','user_id','performance_id'];
    public function performance()
    {
        return $this->belongsTo(Performance::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
