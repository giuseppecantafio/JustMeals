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

    // METODI VALIDAZIONI ADDRESS 

    public static function validateStreet($address){

        // var di controllo
        $validStreet = false;

        // array di controllo
        $vie=[
            'via', 'piazza', 'largo', 'strada', 'stradone', 'sontrada', 'rione', 'circonvallazione', "ca'", 'vicolo', 'vicoletto'
        ];

        // ciclo di controllo
        foreach($vie as $via){
            if(str_contains(strtolower($address), $via)){
                $validStreet = true;
            }
        }
        
        return $validStreet;
    }

    public static function validateNumber($address){

        // var di controllo
        $validNumber = false;

        // array di controllo
        $numbers=[
            0,1,2,3,4,5,6,7,8,9
        ];

        // ciclo di controllo
        foreach($numbers as $number){
            if(str_contains(strtolower($address), $number)){
                $validNumber = true;
            }
        }

        return $validNumber;
    }


}
