<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MathsQuestion extends Model
{
   protected $table='maths_question';
   protected $fillable = ['id','question','a','b','c','d','answer'];

}
