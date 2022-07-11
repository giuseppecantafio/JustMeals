<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Item;

class Restaurant extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function typologies(){
        return $this->belongsToMany('App\Typology');
    }

    public function items(){
        return $this->hasMany('App\Item');
    }


}
