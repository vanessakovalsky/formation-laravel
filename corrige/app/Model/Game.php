<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Pronostic;

class Game extends Model
{
  protected $table='games';

    public function pronostics(){
      return $this->hasMany(Pronostic::class);
    }
}
