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
        $sd->createad_by = auth()->user()->emp_id;
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
    $invoice = $request->invoice_no;
  // $efa = ExportFormApparel::where('invoice_no', $invoice)->first();  invoice_no like '%$invoice%' select first 10 record
    $efa = ExportFormApparel::where('invoice_no', 'like', '%'.$invoice.'%')->take(10)->get();

    $data = '<table id="dynamicTable" class="table table-striped table-sm m-0 p-0">
    <thead class="table-info">
        <tr>
            <th class="m-0 p-0 fw-bold " >Invoice No</th>
            <th class="m-0 p-0 fw-bold " >Invoice Date</th>
            <th class="m-0 p-0 fw-bold " >Contract No</th>
            <th class="m-0 p-0 fw-bold " >Contract Date</th>
            <th class="m-0 p-0 fw-bold " >Exporter</th>
            <th class="m-0 p-0 fw-bold " >Consignee No</th>
            <th class="m-0 p-0 fw-bold " >Local Port</th>
            <th class="m-0 p-0 fw-bold " >Quantity</th>
            <th class="m-0 p-0 fw-bold " >Amount</th>
            <th class="m-0 p-0 fw-bold " >CM Amount</th>
            <th class="m-0 p-0 fw-bold " >Freight Value</th>
            <th class="m-0 p-0 fw-bold " >FOB</th>
        </tr>
    </thead>
    <tbody>';

    foreach ($efa as $row) {
        $data .= '<tr>
                    <td class="invoiceCell btn-success btn-sm m-0 p-1">' . $row->invoice_no . '</td>
                    <td class="m-0 p-0">' . $row->invoice_date . '</td>
                    <td class="m-0 p-0">' . $row->contract_no . '</td>
                    <td class="m-0 p-0">' . $row->contract_date . '</td>
                    <td class="m-0 p-0">' . $row->site . '</td>
                    <td class="m-0 p-0">' . $row->consignee_name . '</td>
                    <td class="m-0 p-0">' . $row->local_transport . '</td>
                    <td class="m-0 p-0">' . $row->quantity . '</td>
                    <td class="m-0 p-0">' . $row->amount . '</td>
                    <td class="m-0 p-0">' . $row->cm_amount . '</td>
                    <td class="m-0 p-0">' . $row->freight_value . '</td>
                    <td class="m-0 p-0">' . ($row->amount - $row->freight_value) . '</td>
                </tr>';
    }

    $data .= '</tbody>
        </table>';
    echo $data;

}


}
