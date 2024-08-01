<?php

namespace App\Http\Controllers;

use App\Models\UserSubscription;
use Illuminate\Http\Request;

class UserSubscriptionController extends Controller
{
    public function index()
    {
        return response()->json(UserSubscription::with('user', 'subscriptionPlan')->get(), 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'subscription_plan_id' => 'required|exists:subscription_plans,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|in:active,inactive,expired',
        ]);

        $userSubscription = UserSubscription::create($request->all());

        return response()->json($userSubscription, 201);
    }

    public function show($id)
    {
        $userSubscription = UserSubscription::with('user', 'subscriptionPlan')->findOrFail($id);
        return response()->json($userSubscription, 200);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'sometimes|required|exists:users,id',
            'subscription_plan_id' => 'sometimes|required|exists:subscription_plans,id',
            'start_date' => 'sometimes|required|date',
            'end_date' => 'sometimes|required|date|after:start_date',
            'status' => 'sometimes|required|in:active,inactive,expired',
        ]);

        $userSubscription = UserSubscription::findOrFail($id);
        $userSubscription->update($request->all());

        return response()->json($userSubscription, 200);
    }

    public function destroy($id)
    {
        UserSubscription::destroy($id);
        return response()->json(null, 204);
    }
}

