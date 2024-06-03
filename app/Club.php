<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    protected $table = 'club';

    protected $fillable = [
        'id', 'name','photo' 
    ];

    public function PlayerClub(){
        return $this->HasMany(PlayerClub::class,'id','club_id');
    } 

    public function Player(){
        return $this->HasMany(Player::class);
    }  
    
}
