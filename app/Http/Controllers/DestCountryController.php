<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DestCountry;
use Illuminate\Auth\Events\Validated;

class DestCountryController extends Controller
{
    public function destCountry()
    {   $destcountries = DestCountry::all();
        return view('DestCountry.DestCountry',compact('destcountries'));
    }
    public function storeDestCountry(Request $request)
    {
        $request->validate([
            'country_name' => 'required',
            'country_code' => 'required|unique:dest_countries',
            'port' => 'required|unique:dest_countries',

        ]);
        $destcountry = new DestCountry();
        $destcountry->country_name = $request->country_name;
        $destcountry->country_code = $request->country_code;
        $destcountry->port = $request->port;
        $destcountry->save();
        return redirect()->back()->with('success','Destination Country Added Successfully');
    }
    public function editDestCountry($id)
    {
        $destcountry = DestCountry::find($id);
        return view('DestCountry.editDestCountry',compact('destcountry'));
    }
    public function updateDestCountry(Request $request,$id)
    {
        $request->validate([
            'country_name' => 'required',
            'country_code' => 'required|unique:dest_countries,country_code,'.$id,
            'port' => 'required|unique:dest_countries,port,'.$id,

        ]);
        $destcountry = DestCountry::find($id);
        $destcountry->country_name = $request->country_name;
        $destcountry->country_code = $request->country_code;
        $destcountry->port = $request->port;
        $destcountry->save();
        return redirect()->back()->with('success','Destination Country Updated Successfully');
    }
    public function deleteDestCountry($id)
    {
        $destcountry = DestCountry::find($id);
        $destcountry->delete();
        return redirect()->back()->with('success','Destination Country Deleted Successfully');
    }
}
