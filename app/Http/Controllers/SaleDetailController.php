<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SaleDetail;
use App\Models\ExportFormApparel;
use App\DataTables\SaleDetailDataTable;

class SaleDetailController extends Controller
{
    public function index(SaleDetailDataTable $dataTable)
    {
        return $dataTable->render('sales.index');
    }

    public function add()
    {
        return view('sales.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'invoice_no'        => 'required|string',
            'buyer_contract'    => 'nullable|string',
            'order_no'          => 'nullable|string',
            'style_no'          => 'nullable|string',
            'product_type'      => 'nullable|string',
            'shipped_qty'       => 'nullable|numeric',
            'carton_qty'        => 'nullable|numeric',
            'shipped_fob_value' => 'nullable|numeric',
            'shipped_cm_value'  => 'nullable|numeric',
            'cbm_value'         => 'nullable|numeric',
            'gross_wet'         => 'nullable|numeric',
            'net_wet'           => 'nullable|numeric',
            'eta_date'          => 'nullable|date',
            'vessel_name'       => 'nullable|string',
            'shipbording_date'  => 'nullable|date',
            'bl_no'             => 'nullable|string',
            'bl_date'           => 'nullable|date',
            'final_qty'         => 'nullable|numeric',
            'final_fob'         => 'nullable|numeric',
            'final_cm'          => 'nullable|numeric',
            'remarks'           => 'nullable|string',
        ]);

        $export = ExportFormApparel::where('invoice_no', $request->invoice_no)->first();
        if (!$export) {
            return redirect()->route('sales.add')->with('error', 'Invoice not created yet.');
        }

        // ✅ Site access check
        if ($export->invoice_site !== auth()->user()->site) {
            return redirect()->route('sales.add')->with('error', 'You only have access to your own site.');
        }

        if (SaleDetail::where('invoice_no', $request->invoice_no)->exists()) {
            return redirect()->route('sales.add')->with('error', 'Invoice already added.');
        }

        $sd = new SaleDetail();
        $sd->fill($request->only([
            'invoice_no','buyer_contract','order_no','style_no','product_type',
            'shipped_qty','carton_qty','shipped_fob_value','shipped_cm_value',
            'cbm_value','gross_wet','net_wet','eta_date','vessel_name',
            'shipbording_date','bl_no','bl_date','final_qty','final_fob',
            'final_cm','remarks'
        ]));
        $sd->created_by = auth()->user()->emp_id;
        $sd->save();

        return redirect()->route('sales.add')->with('success', 'Sale Information added successfully.');
    }

    public function details($id)
    {
        $s = SaleDetail::find($id);
        if (!$s) {
            return redirect()->route('sales.index')->with('error', 'Sale record not found.');
        }

        // ✅ Site access check
        if ($s->exportFormApparel && $s->exportFormApparel->invoice_site !== auth()->user()->site) {
            return redirect()->route('sales.index')->with('error', 'You only have access to your own site.');
        }

        return view('sales.details', compact('s'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'buyer_contract'    => 'nullable|string',
            'order_no'          => 'nullable|string',
            'style_no'          => 'nullable|string',
            'product_type'      => 'nullable|string',
            'shipped_qty'       => 'nullable|numeric',
            'carton_qty'        => 'nullable|numeric',
            'shipped_fob_value' => 'nullable|numeric',
            'shipped_cm_value'  => 'nullable|numeric',
            'cbm_value'         => 'nullable|numeric',
            'gross_wet'         => 'nullable|numeric',
            'net_wet'           => 'nullable|numeric',
            'eta_date'          => 'nullable|date',
            'vessel_name'       => 'nullable|string',
            'shipbording_date'  => 'nullable|date',
            'bl_no'             => 'nullable|string',
            'bl_date'           => 'nullable|date',
            'final_qty'         => 'nullable|numeric',
            'final_fob'         => 'nullable|numeric',
            'final_cm'          => 'nullable|numeric',
            'remarks'           => 'nullable|string',
        ]);

        $sd = SaleDetail::find($id);
        if (!$sd) {
            return redirect()->route('sales.index')->with('error', 'Sale record not found.');
        }

        // ✅ Site access check
        if ($sd->exportFormApparel && $sd->exportFormApparel->invoice_site !== auth()->user()->site) {
            return redirect()->route('sales.index')->with('error', 'You only have access to your own site.');
        }

        $sd->fill($request->only([
            'buyer_contract','order_no','style_no','product_type',
            'shipped_qty','carton_qty','shipped_fob_value','shipped_cm_value',
            'cbm_value','gross_wet','net_wet','eta_date','vessel_name',
            'shipbording_date','bl_no','bl_date','final_qty','final_fob',
            'final_cm','remarks'
        ]));
        $sd->updated_by = auth()->user()->emp_id;
        $sd->save();

        return redirect()->route('sales.details', $sd->id)->with('success', 'Successfully updated.');
    }

    public function delete($id)
    {
        $sd = SaleDetail::find($id);
        if (!$sd) {
            return redirect()->route('sales.index')->with('error', 'Sale record not found.');
        }

        // ✅ Site access check
        if ($sd->exportFormApparel && $sd->exportFormApparel->invoice_site !== auth()->user()->site) {
            return redirect()->route('sales.index')->with('error', 'You only have access to your own site.');
        }

        $sd->delete();
        return redirect()->route('sales.index')->with('success', 'Sale Information deleted successfully.');
    }
}
