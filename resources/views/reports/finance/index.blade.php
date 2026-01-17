@extends('template.index')

@section('content')

    @php
        use App\Models\User;
        use App\Models\Export;

        $user = auth()->user();
        $exporters = Export::all();
    @endphp



    @php
        // 1. Export Start
        $export = [
            ['column' => 'invoice_site', 'title' => 'Invoice Site', 'table' => 'export'],
            ['column' => 'invoice_no', 'title' => 'Invoice No', 'table' => 'export'],
            ['column' => 'invoice_date', 'title' => 'Invoice Date', 'table' => 'export'],
            ['column' => 'consignee_name', 'title' => 'Consignee Name', 'table' => 'export'],

            // Basic Info
            ['column' => 'factory', 'title' => 'Factory', 'table' => 'shipping'],
            ['column' => 'buyer_contract', 'title' => 'Buyer Contract', 'table' => 'sales'],
            ['column' => 'contract_date', 'title' => 'Contract Date', 'table' => 'export'],
            ['column' => 'order_no', 'title' => 'Order No', 'table' => 'sales'],
            ['column' => 'style_no', 'title' => 'Style No', 'table' => 'sales'],
            ['column' => 'item_name', 'title' => 'Item Name', 'table' => 'export'],
            ['column' => 'product_type', 'title' => 'Product Type', 'table' => 'sales'],

            // Dates & Logistics
            ['column' => 'ex_factory_date', 'title' => 'Ex-Factory Date', 'table' => 'shipping'],
            ['column' => 'cargorpt_date', 'title' => 'Cargo Report Date', 'table' => 'shipping'],
            ['column' => 'shipbording_date', 'title' => 'Shipboarding Date', 'table' => 'sales'],
            ['column' => 'bl_no', 'title' => 'BL No', 'table' => 'sales'],
            ['column' => 'bl_date', 'title' => 'BL Date', 'table' => 'sales'],
            ['column' => 'eta_date', 'title' => 'ETA Date', 'table' => 'sales'],
            ['column' => 'incoterm', 'title' => 'Incoterm', 'table' => 'sales'],

            // Shipment Values
            ['column' => 'shipped_qty', 'title' => 'Shipped Quantity', 'table' => 'sales'],
            ['column' => 'shipped_fob_value', 'title' => 'Shipped FOB Value', 'table' => 'sales'],
            ['column' => 'shipped_cm_value', 'title' => 'Shipped CM Value', 'table' => 'sales'],
            ['column' => 'carton_qty', 'title' => 'Carton Quantity', 'table' => 'sales'],
            ['column' => 'cbm_value', 'title' => 'CBM Value', 'table' => 'sales'],

            // Shipping Info
            ['column' => 'transport_port', 'title' => 'Transport Port', 'table' => 'shipping'],
            ['column' => 'exp_no', 'title' => 'Exp No', 'table' => 'shipping'],
            ['column' => 'exp_date', 'title' => 'Exp Date', 'table' => 'shipping'],
            ['column' => 'vessel_no', 'title' => 'Vessel No', 'table' => 'shipping'],
            ['column' => 'vessel_name', 'title' => 'Vessel Name', 'table' => 'sales'],
            ['column' => 'cnf_agent', 'title' => 'CNF Agent', 'table' => 'shipping'],
            ['column' => 'consignee_country', 'title' => 'Consignee Country', 'table' => 'export'],
            ['column' => 'hs_code', 'title' => 'HS Code', 'table' => 'export'],
            ['column' => 'hs_code_second', 'title' => 'HS Code (Second)', 'table' => 'export'],
            ['column' => 'contract_no', 'title' => 'Contract No', 'table' => 'export'],
            ['column' => 'consignee_site', 'title' => 'Consignee Site', 'table' => 'export'],
            ['column' => 'consignee_address', 'title' => 'Consignee Address', 'table' => 'export'],
            ['column' => 'buyer_name', 'title' => 'Buyer Name', 'table' => 'export'],
            ['column' => 'buyer_address', 'title' => 'Buyer Address', 'table' => 'export'],
            ['column' => 'buyer_country_code', 'title' => 'Buyer Country Code', 'table' => 'export'],
            ['column' => 'buyer_country_name', 'title' => 'Buyer Country Name', 'table' => 'export'],
            ['column' => 'buyer_country_port', 'title' => 'Buyer Country Port', 'table' => 'export'],
            ['column' => 'dst_name', 'title' => 'Destination Name', 'table' => 'export'],
            ['column' => 'dst_address', 'title' => 'Destination Address', 'table' => 'export'],
            ['column' => 'dst_country_code', 'title' => 'Destination Country Code', 'table' => 'export'],
            ['column' => 'dst_country_name', 'title' => 'Destination Country Name', 'table' => 'export'],
            ['column' => 'dst_country_port', 'title' => 'Destination Country Port', 'table' => 'export'],
            ['column' => 'transport_name', 'title' => 'Transport Name', 'table' => 'export'],
            ['column' => 'transport_address', 'title' => 'Transport Address', 'table' => 'export'],
            ['column' => 'notify_name', 'title' => 'Notify Name', 'table' => 'export'],
            ['column' => 'notify_address', 'title' => 'Notify Address', 'table' => 'export'],
            ['column' => 'section', 'title' => 'Section', 'table' => 'export'],
            ['column' => 'tt_no', 'title' => 'TT No', 'table' => 'export'],
            ['column' => 'tt_date', 'title' => 'TT Date', 'table' => 'export'],
            ['column' => 'unit', 'title' => 'Unit', 'table' => 'export'],
            ['column' => 'quantity', 'title' => 'Quantity', 'table' => 'export'],
            ['column' => 'currency', 'title' => 'Currency', 'table' => 'export'],
            ['column' => 'amount', 'title' => 'Amount', 'table' => 'export'],
            ['column' => 'cm_percentage', 'title' => 'CM %', 'table' => 'export'],
            ['column' => 'cm_amount', 'title' => 'CM Amount', 'table' => 'export'],
            ['column' => 'freight_value', 'title' => 'Freight Value', 'table' => 'export'],
            ['column' => 'fob_value', 'title' => 'FOB Value', 'table' => 'export'],
            ['column' => 'exp_no', 'title' => 'Export No', 'table' => 'export'],
            ['column' => 'exp_date', 'title' => 'Export Date', 'table' => 'export'],
            ['column' => 'exp_permit_no', 'title' => 'Export Permit No', 'table' => 'export'],
            ['column' => 'vessel_no', 'title' => 'Vessel No', 'table' => 'export'],
            ['column' => 'vessel_name', 'title' => 'Vessel Name', 'table' => 'export'],
            ['column' => 'bl_no', 'title' => 'BL No', 'table' => 'export'],
            ['column' => 'bl_date', 'title' => 'BL Date', 'table' => 'export'],
            ['column' => 'ex_factory_date', 'title' => 'Ex-Factory Date', 'table' => 'export'],
            ['column' => 'net_wet', 'title' => 'Net Weight', 'table' => 'export'],
            ['column' => 'gross_wet', 'title' => 'Gross Weight', 'table' => 'export'],
            ['column' => 'create_by', 'title' => 'Created By', 'table' => 'export'],
            ['column' => 'update_by', 'title' => 'Updated By', 'table' => 'export'],

            ['column' => 'gross_wet', 'title' => 'Gross Weight', 'table' => 'sales'],
            ['column' => 'net_wet', 'title' => 'Net Weight', 'table' => 'sales'],
            ['column' => 'final_qty', 'title' => 'Final Quantity', 'table' => 'sales'],
            ['column' => 'final_fob', 'title' => 'Final FOB', 'table' => 'sales'],
            ['column' => 'final_cm', 'title' => 'Final CM', 'table' => 'sales'],
            ['column' => 'remarks', 'title' => 'Remarks', 'table' => 'sales'],
            ['column' => 'created_by', 'title' => 'Created By', 'table' => 'sales'],
            ['column' => 'updated_by', 'title' => 'Updated By', 'table' => 'sales'],
            ['column' => 'created_at', 'title' => 'Created At', 'table' => 'sales'],
            ['column' => 'updated_at', 'title' => 'Updated At', 'table' => 'sales'],

            ['column' => 'ep_no', 'title' => 'EP No', 'table' => 'shipping'],
            ['column' => 'ep_date', 'title' => 'EP Date', 'table' => 'shipping'],
            ['column' => 'ex_pNo', 'title' => 'Export Permit No', 'table' => 'shipping'],
            ['column' => 'transport_port', 'title' => 'Transport Port', 'table' => 'shipping'],
            ['column' => 'sb_no', 'title' => 'SB No', 'table' => 'shipping'],
            ['column' => 'sb_date', 'title' => 'SB Date', 'table' => 'shipping'],
            ['column' => 'bring_back', 'title' => 'Bring Back', 'table' => 'shipping'],
            ['column' => 'shipped_out', 'title' => 'Shipped Out', 'table' => 'shipping'],
            ['column' => 'shipped_cancel', 'title' => 'Shipped Cancelled', 'table' => 'shipping'],
            ['column' => 'shipped_back', 'title' => 'Shipped Back', 'table' => 'shipping'],
            ['column' => 'unshipped', 'title' => 'Unshipped', 'table' => 'shipping'],
            ['column' => 'created_by', 'title' => 'Created By', 'table' => 'shipping'],
            ['column' => 'updated_by', 'title' => 'Updated By', 'table' => 'shipping'],
            ['column' => 'created_at', 'title' => 'Created At', 'table' => 'shipping'],
            ['column' => 'updated_at', 'title' => 'Updated At', 'table' => 'shipping'],

            ['column' => 'sb_no', 'title' => 'SB No', 'table' => 'billing'],
            ['column' => 'sb_date', 'title' => 'SB Date', 'table' => 'billing'],
            ['column' => 'doc_submit_date', 'title' => 'Document Submit Date', 'table' => 'billing'],
            ['column' => 'hk_courier_no', 'title' => 'HK Courier No', 'table' => 'billing'],
            ['column' => 'hk_courier_date', 'title' => 'HK Courier Date', 'table' => 'billing'],
            ['column' => 'buyer_courier_no', 'title' => 'Buyer Courier No', 'table' => 'billing'],
            ['column' => 'buyer_courier_date', 'title' => 'Buyer Courier Date', 'table' => 'billing'],
            ['column' => 'lead_time', 'title' => 'Lead Time', 'table' => 'billing'],
            ['column' => 'bank_submit_date', 'title' => 'Bank Submit Date', 'table' => 'billing'],
            ['column' => 'mode', 'title' => 'Mode', 'table' => 'billing'],
            ['column' => 'bd_thc', 'title' => 'BD THC', 'table' => 'billing'],
            ['column' => 'bank_charge', 'title' => 'Bank Charge', 'table' => 'billing'],
            ['column' => 'other_charge', 'title' => 'Other Charge', 'table' => 'billing'],
            ['column' => 'total_charge', 'title' => 'Total Charge', 'table' => 'billing'],
            ['column' => 'created_by', 'title' => 'Created By', 'table' => 'billing'],
            ['column' => 'updated_by', 'title' => 'Updated By', 'table' => 'billing'],
            ['column' => 'created_at', 'title' => 'Created At', 'table' => 'billing'],
            ['column' => 'updated_at', 'title' => 'Updated At', 'table' => 'billing'],

            ['column' => 'receivable_amount', 'title' => 'Receivable Amount', 'table' => 'logistics'],
            ['column' => 'doc_process_fee', 'title' => 'Document Processing Fee', 'table' => 'logistics'],
            ['column' => 'seal_lock_charge', 'title' => 'Seal Lock Charge', 'table' => 'logistics'],
            ['column' => 'agency_commission', 'title' => 'Agency Commission', 'table' => 'logistics'],
            ['column' => 'documentation_charge', 'title' => 'Documentation Charge', 'table' => 'logistics'],
            ['column' => 'transportation_charge', 'title' => 'Transportation Charge', 'table' => 'logistics'],
            [
                'column' => 'short_shipment_certificate_fee',
                'title' => 'Short Shipment Certificate Fee',
                'table' => 'logistics',
            ],
            ['column' => 'factory_loading_fee', 'title' => 'Factory Loading Fee', 'table' => 'logistics'],
            [
                'column' => 'uploading_fee_forwarder_wh',
                'title' => 'Uploading Fee (Forwarder WH)',
                'table' => 'logistics',
            ],
            [
                'column' => 'truck_demurrage_fee_delay_at_depot',
                'title' => 'Truck Demurrage Fee (Depot Delay)',
                'table' => 'logistics',
            ],
            [
                'column' => 'cfs_depot_mixed_cargo_loading_fee',
                'title' => 'CFS Depot Mixed Cargo Loading Fee',
                'table' => 'logistics',
            ],
            [
                'column' => 'customs_misc_remark_reasons_charge',
                'title' => 'Customs Miscellaneous Charges',
                'table' => 'logistics',
            ],
            [
                'column' => 'customs_remark_charge_misc_reasons',
                'title' => 'Customs Remarks (Misc Reasons)',
                'table' => 'logistics',
            ],
            ['column' => 'cargo_ho_date', 'title' => 'Cargo Handover Date', 'table' => 'logistics'],
            ['column' => 'deadline_bill_submission', 'title' => 'Bill Submission Deadline', 'table' => 'logistics'],
            ['column' => 'bill_received_date', 'title' => 'Bill Received Date', 'table' => 'logistics'],
            ['column' => 'status', 'title' => 'Status', 'table' => 'logistics'],
            ['column' => 'forwarder_name', 'title' => 'Forwarder Name', 'table' => 'logistics'],
            ['column' => 'total_charges', 'title' => 'Total Charges', 'table' => 'logistics'],
            ['column' => 'created_by', 'title' => 'Created By', 'table' => 'logistics'],
            ['column' => 'updated_by', 'title' => 'Updated By', 'table' => 'logistics'],
            ['column' => 'created_at', 'title' => 'Created At', 'table' => 'logistics'],
            ['column' => 'updated_at', 'title' => 'Updated At', 'table' => 'logistics'],

            ['column' => 'id', 'title' => 'ID', 'table' => 'audit'],
            ['column' => 'invoice_no', 'title' => 'Invoice No', 'table' => 'audit'],
            ['column' => 'import_reg_no', 'title' => 'Import Reg No', 'table' => 'audit'],
            ['column' => 'import_bond', 'title' => 'Import Bond', 'table' => 'audit'],
            ['column' => 'total_fabric_used', 'title' => 'Total Fabric Used', 'table' => 'audit'],
            ['column' => 'adjusted_reg', 'title' => 'Adjusted Reg', 'table' => 'audit'],
            ['column' => 'adjusted_reg_page', 'title' => 'Adjusted Reg Page', 'table' => 'audit'],
            ['column' => 'created_by', 'title' => 'Created By', 'table' => 'audit'],
            ['column' => 'updated_by', 'title' => 'Updated By', 'table' => 'audit'],
            ['column' => 'created_at', 'title' => 'Created At', 'table' => 'audit'],
            ['column' => 'updated_at', 'title' => 'Updated At', 'table' => 'audit'],
        ];

         $colorMap = [
        'export' => '#0056b3',    // Deep Blue
        'sales' => '#1a6840',     // Dark Green
        'shipping' => '#006064',  // Dark Cyan/Teal
        'billing' => '#4a148c',   // Deep Purple
        'logistics' => '#37474f', // Blue Grey
        'audit' => '#b71c1c',     // Dark Red
    ];

    @endphp





<form action="{{ route('reports.finance.report') }}" method="GET" class="row g-3 mb-4">
        {{-- GET forms do not require @csrf, but it doesn't hurt --}}

        <div class="col-md-3">
        <label for="invoice_site" class="col-sm-3 text-end control-label col-form-label">Factory:</label>
        <div class="col-sm-9">
            <input hidden type="text" value="{{$user->site}}" readonly name="site"></input>
            {{-- Display the site name for user feedback --}}
            <span class="form-control-static">{{ $user->site }}</span>
        </div>
    </div>

        <div class="col-md-3">
            <label for="invoice_no" class="form-label">Invoice No</label>
            <input type="text" name="invoice_no" id="invoice_no" class="form-control"
                   value="{{ request('invoice_no') }}">
        </div>

        <div class="col-md-3">
            <label for="start_date" class="form-label">Exf: Start Date</label>
            <input type="date" name="start_date" id="start_date" class="form-control"
                value="{{ request('start_date') }}">
        </div>

        <div class="col-md-3">
            <label for="end_date" class="form-label">Exf: End Date</label>
            <input type="date" name="end_date" id="end_date" class="form-control"
                value="{{ request('end_date') }}">
        </div>

        <div class="col-12">
            <button type="submit" class="btn btn-success">Generate Report</button>
            <a href="{{ route('reports.finance.export', request()->all()) }}" class="btn btn-primary">
                Download
            </a>
        </div>
    </form>

    {{-- CSS Styles Remain Same --}}
    <style>
        .table-container { overflow-x: auto; background-color: #fff; border-radius: 0.5rem; }
        .table { width: 100%; border-collapse: separate; font-size: 0.95rem; }
        .table thead th { position: sticky; top: 0; background: #0d6efd; color: #fff; text-align: center; }
        .table td { white-space: nowrap; padding: 0.25rem 1rem; border: 1px solid #dee2e6; }
    </style>

    <div class="container-fluid py-4">
        <h2 class="mb-4">Finance Report</h2>

        @if (empty($data) || $data->isEmpty())
            <div class="alert alert-info">No data available for the selected filters.</div>
        @else
            <div class="table-container">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                 @foreach ($export as $col)
        <th
            style="
                background-color: {{ $colorMap[$col['table']] ?? '#6c757d' }};
                color: #ffffff;
            "
        >
            {{ $col['table'] }}
        </th>
    @endforeach
            </tr>
            <tr>

                @foreach ($export as $col)
                    <th class="p-0 m-0">{{ $col['title'] }}</th>
                @endforeach
            </tr>
        </thead>

        <tbody>
            @foreach ($data as $row)
                <tr>
                    @foreach ($export as $col)
                        @php
                            $table = $col['table'];
                            $column = $col['column'];

                            $value = data_get($row, "{$table}.{$column}", '');
                        @endphp

                        <td>
                            {{ $value ?? '-' }}
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

        @endif
    </div>


@endsection
