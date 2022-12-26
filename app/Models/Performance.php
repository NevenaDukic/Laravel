<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Performance extends Model
{
    use HasFactory;
    protected $fillable = ['name','genre','number_of_roles','theatre_id'];
    public function theatre()
    {
        return $this->belongsTo(Theatre::class);
    }

    public function ticket(Type $var = null)
    {
        return $this->hasMany(Ticket::class); }
}
