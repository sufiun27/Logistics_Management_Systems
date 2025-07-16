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
       // return view('sales.index');
    }
    public function add()
    {
        return view('sales.add');
    }
    public function store(Request $request)
    {
        if(!ExportFormApparel::where('invoice_no', $request->invoice_no)->exists()){
            return redirect()->route('shipping.shipping')->with('error', 'Invoice not found in Export Form');
        }
        $sd= new SaleDetail();
        $sd->invoice_no = $request->invoice_no;
        $sd->order_no = $request->order_no;
        $sd->style_no = $request->style_no;
        $sd->product_type = $request->product_type;
        $sd->shipped_qty = $request->shipped_qty;
        $sd->carton_qty = $request->carton_qty;
        $sd->shipped_fob_value = $request->shipped_fob_value;
        $sd->shipped_cm_value = $request->shipped_cm_value;
        $sd->cbm_value = $request->cbm_value;
        $sd->eta_date = $request->eta_date;
        $sd->vessel_name = $request->vessel_name;
        $sd->shipbording_date = $request->shipbording_date;
        $sd->bl_no = $request->bl_no;
        $sd->bl_date = $request->bl_date;
        $sd->final_qty = $request->final_qty;
        $sd->final_fob = $request->final_fob;
        $sd->final_cm = $request->final_cm;
        $sd->remarks = $request->remarks;
        $sd->created_by = auth()->user()->emp_id;
        $sd->save();
        return redirect()->route('sales.add')->with('success', 'Sale Information added Successfully');
}
public function details($id)
{
    $s = SaleDetail::find($id);
    return view('sales.details', compact('s'));

}
public function update(Request $request, $id){
    $sd = SaleDetail::find($id);
    $sd->invoice_no = $request->invoice_no;
        $sd->order_no = $request->order_no;
        $sd->style_no = $request->style_no;
        $sd->product_type = $request->product_type;
        $sd->shipped_qty = $request->shipped_qty;
        $sd->carton_qty = $request->carton_qty;
        $sd->shipped_fob_value = $request->shipped_fob_value;
        $sd->shipped_cm_value = $request->shipped_cm_value;
        $sd->cbm_value = $request->cbm_value;
        $sd->eta_date = $request->eta_date;
        $sd->vessel_name = $request->vessel_name;
        $sd->shipbording_date = $request->shipbording_date;
        $sd->bl_no = $request->bl_no;
        $sd->bl_date = $request->bl_date;
        $sd->final_qty = $request->final_qty;
        $sd->final_fob = $request->final_fob;
        $sd->final_cm = $request->final_cm;
        $sd->remarks = $request->remarks;
        $sd->updated_by = auth()->user()->emp_id;
        $sd->save();
        $s=$sd;
        return view('sales.details', compact('s'))->with('success', 'Successfully Updated');
}
public function delete($id){
    $sd = SaleDetail::find($id);
    $sd->delete();
    return redirect()->route('sales.index')->with('success', 'Sale Information Deleted Successfully');
}


public function getInvoice(Request $request)
{
    $invoice = $request->input('invoice_no');

    $efa = ExportFormApparel::where('invoice_no', 'like', '%' . $invoice . '%')
                ->take(10)
                ->get();

    if ($efa->isEmpty()) {
        return '<p class="text-muted">No matching invoices found.</p>';
    }

    $data = '<table id="dynamicTable" class="table table-striped table-sm m-0 p-0">
        <thead class="table-info">
            <tr>
                <th>Invoice No</th>
                <th>Invoice Date</th>
                <th>Contract No</th>
                <th>Contract Date</th>
                <th>Exporter</th>
                <th>Consignee No</th>
                <th>Local Port</th>
                <th>Quantity</th>
                <th>Amount</th>
                <th>CM Amount</th>
                <th>Freight Value</th>
                <th>FOB</th>
            </tr>
        </thead>
        <tbody>';

    foreach ($efa as $row) {
        $data .= '<tr>
            <td class="invoiceCell btn-success btn-sm m-0 p-1" style="cursor:pointer;">' . $row->invoice_no . '</td>
            <td>' . $row->invoice_date . '</td>
            <td>' . $row->contract_no . '</td>
            <td>' . $row->contract_date . '</td>
            <td>' . $row->site . '</td>
            <td>' . $row->consignee_name . '</td>
            <td>' . $row->local_transport . '</td>
            <td>' . $row->quantity . '</td>
            <td>' . $row->amount . '</td>
            <td>' . $row->cm_amount . '</td>
            <td>' . $row->freight_value . '</td>
            <td>' . ($row->amount - $row->freight_value) . '</td>
        </tr>';
    }

    $data .= '</tbody></table>';

    return $data; // returning as HTML string for ajax
}



}
