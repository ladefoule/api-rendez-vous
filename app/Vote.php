<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $fillable = ['vote', 'evenement_id', 'nom'];
    protected $hidden = ['created_at', 'updated_at', 'id', 'evenement_id'];
}
