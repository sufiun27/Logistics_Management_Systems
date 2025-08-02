<?php

namespace App\Http\Controllers;

use App\Models\CmValue;
use Illuminate\Http\Request;

class CmValueController extends Controller
{
    public function index()
    {
        // Fetch the CM value from the database
        $cmValues = CmValue::all();

       // return $cmValue;

        // Return the view with the CM value
        return view('cmValue.index', compact('cmValues'));
    }

    public function store(Request $request)
    {
       
        $validated = $request->validate([
            'cm_value' => 'required|numeric|min:0',
            'invoice_site' => 'required|string|exists:exports,ExpoterName', // Assuming 'sites' is the table name and 'name' is the column
        ]);
        if (CmValue::where('site', $validated['invoice_site'])->exists()) {
            return redirect()->back()->withErrors(['site' => 'This site already has a CM value.']);
        }

        CmValue::create([
            'cm_value' => $validated['cm_value'],
            'site' => $validated['invoice_site'],
        ]);

        return redirect()->route('cmValue.index')->with('success', 'CM Value added successfully.');
    }

    //update
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'cm_value' => 'required|numeric|min:0',
        ]);

        $cmValue = CmValue::findOrFail($id);
        $cmValue->update([
            'cm_value' => $validated['cm_value'],
        ]);

        return redirect()->route('cmValue.index')->with('success', 'CM Value updated successfully.');
    }
}
