<?php

namespace App\Http\Controllers;

use App\Models\SubscriptionPlan;
use Illuminate\Http\Request;

class SubscriptionPlanController extends Controller
{
    public function index()
    {
        return response()->json(SubscriptionPlan::all(), 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
        ]);

        $subscriptionPlan = SubscriptionPlan::create($request->all());

        return response()->json($subscriptionPlan, 201);
    }

    public function show($id)
    {
        $subscriptionPlan = SubscriptionPlan::findOrFail($id);
        return response()->json($subscriptionPlan, 200);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|nullable|string',
            'price' => 'sometimes|required|numeric',
        ]);

        $subscriptionPlan = SubscriptionPlan::findOrFail($id);
        $subscriptionPlan->update($request->all());

        return response()->json($subscriptionPlan, 200);
    }

    public function destroy($id)
    {
        SubscriptionPlan::destroy($id);
        return response()->json(null, 204);
    }
}
