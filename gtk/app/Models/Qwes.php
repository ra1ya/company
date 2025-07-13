<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qwes extends Model
{
    protected $table='qwes';
    protected $primaryKey= 'id';
    protected $fillable = ['qwe','ans'];
   
    use HasFactory;

}
