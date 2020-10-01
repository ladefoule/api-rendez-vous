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
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|min:3|max:30',
            'vote' => 'required|string|min:3|max:30'
        ]);

        if ($validator->fails())
            return response()->json([], 404);

        $request = $validator->validate();

        $request['evenement_id'] = $evenement->id;
        $vote = Vote::create($request);

        return response()->json($vote, 201);
    }
}
