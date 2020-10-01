<?php

namespace App\Http\Controllers;

use App\Evenement;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class EvenementController extends Controller
{
    /**
     * Tous les évenements
     *
     * @return void
     */
    public function index()
    {
        return Evenement::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request = Evenement::validPosts($request);
        if($request == false)
            return response()->json('Erreur de requète !', 404);

        // uniqid('', true) Renvoie un hash de ce type : 5f6da1345f3230.40143896
        $hash = Str::replaceFirst('.', '', uniqid('', true));
        $request['hash'] = $hash;

        $hash = Str::replaceFirst('.', '', uniqid('', true));
        $request['hash_admin'] = $hash;

        $evenement = Evenement::create($request);

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
        if($evenement == false)
            return response()->json('Evenement introuvable !', 404);
        $evenement->votes;
        $i = 0;
        foreach($evenement->dates as $date){
            $evenement->dates[$i] = $date['date'];
            $i++;
        }
        $i = 0;
        foreach($evenement->votes as $vote){
            $evenement->votes[$i] = $vote['nom'] . '=>' . $vote['vote'];
            $i++;
        }
        return response()->json($evenement);
    }

    /**
     * Affichage de l'évènement en mode Admin
     *
     * @return \Illuminate\Http\Response
     */
    public function showAdmin(String $hashAdmin)
    {
        $evenement = Evenement::firstWhere('hash_admin', $hashAdmin);
        if($evenement == false)
            return response()->json('Evenement introuvable !', 404);
        $evenement->votes;
        $evenement->dates;

        $evenement->makeVisible(['hash_admin']); // Rend visible le champ hash_admin
        $i = 0;
        foreach($evenement->dates as $date){
            $evenement->dates[$i] = $date['date'];
            $i++;
        }
        $i = 0;
        foreach($evenement->votes as $vote){
            $evenement->votes[$i] = $vote['nom'] . '=>' . $vote['vote'];
            $i++;
        }
        return response()->json($evenement);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, String $hashAdmin)
    {
        $request = Evenement::validPosts($request);
        if($request == false)
            return response()->json('Erreur de requète !', 404);

        $evenement = Evenement::firstWhere('hash_admin', $hashAdmin);
        if($evenement == false)
            return response()->json('Evenement introuvable !', 404);

        $evenement->update($request);
        return response()->json($evenement);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(String $hashAdmin)
    {
        $evenement = Evenement::firstWhere('hash_admin', $hashAdmin);
        if($evenement == false)
            return response()->json('Evenement introuvable !', 404);

        $evenement->delete(); // Avec les cascades, les créneaux et les votes seront supprimés en même temps
        return response()->json('Suppréssion OK', 204);
    }

    public function destroyAll()
    {
        $evenements = Evenement::all();
        foreach ($evenements as $evenement) {
            $evenement = Evenement::findOrFail($evenement->id);
            $evenement->delete();
        }

        return response()->json('Suppréssions multiples OK', 204);
    }
}
