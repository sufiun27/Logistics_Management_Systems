<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BillingDetail;
use App\Models\ExportFormApparel;
//datatable
use App\DataTables\BillingDetailDataTable;

class BillingDetailController extends Controller
{
    public function indexBilling(BillingDetailDataTable $dataTable){
        return $dataTable->render('billing.indexBilling');      
    }    
    public function addBilling(){
        return view('billing.addBilling');
    }
    public function storeBilling(Request $request){
        if(!ExportFormApparel::where('invoice_no', $request->invoice_no)->exists()){
            return redirect()->back()->with('error', 'Invoice not found in Export Form');
        }
        $b= new BillingDetail();
        $b->invoice_no = $request->invoice_no;
        $b->sb_no = $request->sb_no;
        $b->sb_date = $request->sb_date;
        $b->doc_submit_date = $request->doc_submit_date;
        $b->hk_courier_no = $request->hk_courier_no;
        $b->hk_courier_date = $request->hk_courier_date;
        $b->buyer_courier_no = $request->buyer_courier_no;
        $b->buyer_courier_date = $request->buyer_courier_date;
        $b->lead_time = $request->lead_time;
        $b->bank_submit_date = $request->bank_submit_date;
        $b->mode = $request->mode;
        $b->bd_thc = $request->bd_thc;
        $b->created_by = auth()->user()->emp_id;
        $b->save();
        return redirect()->route('billing.addBilling')->with('success', 'Billing Information added Successfully');
    }
    public function editBilling($id){
        $b = BillingDetail::find($id);
        return view('billing.editBilling', compact('b'));
    }
    public function updateBilling(Request $request, $id){
        $b= BillingDetail::find($id);
        $b->invoice_no = $request->invoice_no;
        $b->sb_no = $request->sb_no;
        $b->sb_date = $request->sb_date;
        $b->doc_submit_date = $request->doc_submit_date;
        $b->hk_courier_no = $request->hk_courier_no;
        $b->hk_courier_date = $request->hk_courier_date;
        $b->buyer_courier_no = $request->buyer_courier_no;
        $b->buyer_courier_date = $request->buyer_courier_date;
        $b->lead_time = $request->lead_time;
        $b->bank_submit_date = $request->bank_submit_date;
        $b->mode = $request->mode;
        $b->bd_thc = $request->bd_thc;
        $b->updated_by = auth()->user()->emp_id;
        $b->save();
        return redirect()->route('billing.editBilling',$id)->with('success', 'Billing Information updated Successfully');
    }
    public function deleteBilling($id){
        $b = BillingDetail::find($id);
        $b->delete();
        return redirect()->route('billing.indexBilling')->with('success', 'Billing Information deleted Successfully');
    }
}
