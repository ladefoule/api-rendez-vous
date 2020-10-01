<?php

namespace App\Http\Controllers;

use App\Date;
use DateTime;
use App\Evenement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DateController extends Controller
{
    public function store(Request $request, String $hashAdmin)
    {
        $evenement = Evenement::firstWhere('hash_admin', $hashAdmin);
        $validator = Validator::make($request->all(), [
            'dates' => 'required|array',
            'dates.*' => 'string|date_format:d/m/Y' //before:'.date('Y-m-d', strtotime('+1 year'))
        ]);

        if ($validator->fails())
            return response()->json([], 404);

        $request = $validator->validate();

        $evenementId = $evenement->id;
        $dates = $request['dates'];

        foreach ($dates as $date) {
            $dateBonFormat = new DateTime($date);
            $dateBonFormat = $dateBonFormat->format('Y-m-d');
            $date = Date::create([
                'date' => $dateBonFormat,
                'evenement_id' => $evenementId
            ]);
        }

        return response()->json($date, 201);
    }
}
