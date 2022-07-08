<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Restaurant extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function typologies(){
    $this->belongsToMany('App\Typology');
    }

}
