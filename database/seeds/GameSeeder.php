<?php

use Illuminate\Database\Seeder;
use App\Model\Game;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Game::create([]);
    }
}
