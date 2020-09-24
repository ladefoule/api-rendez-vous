<?php

namespace App\Http\Controllers;

use App\Date;
use DateTime;
use App\Evenement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DateController extends Controller
{
    public function store(Request $request, String $hash)
    {
        $evenement = Evenement::firstWhere('hash', $hash);
        Validator::make($request->all(), [
            'dates' => 'required|array',
            'dates.date*' => 'string|date_format:d/m/Y'
        ])->validate();

        $evenementId = $evenement->id;
        $dates = $request->dates;

        foreach ($dates as $date) {
            $dateBonFormat = new DateTime($date['date']);
            $dateBonFormat = $dateBonFormat->format('Y-m-d');
            $date = Date::create([
                'date' => $dateBonFormat,
                'evenement_id' => $evenementId
            ]);
        }

        return response()->json($date, 201);
    }
}
