<?php

namespace App\Http\Controllers;

use App\Models\ApiUsage;
use Illuminate\Http\Request;

class ApiUsageController extends Controller
{
    public function index()
    {
        return response()->json(ApiUsage::with('user')->get(), 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'endpoint' => 'required|string|max:255',
            'request_count' => 'required|integer|min:0',
            'last_request_at' => 'nullable|date',
        ]);

        $apiUsage = ApiUsage::create($request->all());

        return response()->json($apiUsage, 201);
    }

    public function show($id)
    {
        $apiUsage = ApiUsage::with('user')->findOrFail($id);
        return response()->json($apiUsage, 200);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'sometimes|required|exists:users,id',
            'endpoint' => 'sometimes|required|string|max:255',
            'request_count' => 'sometimes|required|integer|min:0',
            'last_request_at' => 'nullable|date',
        ]);

        $apiUsage = ApiUsage::findOrFail($id);
        $apiUsage->update($request->all());

        return response()->json($apiUsage, 200);
    }

    public function destroy($id)
    {
        ApiUsage::destroy($id);
        return response()->json(null, 204);
    }
}
