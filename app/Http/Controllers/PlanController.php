<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('planning.index', [
            'planning' => Plan::with('user')->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('planning.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'component_name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'status' => 'required|string|in:working,not-working,pending,purchased',
        ]);

        $validated['user_id'] = $request->user()->id;
    

        Plan::create($validated);
    
        return redirect(route('planning.index'))->with('success', 'Plan created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Plan $plan): View
    {
        return view('planning.show', [
            'plan' => $plan,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $plan = Plan::findOrFail($id);
        Gate::authorize('update', $plan);

        return view('planning.edit', compact('plan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $plan = Plan::findOrFail($id);
        Gate::authorize('update', $plan);

        $validated = $request->validate([
            'component_name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'status' => 'required|string|in:working,not-working,pending,purchased',
        ]);

        $plan->update($validated);

        return redirect(route('planning.index'))->with('success', 'Plan updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse
    {
        $plan = Plan::findOrFail($id);
    
        $plan->delete();
        
        return redirect()->route('planning.index')->with('success', 'Plan deleted successfully!');
    }
}
