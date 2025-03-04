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

    public function index(): View
    {
        return view('planning.index', [
            'planning' => Plan::with('user')->latest()->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'component_name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'status' => 'required|string|in:working,not-working,pending,purchased',
        ]);
    
        $validated['user_id'] = $request->user()->id;
    
        $plan = Plan::create($validated);
    
        if ($request->headers->has('HX-Request')) {
            return view('partials.plan_row', ['plan' => $plan]);
        }
    
        return redirect(route('planning.index'))->with('success', 'Plan created successfully!');
    }
    
    
    

    public function show(Plan $plan): View
    {
        return view('planning.show', [
            'plan' => $plan,
        ]);
    }


    public function edit($id): View
    {
        $plan = Plan::findOrFail($id);
        Gate::authorize('update', $plan);

        return view('planning.edit', compact('plan'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $plan = Plan::findOrFail($id);
        Gate::authorize('update', $plan);

        $validated = $request->validate([
            'component_name' => 'required|string|max:255',
            'price' => 'required|decimal:2',
            'quantity' => 'required|integer',
            'status' => 'required|string|in:working,not-working,pending,purchased',
        ]);

        $plan->update($validated);

        return redirect(route('planning.index'))->with('success', 'Plan updated successfully!');
    }
    public function destroy($id)
    {
        $plan = Plan::findOrFail($id);
        $plan->delete();
    
        if (request()->header('HX-Request')) {
            return response('')->header('Content-Type', 'text/html');
        }
    
        return redirect()->route('planning.index')->with('success', 'Plan deleted successfully!');
    }
}