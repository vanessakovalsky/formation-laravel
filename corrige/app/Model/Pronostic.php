<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Db;
use App\Model\Game;

class Pronostic extends Model
{
    protected $fillable = [
      'score1', 'score2','game_id'
    ];

    public static function boot(){
      parent::boot();
      static::addGlobalScope('game', function (Builder $builder) {
            $builder->where('game_id', '=', 1);
        });

    }

    public function game(){
      return $this->belongsTo(Game::class);
    }


    public static function getPronosticsWithMatch(){
      return DB::select("SELECT pronostics.id as p_id, score1, score2, games.created_at as created_at,
        games.id as game_id FROM pronostics LEFT JOIN games on pronostics.game_id = games.id");
    }
}
