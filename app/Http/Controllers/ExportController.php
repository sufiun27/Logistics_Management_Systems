<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Export;
use Illuminate\Database\QueryException;

class ExportController extends Controller
{
    public function exporter()
    {
        $exporters = Export::all();
        return view('export.exporter',compact('exporters'));
    }
    public function storeExporter(Request $request)
    {
        $request->validate([
            'ExpoterNo' => 'required|unique:exports',
            'ExpoterName' => 'required',
            'ExpoterAddress' => 'required',
            'RegDetails' => 'required',
            'EPBReg' => 'required',
        ]);
        $exporters = new Export;
        $exporters->ExpoterNo = $request->ExpoterNo;
        $exporters->ExpoterName = $request->ExpoterName;
        $exporters->ExpoterAddress = $request->ExpoterAddress;
        $exporters->RegDetails = $request->RegDetails;
        $exporters->EPBReg = $request->EPBReg;
        $exporters->save();
        return redirect()->route('export.exporter')->with('success','Exporter Added Successfully');
    }
    public function editExporter($id)
    {
        $exporters = Export::find($id);
        return view('export.editExporter',compact('exporters'));
    }
    public function updateExporter(Request $request, $id){
        try{
            $request->validate([
                'ExpoterNo' => 'required',
                'ExpoterName' => 'required',
                'ExpoterAddress' => 'required',
                'RegDetails' => 'required',
                'EPBReg' => 'required',
            ]);
            $exporters = Export::find($id);
            $exporters->ExpoterNo = $request->ExpoterNo;
            $exporters->ExpoterName = $request->ExpoterName;
            $exporters->ExpoterAddress = $request->ExpoterAddress;
            $exporters->RegDetails = $request->RegDetails;
            $exporters->EPBReg = $request->EPBReg;
            $exporters->save();
            return redirect()->route('export.exporter')->with('success','Exporter Updated Successfully');
        }
        catch(QueryException $e){
            return redirect()->route('export.editExporter',$id)->with('error','Cannot Insert Duplicate Entry');
        }        
    }
    public function deleteExporter($id)
    {
        $exporters = Export::find($id);
        $exporters->delete();
        return redirect()->route('export.exporter')->with('success','Exporter Deleted Successfully');
    }
}
