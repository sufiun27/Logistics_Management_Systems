<?php

namespace App\Http\Controllers;

use App\Models\CmValue;
use Illuminate\Http\Request;

class CmValueController extends Controller
{
    public function index()
    {
        // Fetch the CM value from the database
        $cmValue = CmValue::first();

        // Return the view with the CM value
        return view('cmValue.index', compact('cmValue'));
    }

    //update
    public function update(Request $request)
    {
        // Validate the request data
        $request->validate([
            'cm_value' => 'required|numeric|min:0|max:100',
        ]);

        // Find the first CM value record
        $cmValue = CmValue::first();

        // Update the CM value
        $cmValue->cm_value = $request->input('cm_value');
        $cmValue->save();

        // Redirect back with a success message
        return redirect()->route('cmValue.index')->with('success', 'CM Value updated successfully.');
    }
}
