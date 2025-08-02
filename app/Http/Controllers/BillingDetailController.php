<?php

namespace App\Http\Controllers;

use App\Models\BillingDetail;
use App\Models\ExportFormApparel;
use App\DataTables\BillingDetailDataTable;
use Illuminate\Http\Request;

class BillingDetailController extends Controller
{
    public function indexBilling(BillingDetailDataTable $dataTable)
    {
        return $dataTable->render('billing.indexBilling');
    }

    public function addBilling()
    {
        return view('billing.addBilling');
    }

    public function storeBilling(Request $request)
    {
        $request->validate([
            'invoice_no'         => 'required|string',
            'sb_no'              => 'nullable|string',
            'sb_date'            => 'nullable|date',
            'doc_submit_date'    => 'nullable|date',
            'hk_courier_no'      => 'nullable|string',
            'hk_courier_date'    => 'nullable|date',
            'buyer_courier_no'   => 'nullable|string',
            'buyer_courier_date' => 'nullable|date',
            'lead_time'          => 'nullable|numeric',
            'bank_submit_date'   => 'nullable|date',
            'mode'               => 'nullable|string',
            'bd_thc'             => 'nullable|numeric',
        ]);

        $export = ExportFormApparel::where('invoice_no', $request->invoice_no)->first();
        if (!$export) {
            return redirect()->back()->with('error', 'Invoice not found in Export Form');
        }

        // ✅ Site access check
        if ($export->invoice_site !== auth()->user()->site) {
            return redirect()->route('billing.addBilling')->with('error', 'You only have access to your own site.');
        }

        if (BillingDetail::where('invoice_no', $request->invoice_no)->exists()) {
            return redirect()->route('billing.addBilling')->with('error', 'Invoice already added');
        }

        $b = new BillingDetail();
        $b->fill($request->only([
            'invoice_no','sb_no','sb_date','doc_submit_date','hk_courier_no','hk_courier_date',
            'buyer_courier_no','buyer_courier_date','lead_time','bank_submit_date','mode','bd_thc'
        ]));
        $b->created_by = auth()->user()->emp_id;
        $b->save();

        return redirect()->route('billing.addBilling')->with('success', 'Billing Information added successfully');
    }

    public function editBilling($id)
    {
        $b = BillingDetail::find($id);
        if (!$b) {
            return redirect()->route('billing.indexBilling')->with('error', 'Billing record not found');
        }

        // ✅ Site access check
        if ($b->exportFormApparel && $b->exportFormApparel->invoice_site !== auth()->user()->site) {
            return redirect()->route('billing.indexBilling')->with('error', 'You only have access to your own site.');
        }

        return view('billing.editBilling', compact('b'));
    }

    public function updateBilling(Request $request, $id)
    {
        $request->validate([
            'sb_no'              => 'nullable|string',
            'sb_date'            => 'nullable|date',
            'doc_submit_date'    => 'nullable|date',
            'hk_courier_no'      => 'nullable|string',
            'hk_courier_date'    => 'nullable|date',
            'buyer_courier_no'   => 'nullable|string',
            'buyer_courier_date' => 'nullable|date',
            'lead_time'          => 'nullable|numeric',
            'bank_submit_date'   => 'nullable|date',
            'mode'               => 'nullable|string',
            'bd_thc'             => 'nullable|numeric',
        ]);

        $b = BillingDetail::find($id);
        if (!$b) {
            return redirect()->route('billing.indexBilling')->with('error', 'Billing record not found');
        }

        // ✅ Site access check
        if ($b->exportFormApparel && $b->exportFormApparel->invoice_site !== auth()->user()->site) {
            return redirect()->route('billing.indexBilling')->with('error', 'You only have access to your own site.');
        }

        $b->fill($request->only([
            'sb_no','sb_date','doc_submit_date','hk_courier_no','hk_courier_date',
            'buyer_courier_no','buyer_courier_date','lead_time','bank_submit_date','mode','bd_thc'
        ]));
        $b->updated_by = auth()->user()->emp_id;
        $b->save();

        return redirect()->route('billing.editBilling', $id)->with('success', 'Billing Information updated successfully');
    }

    public function deleteBilling($id)
    {
        $b = BillingDetail::find($id);
        if (!$b) {
            return redirect()->route('billing.indexBilling')->with('error', 'Billing record not found');
        }

        // ✅ Site access check
        if ($b->exportFormApparel && $b->exportFormApparel->invoice_site !== auth()->user()->site) {
            return redirect()->route('billing.indexBilling')->with('error', 'You only have access to your own site.');
        }

        $b->delete();
        return redirect()->route('billing.indexBilling')->with('success', 'Billing Information deleted successfully');
    }
}
