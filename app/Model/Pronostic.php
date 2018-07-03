<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Pronostic extends Model
{
    protected $fillable = [
      'score1', 'score2'
    ];
}
