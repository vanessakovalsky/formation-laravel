<?php

use Illuminate\Database\Seeder;
use App\Model\Pronostic;

class PronosticSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      for($i=1; $i<1000; $i++){
        Pronostic::create([
          'score1' => '42',
          'score2' => '10',
          'game_id'=> 1,
        ]);
      }
    }
}
