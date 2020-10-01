<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Date extends Model
{
    protected $fillable = ['date', 'evenement_id'];
    protected $hidden = ['created_at', 'updated_at', 'id', 'evenement_id'];
}
