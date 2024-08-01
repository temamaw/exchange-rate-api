<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function index()
    {
        return response()->json(Currency::all(), 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:currencies|max:3',
            'name' => 'required|max:255',
            'symbol' => 'max:10'
        ]);

        $currency = Currency::create($request->all());

        return response()->json($currency, 201);
    }

    public function show($id)
    {
        $currency = Currency::findOrFail($id);
        return response()->json($currency, 200);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'code' => 'required|max:3|unique:currencies,code,' . $id,
            'name' => 'required|max:255',
            'symbol' => 'max:10'
        ]);

        $currency = Currency::findOrFail($id);
        $currency->update($request->all());

        return response()->json($currency, 200);
    }

    public function destroy($id)
    {
        Currency::destroy($id);
        return response()->json(null, 204);
    }
}
