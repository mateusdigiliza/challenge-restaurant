<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use App\Models\Reservation;
use App\Http\Requests\ListAvailablesStoreRequest;


use Illuminate\Http\Request;


class ListAvailabelTablesController extends Controller
{
    public function index()
    {
        return[];
    }

    public function show(ListAvailablesStoreRequest $request)
    {
        $validated = $request->validated();

        $tables = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15"];

        $reservations = Reservation::where('date', $validated['date'])->get()->pluck('table_spot')->toArray();

        $availablesTables = array_diff($tables, $reservations);

        return response()->json($availablesTables, 200);
    }   
}
