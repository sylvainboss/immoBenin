<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ville extends Model
{
    public function biens(){
        return $this->hasMany(Biens::class);
    }
}
