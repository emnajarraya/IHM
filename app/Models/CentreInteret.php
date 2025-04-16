<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CentreInteret extends Model
{


public function moderateurs()
{
    return $this->belongsToMany(User::class, 'moderateurs_centres', 'centre_interet_id', 'user_id');
}


}
