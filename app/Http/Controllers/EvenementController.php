<?php

namespace App\Http\Controllers;

use App\Evenement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class EvenementController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'title' => 'required|string|min:3|max:50',
            'nom' => 'required|string|min:3|max:30',
            'lieu' => 'required|string|min:3|max:30'
        ])->validate();

        $hash = uniqid();
        $request['hash'] = $hash;
        $hash = uniqid();
        $request['hash_admin'] = $hash;
        $evenement = Evenement::create($request->all());

        return response()->json($evenement, 201);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(String $hash)
    {
        $evenement = Evenement::firstWhere('hash', $hash);
        $evenement->votes;
        $evenement->dates;
        return response()->json($evenement);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, String $hash)
    {
        $evenement = Evenement::firstWhere('hash', $hash);
        $evenement->update($request->all());
        return response()->json($evenement);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(String $hash)
    {
        $evenement = Evenement::firstWhere('hash', $hash);
        $evenement->delete();
        return response()->json('OK', 204);
    }
}
