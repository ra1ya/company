<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $table='team';
    protected $primaryKey= 'id';
    protected $fillable = ['name','des','code','img'];
   
    use HasFactory;
}
