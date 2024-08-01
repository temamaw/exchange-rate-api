<?php

namespace App\Http\Controllers;

use App\Models\ExchangeRate;
use Illuminate\Http\Request;

class ExchangeRateController extends Controller
{
    public function index()
    {
        return response()->json(ExchangeRate::with('bank', 'currency')->get(), 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'bank_id' => 'required|exists:banks,id',
            'currency_id' => 'required|exists:currencies,id',
            'buying_rate' => 'required|numeric',
            'selling_rate' => 'required|numeric',
            'rate_date' => 'required|date'
        ]);

        $exchangeRate = ExchangeRate::create($request->all());

        return response()->json($exchangeRate, 201);
    }

    public function show($id)
    {
        $exchangeRate = ExchangeRate::with('bank', 'currency')->findOrFail($id);
        return response()->json($exchangeRate, 200);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'bank_id' => 'required|exists:banks,id',
            'currency_id' => 'required|exists:currencies,id',
            'buying_rate' => 'required|numeric',
            'selling_rate' => 'required|numeric',
            'rate_date' => 'required|date'
        ]);

        $exchangeRate = ExchangeRate::findOrFail($id);
        $exchangeRate->update($request->all());

        return response()->json($exchangeRate, 200);
    }

    public function destroy($id)
    {
        ExchangeRate::destroy($id);
        return response()->json(null, 204);
    }
}
