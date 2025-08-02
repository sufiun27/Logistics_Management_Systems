<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExportFormApparel;

class GetInvoiceController extends Controller
{
    public function getInvoice(Request $request)
    {
        $invoice = $request->invoice_no;
        $user= auth()->user();
      // $efa = ExportFormApparel::where('invoice_no', $invoice)->first();  invoice_no like '%$invoice%' select first 10 record
        $efa = ExportFormApparel::where('invoice_no', 'like', '%'.$invoice.'%')
        ->where('invoice_site', $user->site)
        ->take(10)->get();

        $data = '<table id="dynamicTable" class="table table-striped table-sm m-0 p-0">
        <thead class="table-info">
            <tr>
                <th class="m-0 p-0 fw-bold " >Invoice No</th>
                <th class="m-0 p-0 fw-bold " >Site</th>
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
                        <td class="m-0 p-0">' . $row->invoice_site . '</td>
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
