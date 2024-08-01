<?php

namespace App\Http\Controllers;

use App\Models\RateHistory;
use Illuminate\Http\Request;

class RateHistoryController extends Controller
{
    public function index()
    {
        return response()->json(RateHistory::with('exchangeRate')->get(), 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'exchange_rate_id' => 'required|exists:exchange_rates,id',
            'old_buying_rate' => 'required|numeric',
            'old_selling_rate' => 'required|numeric',
            'new_buying_rate' => 'required|numeric',
            'new_selling_rate' => 'required|numeric'
        ]);

        $rateHistory = RateHistory::create($request->all());

        return response()->json($rateHistory, 201);
    }

    public function show($id)
    {
        $rateHistory = RateHistory::with('exchangeRate')->findOrFail($id);
        return response()->json($rateHistory, 200);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'exchange_rate_id' => 'required|exists:exchange_rates,id',
            'old_buying_rate' => 'required|numeric',
            'old_selling_rate' => 'required|numeric',
            'new_buying_rate' => 'required|numeric',
            'new_selling_rate' => 'required|numeric'
        ]);

        $rateHistory = RateHistory::findOrFail($id);
        $rateHistory->update($request->all());

        return response()->json($rateHistory, 200);
    }

    public function destroy($id)
    {
        RateHistory::destroy($id);
        return response()->json(null, 204);
    }
}
