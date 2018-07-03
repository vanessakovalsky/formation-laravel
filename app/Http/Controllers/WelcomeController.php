<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function welcome(){
      return '<h1>Bienvenue à la formation Laravel</h1>';
      //return view('Bienvenue à la formation Laravel');
    }

    public function show($id){
      return 'Page avec l\'id'.$id;
    }
}
