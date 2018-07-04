<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Game;

class Pronostic extends Model
{
    protected $fillable = [
      'score1', 'score2','game_id'
    ];

    public function game(){
      return $this->belongsTo(Game::class);
    }
}
