<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class PronosticRepository implements RepositoryInterface{

  protected $model;

  public function __construct(Model $model){
    $this->model = $model;
  }

  public function all(){
    return $this->model->all();
  }

  public function create(){

  }

  public function getPronosticsWithMatch(){
    
  }

}

 ?>
