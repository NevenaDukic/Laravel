<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theatre extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


    protected $fillable = ['name'];
    public function performance(Type $var = null)
    {
        return $this->hasMany(Performance::class);    }
}
