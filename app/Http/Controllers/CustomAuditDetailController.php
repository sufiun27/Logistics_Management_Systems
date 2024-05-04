<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomAuditDetail;
use App\Models\ExportFormApparel;
use App\DataTables\CustomAuditDetailDataTable;

class CustomAuditDetailController extends Controller
{
    
    public function indexAudit(CustomAuditDetailDataTable $dataTable)
    {
        return $dataTable->render('audit.indexAudit');
    }    
    public function addAudit()
    {
        return view('audit.addAudit');
    }
    public function storeAudit(Request $request){
        if(!ExportFormApparel::where('invoice_no', $request->invoice_no)->exists()){
            return redirect()->back()->with('error', 'Invoice not found in Export Form');
        }
        $cad= new CustomAuditDetail();
        $cad->invoice_no = $request->invoice_no;
        $cad->import_reg_no = $request->import_reg_no;
        $cad->import_bond = $request->import_bond;
        $cad->total_fabric_used = $request->total_fabric_used;
        $cad->adjusted_reg = $request->adjusted_reg;
        $cad->adjusted_reg_page = $request->adjusted_reg_page;
        $cad->createad_by = auth()->user()->emp_id;
        $cad->save();
        return redirect()->route('audit.addAudit')->with('success', 'Custom Audit Information added Successfully');
    }
    public function editAudit($id){
        $a = CustomAuditDetail::find($id);
        return view('audit.editAudit', compact('a'));
    }
    public function updateAudit(Request $request, $id){
        $cad= CustomAuditDetail::find($id);
        $cad->invoice_no = $request->invoice_no;
        $cad->import_reg_no = $request->import_reg_no;
        $cad->import_bond = $request->import_bond;
        $cad->total_fabric_used = $request->total_fabric_used;
        $cad->adjusted_reg = $request->adjusted_reg;
        $cad->adjusted_reg_page = $request->adjusted_reg_page;
        $cad->createad_by = auth()->user()->emp_id;
        $cad->save();
        return redirect()->route('audit.editAudit',$id)->with('success', 'Custom Audit Information updated Successfully');
    }
    public function deleteAudit($id){
        $cad= CustomAuditDetail::find($id);
        $cad->delete();
        return redirect()->route('audit.indexAudit')->with('success', 'Custom Audit Information deleted Successfully');
    }
}

