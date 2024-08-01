<?php

namespace App\Http\Controllers;
use App\Models\Bank;
use Illuminate\Http\Request;

class BankController extends Controller
{
    public function index()
    {
        return response()->json(Bank::all(), 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:banks|max:255',
        ]);

        $bank = Bank::create($request->all());

        return response()->json($bank, 201);
    }

    public function show($id)
    {
        $bank = Bank::findOrFail($id);
        return response()->json($bank, 200);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255|unique:banks,name,' . $id,
        ]);

        $bank = Bank::findOrFail($id);
        $bank->update($request->all());

        return response()->json($bank, 200);
    }

    public function destroy($id)
    {
        Bank::destroy($id);
        return response()->json(null, 204);
    }
}
