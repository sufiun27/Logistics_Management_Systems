<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consignee;

class ConsigneeController extends Controller
{
    public function consignee()
    {
        // $consignees = Consignee::all();
        //pagineat
        $consignees = Consignee::paginate(10);
        return view('consignee.consignee', compact('consignees'));
    }
    public function storeConsignee(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'consignee_name' => 'required',
            'consignee_site' => 'required',
            'consignee_address' => 'required',
            'consignee_country' => 'required',
        ]);
        $consignee = new Consignee();
        $consignee->consignee_name = $request->consignee_name;
        $consignee->consignee_site = $request->consignee_site;
        $consignee->consignee_address = $request->consignee_address;
        $consignee->consignee_country = $request->consignee_country;
        $consignee->save();
        return redirect()->back()->with('success', 'Consignee added successfully');
    }
    public function editConsignee($id)
    {
        $consignee = Consignee::find($id);
        return view('consignee.editConsignee', compact('consignee'));
    }
    public function updateConsignee(Request $request, $id)
    {
        $request->validate([
            'consignee_name' => 'required',
            'consignee_site' => 'required',
            'consignee_address' => 'required',
            'consignee_country' => 'required',
        ]);
        $consignee = Consignee::find($id);
        $consignee->consignee_name = $request->consignee_name;
        $consignee->consignee_site = $request->consignee_site;
        $consignee->consignee_address = $request->consignee_address;
        $consignee->consignee_country = $request->consignee_country;
        $consignee->save();
        return redirect()->back()->with('success', 'Consignee updated successfully');
    }
    public function deleteConsignee($id)
    {
        $consignee = Consignee::find($id);
        $consignee->delete();
        return redirect()->back()->with('success', 'Consignee deleted successfully');
    }

}
