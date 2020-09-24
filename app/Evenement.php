<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evenement extends Model
{
    protected $fillable = ['nom', 'titre', 'lieu', 'hash', 'hash_admin'];

    public function votes()
    {
        return $this->hasMany('App\Vote');
    }

    public function dates()
    {
        return $this->hasMany('App\Date');
    }
}
