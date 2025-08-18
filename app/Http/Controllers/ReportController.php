<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\ReportExport;
use App\Models\ExportFormApparel;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;


class ReportController extends Controller
{


    public function masterReport(){
        return view('reports.master');
    }



        // public function report()
        // {
        //     try {
        //         $data = ExportFormApparel::first();
        //         return response()->json($data);
        //     } catch (\Exception $e) {
        //         return response()->json(['error' => $e->getMessage()], 500);
        //     }
        // }

    //single
    public function report(Request $request)
{

    $validated = $request->validate([
        'site'       => 'required|string',
        'invoice_no' => 'nullable|string',
        'start_date' => 'nullable|date',
        'end_date'   => 'nullable|date|after_or_equal:start_date',
    ]);

    $query = ExportFormApparel::with([
        'saleDetail',
        'shipping',
        'billingDetail',
        'logisticsDetail'
    ])->where('invoice_site', auth()->user()->site);

    // ✅ Filter by invoice number
    if (!empty($validated['invoice_no'])) {
        $query->where('invoice_no', $validated['invoice_no']);
    }

    // ✅ Filter by shipping->exp_date
    if (!empty($validated['start_date'])) {
        $query->whereHas('shipping', function ($q) use ($validated) {
            $q->whereDate('ex_factory_date', '>=', $validated['start_date']);
        });
    }

    if (!empty($validated['end_date'])) {
        $query->whereHas('shipping', function ($q) use ($validated) {
            $q->whereDate('ex_factory_date', '<=', $validated['end_date']);
        });
    }

    $data = $query->orderBy('created_at', 'desc')->paginate(20);
    return $data;
    $data->getCollection()->transform(function ($item) {
        return [
            'export'    => collect($item)->except([
                'sale_detail',
                'shipping',
                'billing_detail',
                'logistics_detail'
            ]),
            'sales'     => $item->saleDetail,
            'shipping'  => $item->shipping,
            'billing'   => $item->billingDetail,
            'logistics' => $item->logisticsDetail,
        ];
    });

    return view('reports.master', compact('data'));
}



    public function masterReportExport(Request $request) {
        $export = [
            ['column' => 'invoice_no', 'title' => 'Invoice No'],
            ['column' => 'invoice_date', 'title' => 'Invoice Date'],

            ['column' => 'consignee_name', 'title' => 'Consignee Name'],
            ['column' => 'invoice_site', 'title' => 'Invoice Site'],


            ['column' => 'item_name', 'title' => 'Item Name'],
            ['column' => 'hs_code', 'title' => 'HS Code'],
            ['column' => 'hs_code_second', 'title' => 'HS Code (Second)'],

            ['column' => 'contract_no', 'title' => 'Contract No'],
            ['column' => 'contract_date', 'title' => 'Contract Date'],

            ['column' => 'consignee_site', 'title' => 'Consignee Site'],
            ['column' => 'consignee_country', 'title' => 'Consignee Country'],
            ['column' => 'consignee_address', 'title' => 'Consignee Address'],
            ['column' => 'dst_country_code', 'title' => 'Destination Country Code'],
            ['column' => 'dst_country_name', 'title' => 'Destination Country Name'],
            ['column' => 'dst_country_port', 'title' => 'Destination Country Port'],
            ['column' => 'transport_name', 'title' => 'Transport Name'],
            ['column' => 'transport_address', 'title' => 'Transport Address'],
            ['column' => 'transport_port', 'title' => 'Transport Port'],
            ['column' => 'notify_name', 'title' => 'Notify Name'],
            ['column' => 'notify_address', 'title' => 'Notify Address'],
            ['column' => 'section', 'title' => 'Section'],
            ['column' => 'tt_no', 'title' => 'TT No'],
            ['column' => 'tt_date', 'title' => 'TT Date'],

            ['column' => 'unit', 'title' => 'Unit'],
            ['column' => 'quantity', 'title' => 'Quantity'],
            ['column' => 'currency', 'title' => 'Currency'],
            ['column' => 'amount', 'title' => 'Amount'],
            ['column' => 'cm_percentage', 'title' => 'CM %'],
            ['column' => 'incoterm', 'title' => 'Incoterm'],
            ['column' => 'cm_amount', 'title' => 'CM Amount'],
            ['column' => 'freight_value', 'title' => 'Freight Value'],
            ['column' => 'exp_no', 'title' => 'Export No'],
            ['column' => 'exp_date', 'title' => 'Export Date'],
            ['column' => 'exp_permit_no', 'title' => 'Export Permit No'],
            ['column' => 'bl_no', 'title' => 'BL No'],
            ['column' => 'bl_date', 'title' => 'BL Date'],
            ['column' => 'ex_factory_date', 'title' => 'Ex-Factory Date'],
            ['column' => 'net_wet', 'title' => 'Net Weight'],
            ['column' => 'gross_wet', 'title' => 'Gross Weight'],
            ['column' => 'create_by', 'title' => 'Created By'],
            ['column' => 'update_by', 'title' => 'Updated By'],
        ];

        $sales = [
            ['column' => 'order_no', 'title' => 'Order No'],
            ['column' => 'buyer_contract', 'title' => 'Buyer Contract'],
          ['column' => 'style_no', 'title' => 'Style No'],
          ['column' => 'product_type', 'title' => 'Product Type'],
            ['column' => 'shipped_qty', 'title' => 'Shipped Quantity'],
           ['column' => 'shipped_fob_value', 'title' => 'Shipped FOB Value'],
            ['column' => 'shipped_cm_value', 'title' => 'Shipped CM Value'],
           ['column' => 'carton_qty', 'title' => 'Carton Quantity'],
           ['column' => 'cbm_value', 'title' => 'CBM Value'],
            ['column' => 'gross_wet', 'title' => 'Gross Weight'],
            ['column' => 'net_wet', 'title' => 'Net Weight'],
            ['column' => 'shipbording_date', 'title' => 'Shipboarding Date'],
            ['column' => 'bl_no', 'title' => 'BL No'],
            ['column' => 'bl_date', 'title' => 'BL Date'],
            ['column' => 'eta_date', 'title' => 'ETA Date'],
            ['column' => 'vessel_name', 'title' => 'Vessel Name'],
            ['column' => 'final_qty', 'title' => 'Final Quantity'],
            ['column' => 'final_fob', 'title' => 'Final FOB'],
            ['column' => 'final_cm', 'title' => 'Final CM'],
            ['column' => 'remarks', 'title' => 'Remarks'],
            ['column' => 'created_by', 'title' => 'Created By'],
            ['column' => 'updated_by', 'title' => 'Updated By'],
            ['column' => 'created_at', 'title' => 'Created At'],
            ['column' => 'updated_at', 'title' => 'Updated At'],
        ];

        $shipping = [
            ['column' => 'factory', 'title' => 'Factory'],
            ['column' => 'ex_factory_date', 'title' => 'Ex-Factory Date'],
           ['column' => 'cargorpt_date', 'title' => 'Cargo Report Date'],

            ['column' => 'cnf_agent', 'title' => 'CNF Agent'],
            ['column' => 'vessel_no', 'title' => 'Vessel No'],
            ['column' => 'ep_no', 'title' => 'EP No'],
            ['column' => 'ep_date', 'title' => 'EP Date'],
            ['column' => 'ex_pNo', 'title' => 'Export Permit No'], // Assuming ex_pNo means Export Permit No

          ['column' => 'exp_no', 'title' => 'Export No'],
          ['column' => 'exp_date', 'title' => 'Export Date'],
          ['column' => 'transport_port', 'title' => 'Transport Port'],

            ['column' => 'sb_no', 'title' => 'SB No'],
            ['column' => 'sb_date', 'title' => 'SB Date'],

            ['column' => 'bring_back', 'title' => 'Bring Back'],
            ['column' => 'shipped_out', 'title' => 'Shipped Out'],
            ['column' => 'shipped_cancel', 'title' => 'Shipped Cancelled'],
            ['column' => 'shipped_back', 'title' => 'Shipped Back'],
            ['column' => 'unshipped', 'title' => 'Unshipped'],

            ['column' => 'created_by', 'title' => 'Created By'],
            ['column' => 'updated_by', 'title' => 'Updated By'],
            ['column' => 'created_at', 'title' => 'Created At'],
            ['column' => 'updated_at', 'title' => 'Updated At'],
        ];

        $billing = [
            ['column' => 'id', 'title' => 'ID'],
            // ['column' => 'invoice_no', 'title' => 'Invoice No'],

            ['column' => 'sb_no', 'title' => 'SB No'],
            ['column' => 'sb_date', 'title' => 'SB Date'],
            ['column' => 'doc_submit_date', 'title' => 'Document Submit Date'],

            ['column' => 'hk_courier_no', 'title' => 'HK Courier No'],
            ['column' => 'hk_courier_date', 'title' => 'HK Courier Date'],
            ['column' => 'buyer_courier_no', 'title' => 'Buyer Courier No'],
            ['column' => 'buyer_courier_date', 'title' => 'Buyer Courier Date'],

            ['column' => 'lead_time', 'title' => 'Lead Time'],
            ['column' => 'bank_submit_date', 'title' => 'Bank Submit Date'],

            ['column' => 'mode', 'title' => 'Mode'],
            ['column' => 'bd_thc', 'title' => 'BD THC'],

            ['column' => 'created_by', 'title' => 'Created By'],
            ['column' => 'updated_by', 'title' => 'Updated By'],
            ['column' => 'created_at', 'title' => 'Created At'],
            ['column' => 'updated_at', 'title' => 'Updated At'],
        ];

        $logistics = [
            ['column' => 'id', 'title' => 'ID'],
            // ['column' => 'invoice_no', 'title' => 'Invoice No'],

            ['column' => 'receivable_amount', 'title' => 'Receivable Amount'],
            ['column' => 'doc_process_fee', 'title' => 'Document Processing Fee'],

            ['column' => 'seal_lock_charge', 'title' => 'Seal Lock Charge'],
            ['column' => 'agency_commission', 'title' => 'Agency Commission'],
            ['column' => 'documentation_charge', 'title' => 'Documentation Charge'],
            ['column' => 'transportation_charge', 'title' => 'Transportation Charge'],

            ['column' => 'short_shipment_certificate_fee', 'title' => 'Short Shipment Certificate Fee'],
            ['column' => 'factory_loading_fee', 'title' => 'Factory Loading Fee'],
            ['column' => 'uploading_fee_forwarder_wh', 'title' => 'Uploading Fee (Forwarder WH)'],
            ['column' => 'truck_demurrage_fee_delay_at_depot', 'title' => 'Truck Demurrage Fee (Depot Delay)'],
            ['column' => 'cfs_depot_mixed_cargo_loading_fee', 'title' => 'CFS Depot Mixed Cargo Loading Fee'],
            ['column' => 'customs_misc_remark_reasons_charge', 'title' => 'Customs Miscellaneous Charges'],
            ['column' => 'customs_remark_charge_misc_reasons', 'title' => 'Customs Remarks (Misc Reasons)'],

            ['column' => 'cargo_ho_date', 'title' => 'Cargo Handover Date'],
            ['column' => 'deadline_bill_submission', 'title' => 'Bill Submission Deadline'],
            ['column' => 'bill_received_date', 'title' => 'Bill Received Date'],
            ['column' => 'status', 'title' => 'Status'],
            ['column' => 'forwarder_name', 'title' => 'Forwarder Name'],
            ['column' => 'total_charges', 'title' => 'Total Charges'],

            ['column' => 'created_by', 'title' => 'Created By'],
            ['column' => 'updated_by', 'title' => 'Updated By'],
            ['column' => 'created_at', 'title' => 'Created At'],
            ['column' => 'updated_at', 'title' => 'Updated At'],
        ];

        $table = [
            'export' => $export,
            'sales' => $sales,
            'shipping' => $shipping,
            'billing' => $billing,
            'logistics' => $logistics
        ];
            $validated = $request->validate([
                // 'site' => 'required|array', //multiple
                'site' => 'required|string', //single
                'invoice_no' => 'nullable|string',
                'start_date' => 'nullable|date',
                'end_date' => 'nullable|date|after_or_equal:start_date',
            ]);

            // dd($validated);

            $query = ExportFormApparel::with('saleDetail', 'shipping', 'billingDetail', 'logisticsDetail')->where('invoice_site', auth()->user()->site);

            if (isset($request->invoice_no) && $request->invoice_no !== '') {
                $query->where('invoice_no', $request->invoice_no);
            }

            // ✅ Filter by shipping->exp_date
            if (!empty($validated['start_date'])) {
                $query->whereHas('shipping', function ($q) use ($validated) {
                    $q->whereDate('ex_factory_date', '>=', $validated['start_date']);
                });
            }

            if (!empty($validated['end_date'])) {
                $query->whereHas('shipping', function ($q) use ($validated) {
                    $q->whereDate('ex_factory_date', '<=', $validated['end_date']);
                });
            }
           // $data = $query->orderBy('created_at', 'desc');

            $data = $query->get();

            $transformed = $data->map(function ($item) {
                return [
                    'export' => collect($item)->except(['sale_detail', 'shipping', 'billing_detail', 'logistics_detail']),
                    'sales' => $item->saleDetail,
                    'shipping' => $item->shipping,
                    'billing' => $item->billingDetail,
                    'logistics' => $item->logisticsDetail,
                ];
            });

            $data = $transformed;
            return Excel::download(new ReportExport($data, $table), 'master_report.xlsx');
    }


}
