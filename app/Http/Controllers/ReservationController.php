<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Reservation;

use App\Http\Requests\CreateReservationStoreRequest;


class ReservationController extends Controller
{
    public function index()
    {
        return[];
    }

    public function store(CreateReservationStoreRequest $request)
    {

        // example date 2023-06-14 22:00:00

        $tables = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15"];
        $hours = ["18:00", "19:00", "20:00", "21:00", "22:00", "23:00", "23:59" ];

        $validated = $request->validated();

        $reservation = Reservation::where('date', $validated['date'])
            ->where('table_spot', $validated['table_spot'])
            ->first();

        $date = $validated['date'];
        $date = strtotime($date);
        $hour = strval(date('H:i', $date));

        $dayOfWeek = date('w', $date);
        
        if ($dayOfWeek == 0) {
            throw new \Exception("Sunday is a invalid day");
        }

        if (!in_array($hour, $hours)) {
            throw new \Exception("Invalid hour");
        }

        if($reservation !== null){
            throw new \Exception("This reservation is already taken");
        }

        Reservation::create($validated);
    }
}
