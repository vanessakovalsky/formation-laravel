<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Model\User;

class Role extends Model
{
    protected $fillable = ['role_name'];

    public function user(){
      return $this->belongsToMany(User::class);
    }
}
