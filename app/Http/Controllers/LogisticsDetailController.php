<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LogisticsDetail;
use App\Models\ExportFormApparel;
use App\DataTables\LogisticsDetailDataTable;

class LogisticsDetailController extends Controller
{
    public function data(LogisticsDetailDataTable $dataTable)
{
    return $dataTable->ajax();
}
    public function indexLogistics(Request $request)
    {
        $request->validate([
            'invoice_no' => 'nullable|string|max:255', // Allow nullable, add max length
        ]);
        $invoice_no = $request->input('invoice_no');

        $data = LogisticsDetail::query();
        if ($invoice_no) {
            $data = $data->where('invoice_no', 'like', '%' . $invoice_no . '%'); // Case-insensitive search
        }
        $data = $data->with('exportFormApparel')
            ->whereHas('exportFormApparel', function ($query) {
                $query->where('invoice_site', auth()->user()->site ?? 'default'); // Fallback for null user
            });

        $data = $data->orderByDesc('created_at')->paginate(25);
        return view('logistics.indexLogistics', compact('data'));

        //'logistics.indexLogistics');
    }

    public function addLogistics()
    {
        return view('logistics.addLogistics');
    }

    public function storeLogistics(Request $request)
    {
        $request->validate([
            'invoice_no'                      => 'required|string',
            'receivable_amount'               => 'nullable|numeric',
            'doc_process_fee'                 => 'nullable|numeric',
            'seal_lock_charge'                => 'nullable|numeric',
            'agency_commission'               => 'nullable|numeric',
            'documentation_charge'            => 'nullable|numeric',
            'transportation_charge'           => 'nullable|numeric',
            'short_shipment_certificate_fee'  => 'nullable|numeric',
            'factory_loading_fee'             => 'nullable|numeric',
            'uploading_fee_forwarder_wh'      => 'nullable|numeric',
            'truck_demurrage_fee_delay_at_depot' => 'nullable|numeric',
            'cfs_depot_mixed_cargo_loading_fee' => 'nullable|numeric',
            'customs_misc_remark_reasons_charge' => 'nullable|numeric',
            'customs_remark_charge_misc_reasons' => 'nullable|numeric',
            'cargo_ho_date'                   => 'nullable|date',
            'deadline_bill_submission'        => 'nullable|date',
            'bill_received_date'              => 'nullable|date',
            'status'                          => 'nullable|string',
            'forwarder_name'                  => 'nullable|string',
            'total_charges'                   => 'nullable|numeric',
        ]);

        $export = ExportFormApparel::where('invoice_no', $request->invoice_no)->first();
        if (!$export) {
            return redirect()->route('logistics.addLogistics')->with('error', 'Invoice not found in Export Form');
        }

        // ✅ Site access control
        if ($export->invoice_site !== auth()->user()->site) {
            return redirect()->route('logistics.addLogistics')->with('error', 'You only have access to your own site.');
        }

        if (LogisticsDetail::where('invoice_no', $request->invoice_no)->exists()) {
            return redirect()->route('logistics.addLogistics')->with('error', 'Invoice already added');
        }

        $ld = new LogisticsDetail();
        $ld->fill($request->only([
            'invoice_no','receivable_amount','doc_process_fee','seal_lock_charge',
            'agency_commission','documentation_charge','transportation_charge',
            'short_shipment_certificate_fee','factory_loading_fee','uploading_fee_forwarder_wh',
            'truck_demurrage_fee_delay_at_depot','cfs_depot_mixed_cargo_loading_fee',
            'customs_misc_remark_reasons_charge','customs_remark_charge_misc_reasons',
            'cargo_ho_date','deadline_bill_submission','bill_received_date','status',
            'forwarder_name','total_charges'
        ]));
        $ld->created_by = auth()->user()->emp_id;
        $ld->save();

        return redirect()->route('logistics.addLogistics')->with('success', 'Logistics Information added successfully');
    }

    public function editLogistics($id)
    {
        $l = LogisticsDetail::find($id);
        if (!$l) {
            return redirect()->route('logistics.indexLogistics')->with('error', 'Logistics record not found');
        }

        // ✅ Site access control
        if ($l->exportFormApparel && $l->exportFormApparel->invoice_site !== auth()->user()->site) {
            return redirect()->route('logistics.indexLogistics')->with('error', 'You only have access to your own site.');
        }

        return view('logistics.editLogistics', compact('l'));
    }

    public function updateLogistics(Request $request, $id)
    {
        $request->validate([
            'receivable_amount'               => 'nullable|numeric',
            'doc_process_fee'                 => 'nullable|numeric',
            'seal_lock_charge'                => 'nullable|numeric',
            'agency_commission'               => 'nullable|numeric',
            'documentation_charge'            => 'nullable|numeric',
            'transportation_charge'           => 'nullable|numeric',
            'short_shipment_certificate_fee'  => 'nullable|numeric',
            'factory_loading_fee'             => 'nullable|numeric',
            'uploading_fee_forwarder_wh'      => 'nullable|numeric',
            'truck_demurrage_fee_delay_at_depot' => 'nullable|numeric',
            'cfs_depot_mixed_cargo_loading_fee' => 'nullable|numeric',
            'customs_misc_remark_reasons_charge' => 'nullable|numeric',
            'customs_remark_charge_misc_reasons' => 'nullable|numeric',
            'cargo_ho_date'                   => 'nullable|date',
            'deadline_bill_submission'        => 'nullable|date',
            'bill_received_date'              => 'nullable|date',
            'status'                          => 'nullable|string',
            'forwarder_name'                  => 'nullable|string',
            'total_charges'                   => 'nullable|numeric',
        ]);

        $ld = LogisticsDetail::find($id);
        if (!$ld) {
            return redirect()->route('logistics.indexLogistics')->with('error', 'Logistics record not found');
        }

        // ✅ Site access control
        if ($ld->exportFormApparel && $ld->exportFormApparel->invoice_site !== auth()->user()->site) {
            return redirect()->route('logistics.indexLogistics')->with('error', 'You only have access to your own site.');
        }

        $ld->fill($request->only([
            'receivable_amount','doc_process_fee','seal_lock_charge','agency_commission',
            'documentation_charge','transportation_charge','short_shipment_certificate_fee',
            'factory_loading_fee','uploading_fee_forwarder_wh','truck_demurrage_fee_delay_at_depot',
            'cfs_depot_mixed_cargo_loading_fee','customs_misc_remark_reasons_charge',
            'customs_remark_charge_misc_reasons','cargo_ho_date','deadline_bill_submission',
            'bill_received_date','status','forwarder_name','total_charges'
        ]));
        $ld->updated_by = auth()->user()->emp_id;
        $ld->save();

        return redirect()->route('logistics.editLogistics', $id)->with('success', 'Logistics Information updated successfully');
    }

    public function deleteLogistics($id)
    {
        $ld = LogisticsDetail::find($id);
        if (!$ld) {
            return redirect()->route('logistics.indexLogistics')->with('error', 'Logistics record not found');
        }

        // ✅ Site access control
        if ($ld->exportFormApparel && $ld->exportFormApparel->invoice_site !== auth()->user()->site) {
            return redirect()->route('logistics.indexLogistics')->with('error', 'You only have access to your own site.');
        }

        $ld->delete();
        return redirect()->route('logistics.indexLogistics')->with('success', 'Logistics Information deleted successfully');
    }
}
