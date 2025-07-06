<?php

namespace App\Http\Controllers;

use App\Models\Notify;
use Illuminate\Http\Request;

class NotifyController extends Controller
{
    // Display a listing of the resource
    public function index()
    {
        $notifies = Notify::all();
        return view('notify.index', compact('notifies'));
    }

    // Show the form for creating a new resource
    public function create()
    {
        return view('notify.create');
    }

    // // Store a newly created resource in storage
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
        ]);

        Notify::create($request->all());

        return redirect()->route('notify.index')->with('success', 'Notify created successfully.');
    }

    // // Display the specified resource
    public function show($notify)
    {
        $notify = Notify::findOrFail($notify);
        // If you want to use the model directly, you can also use:
        // $notify = Notify::findOrFail($id);
        // return $notifies;

        return view('notify.show', compact('notify'));
    }

    // // Show the form for editing the specified resource
    public function edit(Notify $notify)
    {
        return view('notify.edit', compact('notify'));
    }

    // // Update the specified resource in storage
    public function update(Request $request, Notify $notify)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
        ]);

        $notify->update($request->all());

        return redirect()->route('notify.index')->with('success', 'Notify updated successfully.');
    }

    // // Remove the specified resource from storage
    public function destroy(Notify $notify)
    {
        $notify->delete();

        return redirect()->route('notify.index')->with('success', 'Notify deleted successfully.');
    }
}
