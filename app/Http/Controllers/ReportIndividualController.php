<?php

namespace App\Http\Controllers;

use App\Models\ExportFormApparel;
use App\Models\BillingDetail;
use App\Models\LogisticsDetail;
use App\Models\SaleDetail;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportIndividualExport;
use Illuminate\Database\Eloquent\Builder;

class ReportIndividualController extends Controller
{
    protected $modules = [
        'export' => [
            'model' => ExportFormApparel::class,
            'relations' => ['saleDetail', 'shipping', 'billingDetail', 'logisticsDetail'],
            'columns' => [
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
                //fob_value
                ['column' => 'fob_value', 'title' => 'FOB Value'],
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
            ],
        ],
        'sales' => [
            'model' => SaleDetail::class,
            'relations' => [],
            'columns' => [
                ['column' => 'invoice_no', 'title' => 'Invoice No'],
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
            ],
        ],
        'shipping' => [
            'model' => Shipping::class,
            'relations' => [],
            'columns' => [
                ['column' => 'invoice_no', 'title' => 'Invoice No'],
                ['column' => 'factory', 'title' => 'Factory'],
                ['column' => 'ex_factory_date', 'title' => 'Ex-Factory Date'],
                ['column' => 'cargorpt_date', 'title' => 'Cargo Report Date'],
                ['column' => 'cnf_agent', 'title' => 'CNF Agent'],
                ['column' => 'vessel_no', 'title' => 'Vessel No'],
                ['column' => 'ep_no', 'title' => 'EP No'],
                ['column' => 'ep_date', 'title' => 'EP Date'],
                ['column' => 'ex_pNo', 'title' => 'Export Permit No'],
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
            ],
        ],
        'billing' => [
            'model' => BillingDetail::class,
            'relations' => [],
            'columns' => [
                ['column' => 'invoice_no', 'title' => 'Invoice No'],
                // ['column' => 'id', 'title' => 'ID'],
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
            ],
        ],
        'logistics' => [
            'model' => LogisticsDetail::class,
            'relations' => [],
            'columns' => [
                ['column' => 'invoice_no', 'title' => 'Invoice No'],
                // ['column' => 'id', 'title' => 'ID'],
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
            ],
        ],
    ];

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $module = 'export';
        $moduleConfig = $this->modules[$module];
        $data = new \Illuminate\Pagination\LengthAwarePaginator([], 0, 20);

        return view('reports.module', [
            'data' => $data,
            'module' => $module,
            'headers' => [$module => $moduleConfig['columns']],
        ]);
    }

    /**
     * Build the base query for reports.
     */
    private function buildReportQuery(array $validated): Builder
    {
        $module = $validated['module'];
        $moduleConfig = $this->modules[$module];
        $user = auth()->user();

        $modelClass = $moduleConfig['model'];
        $modelInstance = new $modelClass;
        $tableName = $modelInstance->getTable();

        $query = $modelClass::query();

        // Eager load relations if they exist
        // if (!empty($moduleConfig['relations'])) {
        //     $query->with($moduleConfig['relations']);
        // }

        // Filter by user's site
        if ($module === 'export') {
            $query->where('invoice_site', $user->site);
        } else {
            $query->whereHas('exportFormApparel', function ($q) use ($user) {
                $q->where('invoice_site', $user->site);
            });
        }

        // Filter by invoice_no
        if (!empty($validated['invoice_no'])) {
            $query->where("$tableName.invoice_no", $validated['invoice_no']);
        }

        // Filter by date range using ex_factory_date from the shipping relation/table
        if (!empty($validated['start_date']) || !empty($validated['end_date'])) {
            $query->whereHas('shipping', function ($q) use ($validated) {
                if (!empty($validated['start_date'])) {
                    $q->whereDate('ex_factory_date', '>=', $validated['start_date']);
                }
                if (!empty($validated['end_date'])) {
                    $q->whereDate('ex_factory_date', '<=', $validated['end_date']);
                }
            });
        }

        // Join shippings only if the model is NOT shipping itself
        if ($tableName !== 'shippings') {
            $query->leftJoin('shippings', "$tableName.invoice_no", '=', 'shippings.invoice_no')
                ->orderByDesc('shippings.ex_factory_date');
        }

        $query->select("$tableName.*");

        return $query;
    }

    public function report(Request $request)
    {
        $validated = $request->validate([
            'module' => 'required|string|in:export,sales,shipping,billing,logistics',
            'invoice_no' => 'nullable|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $query = $this->buildReportQuery($validated);
        $data = $query->paginate(20);

        return view('reports.module', [
            'data' => $data,
            'module' => $validated['module'],
            'headers' => [$validated['module'] => $this->modules[$validated['module']]['columns']],
        ]);
    }

    public function moduleReportExport(Request $request)
    {
        // NOTE: Removed the 'site' validation rule as it was unused.
        $validated = $request->validate([
            'module' => 'required|string|in:export,sales,shipping,billing,logistics',
            'invoice_no' => 'nullable|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $module = $validated['module'];
        $moduleConfig = $this->modules[$module];

        $query = $this->buildReportQuery($validated);
        $data = $query->get(); // Get all results for export

        // Pass the Eloquent Collection directly to the export class.
        // No need for the ->map()->toArray() transformation.
        return Excel::download(
            new ReportIndividualExport($data, [$module => $moduleConfig['columns']], $module),
            "{$module}_report_" . now()->format('Ymd_His') . ".xlsx"
        );
    }
}
