<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LogisticsDetail;
use App\Models\ExportFormApparel;
use App\DataTables\LogisticsDetailDataTable;

class LogisticsDetailController extends Controller
{
    public function indexLogistics(LogisticsDetailDataTable $dataTable)
    {
        return $dataTable->render('logistics.indexLogistics');
    }
    public function addLogistics()
    {
        return view('logistics.addLogistics');
    }
    public function storeLogistics(Request $request){
        if(!ExportFormApparel::where('invoice_no', $request->invoice_no)->exists()){
            return redirect()->route('logistics.addLogistics')->with('error', 'Invoice not found in Export Form');
        }
        if (LogisticsDetail::where('invoice_no', $request->invoice_no)->exists()) {
            return redirect()->route('logistics.addLogistics')->with('error', 'Invoice already added');
        }
        $ld= new LogisticsDetail();
        $ld->invoice_no = $request->invoice_no;
        $ld->receivable_amount = $request->receivable_amount;
        $ld->doc_process_fee = $request->doc_process_fee;
        $ld->seal_lock_charge = $request->seal_lock_charge;
        $ld->agency_commission = $request->agency_commission;
        $ld->documentation_charge = $request->documentation_charge;
        $ld->transportation_charge = $request->transportation_charge;
        $ld->short_shipment_certificate_fee = $request->short_shipment_certificate_fee;
        $ld->factory_loading_fee = $request->factory_loading_fee;
        $ld->uploading_fee_forwarder_wh = $request->uploading_fee_forwarder_wh;
        $ld->truck_demurrage_fee_delay_at_depot = $request->truck_demurrage_fee_delay_at_depot;
        $ld->cfs_depot_mixed_cargo_loading_fee = $request->cfs_depot_mixed_cargo_loading_fee;
        $ld->customs_misc_remark_reasons_charge = $request->customs_misc_remark_reasons_charge;
        $ld->customs_remark_charge_misc_reasons = $request->customs_remark_charge_misc_reasons;
        $ld->cargo_ho_date = $request->cargo_ho_date;
        $ld->deadline_bill_submission = $request->deadline_bill_submission;
        $ld->bill_received_date = $request->bill_received_date;
        $ld->status = $request->status;
        $ld->forwarder_name = $request->forwarder_name;
        $ld->total_charges = $request->total_charges;
        $ld->created_by = auth()->user()->emp_id;
        $ld->save();
        return redirect()->route('logistics.addLogistics')->with('success', 'Logistics Information added Successfully');
    }
    public function editLogistics($id){
        $l = LogisticsDetail::find($id);
        return view('logistics.editLogistics', compact('l'));
    }
    public function updateLogistics(Request $request, $id){
        $ld= LogisticsDetail::find($id);
        $ld->receivable_amount = $request->receivable_amount;
        $ld->doc_process_fee = $request->doc_process_fee;
        $ld->seal_lock_charge = $request->seal_lock_charge;
        $ld->agency_commission = $request->agency_commission;
        $ld->documentation_charge = $request->documentation_charge;
        $ld->transportation_charge = $request->transportation_charge;
        $ld->short_shipment_certificate_fee = $request->short_shipment_certificate_fee;
        $ld->factory_loading_fee = $request->factory_loading_fee;
        $ld->uploading_fee_forwarder_wh = $request->uploading_fee_forwarder_wh;
        $ld->truck_demurrage_fee_delay_at_depot = $request->truck_demurrage_fee_delay_at_depot;
        $ld->cfs_depot_mixed_cargo_loading_fee = $request->cfs_depot_mixed_cargo_loading_fee;
        $ld->customs_misc_remark_reasons_charge = $request->customs_misc_remark_reasons_charge;
        $ld->customs_remark_charge_misc_reasons = $request->customs_remark_charge_misc_reasons;
        $ld->cargo_ho_date = $request->cargo_ho_date;
        $ld->deadline_bill_submission = $request->deadline_bill_submission;
        $ld->bill_received_date = $request->bill_received_date;
        $ld->status = $request->status;
        $ld->forwarder_name = $request->forwarder_name;
        $ld->total_charges = $request->total_charges;
        $ld->updated_by = auth()->user()->emp_id;
        $ld->save();
        return redirect()->route('logistics.editLogistics',$id)->with('success', 'Logistics Information updated Successfully');
    }
    public function deleteLogistics($id){
        $ld= LogisticsDetail::find($id);
        $ld->delete();
        return redirect()->route('logistics.indexLogistics')->with('success', 'Logistics Information deleted Successfully');
    }
}
