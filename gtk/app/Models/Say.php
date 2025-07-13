<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Say extends Model
{
    protected $table='say';
    protected $primaryKey= 'id';
    protected $fillable = ['name','des','say','img'];
    use HasFactory;
}
