<?php

namespace App\Http\Controllers;

use App\Vote;
use App\Evenement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VoteController extends Controller
{
    public function store(Request $request, String $hash)
    {
        $evenement = Evenement::firstWhere('hash', $hash);
        Validator::make($request->all(), [
            'nom' => 'required|string|min:3|max:30',
            'vote' => 'required|string|min:3|max:30'
        ])->validate();

        $request['evenement_id'] = $evenement->id;
        $vote = Vote::create($request->all());

        return response()->json($vote, 201);
    }
}
