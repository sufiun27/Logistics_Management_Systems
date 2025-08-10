<?php

namespace App\Http\Controllers;
use App\Models\TtInformation;
use App\Models\Export;
use App\DataTables\TtInformationDataTable;
use Yajra\DataTables\Facades\DataTables;

use Illuminate\Http\Request;


class TtInformationController extends Controller
{

    public function ttInformation(Request $request)

    {
        $request->validate([
            'invoice_no' => 'nullable|string|max:255', // Allow nullable, add max length
        ]);

        $invoice_no = $request->input('invoice_no');

        $data = TtInformation::query();
        if ($invoice_no) {
            $data = $data->where('invoice_no', 'like', '%' . $invoice_no . '%'); // Case-insensitive search
        }
        $data = $data->where('tt_site', auth()->user()->site );

        $data = $data->orderByDesc('created_at')->paginate(25);

       // return $data;

        return view('ttInformation.ttInformation', compact('data'));

    }
    //ttInformation.addTtInformation
    public function addTtInformation(){
        $exrter=Export::select('ExpoterName')->get();
        return view('ttInformation.addTtInformation',compact('exrter'));
    }

    public function storeTtInformation(Request $request){
        $request->validate([
            'tt_no' => 'required|unique:tt_information',
            'tt_amount'=>'required',
            'tt_currency'=>'required',
            'bank_name'=>'required',
            'tt_site'=>'required',
            'tt_date'=>'required',
        ]);
        $ttinformation = new TtInformation;
        $ttinformation->tt_no = $request->tt_no;
        $ttinformation->tt_amount = $request->tt_amount;
        $ttinformation->tt_currency = $request->tt_currency;
        $ttinformation->bank_name = $request->bank_name;
        $ttinformation->tt_site = $request->tt_site;
        $ttinformation->tt_date = $request->tt_date;
        $ttinformation->tt_remarks= $request->tt_remarks;
        $ttinformation->tt_created_by = auth()->user()->emp_id;
        $ttinformation->save();
        return redirect()->back()->with('success', 'TT Information Added Successfully');
    }

    public function ttDetails($id){

        $tt = TtInformation::find($id);
        return view('ttInformation.ttDetails', compact('tt'));
    }

    public function editTtInformation($id){
        $tt = TtInformation::find($id);
        $exrter=Export::select('ExpoterName')->get();
        return view('ttInformation.editTtInformation', compact('tt','exrter'));
    }

    public function updateTtInformation(Request $request, $id){
        $request->validate([
            'tt_no' => 'required|unique:tt_information,tt_no,'.$id,
            'tt_amount'=>'required',
            'tt_currency'=>'required',
            'bank_name'=>'required',
            'tt_site'=>'required',
            'tt_date'=>'required',
        ]);
        $ttinformation = TtInformation::find($id);
        $ttinformation->tt_no = $request->tt_no;
        $ttinformation->tt_amount = $request->tt_amount;
        $ttinformation->tt_currency = $request->tt_currency;
        $ttinformation->bank_name = $request->bank_name;
        $ttinformation->tt_site = $request->tt_site;
        $ttinformation->tt_date = $request->tt_date;
        $ttinformation->tt_remarks= $request->tt_remarks;
        $ttinformation->Modified_by = auth()->user()->emp_id;
        $ttinformation->save();
        return redirect()->back()->with('success', 'TT Information Updated Successfully');
    }

    public function active($id){
        $ttinformation = TtInformation::find($id);
        $ttinformation->tt_status = 1;
        $ttinformation->save();
        return redirect()->back()->with('success', 'TT Information Activated Successfully');
    }

    public function deactive($id){
        $ttinformation = TtInformation::find($id);
        $ttinformation->tt_status = 0;
        $ttinformation->save();
        return redirect()->back()->with('success', 'TT Information Deactivated Successfully');
    }

    public function deleteTtInformation($id){
        $ttinformation = TtInformation::find($id);

        if (!$ttinformation) {
            return redirect()->route('ttInformation.ttInformation')->with('error', 'TT Information not found');
        }

        $ttinformation->delete();

        return redirect()->route('ttInformation.ttInformation')->with('success', 'TT Information Deleted Successfully');
    }

}


