<?php

namespace App\Http\Controllers;
use App\Models\TtInformation;
use App\Models\Export;
use App\DataTables\TtInformationDataTable;
use Yajra\DataTables\Facades\DataTables;

use Illuminate\Http\Request;


class TtInformationController extends Controller
{
    
    public function ttInformation(TtInformationDataTable $dataTable, Request $request)
    
    {
       if (isset($request->start_date)&&isset($request->end_date)) {
           $start_date = $request->start_date;
           $end_date = $request->end_date;
            $start_date = \Carbon\Carbon::parse($start_date)->startOfDay()->format('Y-m-d H:i:s');
            $end_date = \Carbon\Carbon::parse($end_date)->endOfDay()->format('Y-m-d H:i:s');

         return $dataTable->with('start_date', $start_date)
         ->with('end_date', $end_date)
         ->render('ttinformation.ttInformation');
       }else{return $dataTable->render('ttinformation.ttInformation');}
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
        ]);
        $ttinformation = new TtInformation;
        $ttinformation->tt_no = $request->tt_no;
        $ttinformation->tt_amount = $request->tt_amount;
        $ttinformation->tt_currency = $request->tt_currency;
        $ttinformation->bank_name = $request->bank_name;
        $ttinformation->tt_site = $request->tt_site;
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
        return view('ttInformation.editTtInformation', compact('tt'));
    }

    public function updateTtInformation(Request $request, $id){
        $request->validate([
            'tt_no' => 'required|unique:tt_information,tt_no,'.$id,
            'tt_amount'=>'required',
            'tt_currency'=>'required',
            'bank_name'=>'required',
            'tt_site'=>'required',
        ]);
        $ttinformation = TtInformation::find($id);
        $ttinformation->tt_no = $request->tt_no;
        $ttinformation->tt_amount = $request->tt_amount;
        $ttinformation->tt_currency = $request->tt_currency;
        $ttinformation->bank_name = $request->bank_name;
        $ttinformation->tt_site = $request->tt_site;
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


