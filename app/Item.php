<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public function restaurant(){
        return $this->belongsTo('App\Restaurant');
    }
    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function orders(){
        return $this->belongsToMany('App/Order');
    }
}
