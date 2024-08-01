<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function index()
    {
        return response()->json(Log::with('user')->get(), 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'action' => 'required|string|max:255',
            'details' => 'nullable|string',
        ]);

        $log = Log::create($request->all());

        return response()->json($log, 201);
    }

    public function show($id)
    {
        $log = Log::with('user')->findOrFail($id);
        return response()->json($log, 200);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'action' => 'sometimes|required|string|max:255',
            'details' => 'nullable|string',
        ]);

        $log = Log::findOrFail($id);
        $log->update($request->all());

        return response()->json($log, 200);
    }

    public function destroy($id)
    {
        Log::destroy($id);
        return response()->json(null, 204);
    }
}
