<?php

namespace App\Http\Controllers;

use App\Models\Shipping;
use App\Models\Transport;
use App\Models\ExportFormApparel;
use Illuminate\Http\Request;
use App\DataTables\ShippingDataTable;

class ShippingController extends Controller
{
    public function shipping(ShippingDataTable $dataTable)
    {
        return $dataTable->render('shipping.shipping');
    }

    public function addShipping()
    {
        $transports = Transport::all();
        return view('shipping.addShipping', compact('transports'));
    }

    public function storeShipmentStatusInfo(Request $request)
    {
        $request->validate([
            'invoice_no'       => 'required|string',
            'factory'          => 'required|string',
            'ep_no'            => 'required|string',
            'ep_date'          => 'required|date',
            'exp_no'           => 'required|string',
            'exp_date'         => 'required|date',
            'ex_factory_date'  => 'required|date',
            'sb_no'            => 'required|string',
            'sb_date'          => 'required|date',
        ]);

        // Check invoice exists in ExportFormApparel
        $exportFormApparel = ExportFormApparel::where('invoice_no', $request->invoice_no)->first();
        if (!$exportFormApparel) {
            return redirect()->route('shipping.shipping')->with('error', 'Invoice not found in Export Form');
        }

        // Prevent duplicate shipping entry
        if (Shipping::where('invoice_no', $request->invoice_no)->exists()) {
            return redirect()->route('shipping.addShipping')->with('error', 'Invoice already added');
        }

        // ✅ Check site access
        if (!$this->checkUserAccess($exportFormApparel)) {
            return redirect()->back()->with('error', 'You only have access to your own site.');
        }

        $ssi = new Shipping();
        $ssi->fill($request->only([
            'invoice_no','factory','ep_no','ep_date','exp_no','exp_date',
            'ex_factory_date','sb_no','sb_date','transport_port','cnf_agent',
            'vessel_no','cargorpt_date','bring_back','shipped_out','shipped_cancel',
            'shipped_back','unshipped'
        ]));
        $ssi->created_by = auth()->user()->emp_id;
        $ssi->save();

        return redirect()->route('shipping.shipping')->with('success', 'Shipment Information Added Successfully');
    }

    public function ShippingDetails($id)
    {
        $shipping = Shipping::find($id);
        if (!$shipping) {
            return redirect()->back()->with('error', 'Shipping record not found.');
        }

        $exportFormApparel = ExportFormApparel::where('invoice_no', $shipping->invoice_no)->first();
        if (!$exportFormApparel || !$this->checkUserAccess($exportFormApparel)) {
            return redirect()->back()->with('error', 'You only have access to your own site.');
        }

        return view('shipping.ShippingDetails', compact('shipping'));
    }

    public function addShipmentOtherInfo($id)
    {
        $invoice_no = $id;
        $transports = Transport::all();
        return view('shipping.addShipmentOtherInfo', compact('invoice_no','transports'));
    }

    public function storeShipmentOtherInfo(Request $request)
    {
        $request->validate([
            'invoice_no'     => 'required|string',
            'transport_port' => 'required|string',
        ]);

        $soi = Shipping::where('invoice_no', $request->invoice_no)->first();
        if (!$soi) {
            return redirect()->back()->with('error', 'Shipping record not found.');
        }

        $exportFormApparel = ExportFormApparel::where('invoice_no', $soi->invoice_no)->first();
        if (!$exportFormApparel || !$this->checkUserAccess($exportFormApparel)) {
            return redirect()->back()->with('error', 'You only have access to your own site.');
        }

        $soi->fill($request->only(['transport_port','cnf_agent','vessel_no','cargorpt_date']));
        $soi->updated_by = auth()->user()->emp_id;
        $soi->save();

        return redirect()->route('shipping.addShipmentOtherInfo1', $request->invoice_no)
                         ->with('success', 'Other Information Updated Successfully');
    }

    public function addInvoiceRemarks($id)
    {
        return view('shipping.addInvoiceRemarks', ['invoice_no' => $id]);
    }

    public function updateShipping($id)
    {
        $shipping = Shipping::find($id);
        if (!$shipping) {
            return redirect()->back()->with('error', 'Shipping record not found.');
        }

        $exportFormApparel = ExportFormApparel::where('invoice_no', $shipping->invoice_no)->first();
        if (!$exportFormApparel || !$this->checkUserAccess($exportFormApparel)) {
            return redirect()->back()->with('error', 'You only have access to your own site.');
        }

        $transports = Transport::all();
        return view('shipping.updateShipping', compact('shipping','transports'));
    }

    public function updateShippingStatusInfo(Request $request, $id)
    {
        $request->validate([
            'factory'         => 'required|string',
            'ep_no'           => 'required|string',
            'ep_date'         => 'required|date',
            'exp_no'          => 'required|string',
            'exp_date'        => 'required|date',
            'ex_factory_date' => 'required|date',
            'sb_no'           => 'required|string',
            'sb_date'         => 'required|date',
        ]);

        $shipping = Shipping::find($id);
        if (!$shipping) {
            return redirect()->back()->with('error', 'Shipping record not found.');
        }

        $exportFormApparel = ExportFormApparel::where('invoice_no', $shipping->invoice_no)->first();
        if (!$exportFormApparel || !$this->checkUserAccess($exportFormApparel)) {
            return redirect()->back()->with('error', 'You only have access to your own site.');
        }

        $shipping->fill($request->only([
            'factory','ep_no','ep_date','exp_no','exp_date',
            'ex_factory_date','sb_no','sb_date'
        ]));
        $shipping->updated_by = auth()->user()->emp_id;
        $shipping->save();

        return redirect()->route('shipping.updateShipping', $shipping->id)
                         ->with('success', 'Shipment Status Information Updated Successfully');
    }

    public function updateOtherInformation(Request $request, $id)
    {
        $shipping = Shipping::find($id);
        if (!$shipping) {
            return redirect()->back()->with('error', 'Shipping record not found.');
        }

        $shipping->fill($request->only(['transport_port','cnf_agent','vessel_no','cargorpt_date']));
        $shipping->updated_by = auth()->user()->emp_id;
        $shipping->save();

        return redirect()->route('shipping.updateShipping', $shipping->id)
                         ->with('success', 'Other Information Updated Successfully');
    }

    public function updateRemarks(Request $request, $id)
    {
        $shipping = Shipping::find($id);
        if (!$shipping) {
            return redirect()->back()->with('error', 'Shipping record not found.');
        }

        $shipping->fill($request->only(['bring_back','shipped_out','shipped_cancel','shipped_back','unshipped']));
        $shipping->updated_by = auth()->user()->emp_id;
        $shipping->save();

        return redirect()->route('shipping.updateShipping', $shipping->id)
                         ->with('success', 'Remarks Updated Successfully');
    }

    /**
     * ✅ Centralized site access check
     */
    private function checkUserAccess($exportFormApparel)
    {
        $user = auth()->user();
        return $exportFormApparel->invoice_site === $user->site;
    }
}
