<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\ShippingDataTable;
use App\Models\ExportFormApparel;
use App\Models\Shipping;
use App\Models\Transport;

class ShippingController extends Controller
{
    //shipping.shipping
    public function shipping(ShippingDataTable $dataTable)
    {
        return $dataTable->render('shipping.shipping');
    }

    //addShipping
    public function addShipping()
    {
        $transports = Transport::all();
        return view('shipping.addShipping',compact('transports'));
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

    public function storeShipmentStatusInfo(Request $request)
    {
        $request->validate([
            'invoice_no' => 'required|unique:shippings',
            'ep_no' => 'required',
            'ep_date' => 'required',
            'exp_no' => 'required',
            'exp_date' => 'required',
            'ex_factory_date' => 'required',
            'sb_no' => 'required',
            'sb_date' => 'required',
        ]);

        if(!ExportFormApparel::where('invoice_no', $request->invoice_no)->exists()){
            return redirect()->route('shipping.shipping')->with('error', 'Invoice not found in Export Form');
        }

        $ssi= new Shipping();
        $ssi->invoice_no = $request->invoice_no;
        $ssi->ep_no = $request->ep_no;
        $ssi->ep_date = $request->ep_date;
        $ssi->exp_no = $request->exp_no;
        $ssi->exp_date = $request->exp_date;
        $ssi->ex_factory_date = $request->ex_factory_date;
        $ssi->sb_no = $request->sb_no;
        $ssi->sb_date = $request->sb_date;

        $ssi->transport_port = $request->transport_port;
        $ssi->cnf_agent = $request->cnf_agent;
        $ssi->vessel_no = $request->vessel_no;
        $ssi->cargorpt_date = $request->cargorpt_date;

        $ssi->bring_back = $request->bring_back;
        $ssi->shipped_out = $request->shipped_out;
        $ssi->shipped_cancel = $request->shipped_cancel;
        $ssi->shipped_back = $request->shipped_back;
        $ssi->unshipped = $request->unshipped;

        $ssi->created_by = auth()->user()->emp_id;
        $ssi->save();
        
        return redirect()->route('shipping.addShipping')->with('success', 'Shipment Information Updated Successfully');
    }


    //ShippingDetails
    public function ShippingDetails($id){
        
        $shipping = Shipping::find($id);
        return view('shipping.ShippingDetails',compact('shipping'));
    }
    //storeShipmentOtherInfo
    

    public function addShipmentOtherInfo($id){

        $invoice_no = $id;
        $transports = Transport::all();
        return view('shipping.addShipmentOtherInfo',compact('invoice_no','transports'));
       // return route('shipping.storeShipmentOtherInfo',compact('invoice_no'));
    }
    //storeShipmentOtherInfo
    public function storeShipmentOtherInfo(Request $request){
        //dd($request->all());
        $request->validate([
           'transport_port'=>'required', 
        ]);
        $invoice_no = $request->invoice_no;
        
        $soi= Shipping::where('invoice_no',$request->invoice_no)->first();
        $soi->transport_port = $request->transport_port;
        $soi->cnf_agent = $request->cnf_agent;
        $soi->vessel_no = $request->vessel_no;
        $soi->cargorpt_date = $request->cargorpt_date;
        $soi->save();
        return redirect()->route('shipping.addShipmentOtherInfo1',$invoice_no)->with('success', 'Other Information Updated Successfully');
    }


    //addInvoiceRemarks
    public function addInvoiceRemarks($id){
        $invoice_no = $id;
        return view('shipping.addInvoiceRemarks',compact('invoice_no'));
    }

    //updateShipping
    public function updateShipping($id){
        $shipping = Shipping::find($id);
        $transports = Transport::all();
        return view('shipping.updateShipping',compact('shipping','transports'));
    }

    public function updateShippingStatusInfo(Request $request, $id){
        $shipping = Shipping::find($id);
        $shipping->ep_no = $request->ep_no;
        $shipping->ep_date = $request->ep_date;
        $shipping->exp_no = $request->exp_no;
        $shipping->exp_date = $request->exp_date;
        $shipping->ex_factory_date = $request->ex_factory_date;
        $shipping->sb_no = $request->sb_no;
        $shipping->sb_date = $request->sb_date;
        $shipping->updated_by = auth()->user()->emp_id;
        $shipping->save();
        return redirect()->route('shipping.updateShipping',$shipping->id)->with('success', 'Shipment Status Information Updated Successfully');
    }

    public function updateOtherInformation(Request $request, $id){
        $shipping = Shipping::find($id);
        $shipping->transport_port = $request->transport_port;
        $shipping->cnf_agent = $request->cnf_agent;
        $shipping->vessel_no = $request->vessel_no;
        $shipping->cargorpt_date = $request->cargorpt_date;
        $shipping->updated_by = auth()->user()->emp_id;
        $shipping->save();
        return redirect()->route('shipping.updateShipping',$shipping->id)->with('success', 'Other Information Updated Successfully');
        
    }

    public function updateRemarks(Request $request, $id){
        $shipping = Shipping::find($id);
        $shipping->bring_back = $request->bring_back;
        $shipping->shipped_out = $request->shipped_out;
        $shipping->shipped_cancel = $request->shipped_cancel;
        $shipping->shipped_back = $request->shipped_back;
        $shipping->unshipped = $request->unshipped;
        $shipping->updated_by = auth()->user()->emp_id;
        $shipping->save();
        return redirect()->route('shipping.updateShipping',$shipping->id)->with('success', 'Remarks Updated Successfully');
    }
}
