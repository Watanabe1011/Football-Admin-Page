<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlayerClub extends Model
{
    protected $table = 'player_club';

    protected $fillable = [
        'player_id', 'club_id', 'duration' 
    ]; 

    public function player(){
        return $this->HasMany(Player::class,'id','player_id');
    }

    public function club(){
        return $this->HasMany(Club::class,'id','club_id');
    }
    
}
