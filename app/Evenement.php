<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Evenement extends Model
{
    protected $fillable = ['nom', 'titre', 'lieu', 'hash', 'hash_admin'];
    protected $hidden = ['created_at', 'updated_at', 'id', 'hash_admin'];

    public function votes()
    {
        return $this->hasMany('App\Vote');
    }

    public function dates()
    {
        return $this->hasMany('App\Date');
    }

    public static function validPosts(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'titre' => 'required|string|min:3|max:50',
            'nom' => 'required|string|min:3|max:30',
            'lieu' => 'required|string|min:3|max:30'
        ]);

        if ($validator->fails())
            return false;

        return $validator->validate();
    }
}
