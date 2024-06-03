<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $table = 'player';

    protected $fillable = [
        'name', 'national_team', 'position', 'answer','hint','difficulty'
    ];
    
    public function Club(){
            return $this->HasMany(Club::class,'id');
    }

    public function playerclub(){
        return $this->HasMany(PlayerClub::class,'player_id');
    }
}
