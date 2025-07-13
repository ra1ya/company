<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Custom extends Model
{
    protected $table='custom';
    protected $primaryKey= 'id';
    protected $fillable = ['img'];
   
    use HasFactory;
}
