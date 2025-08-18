@extends('template.index')

@section('content')

@php
    use App\Models\User;
    use App\Models\Export;

    $user = auth()->user();
    $exporters = Export::all();

@endphp









<form action="{{ route('reports.report') }}" method="POST" class="row g-3 mb-4">
    @csrf


    {{-- <div class="col-md-3">


        <label for="invoice_site" class="col-sm-3 text-end control-label col-form-label">Factory:</label>
                        <div class="col-sm-9">
                            <select name="site[]" id="invoice_site"  required multiple >
                                <option value="">Select Exporter</option>
                                @php
                                    $selectedSite = old('invoice_site', $user->site);
                                @endphp
                                @foreach($exporters as $exporter)
                                    <option value="{{ $exporter->ExpoterName }}" {{ $selectedSite == $exporter->ExpoterName ? 'selected' : '' }}>
                                        {{ $exporter->ExpoterName }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
    </div> --}}


    <div class="col-md-3">
        <label for="invoice_site" class="col-sm-3 text-end control-label col-form-label">Factory:</label>
        <div class="col-sm-9">
            <input hidden type="text" value="{{$user->site}}" readonly name="site"></input>
            {{ $user->site }}
        </div>
    </div>


    <div class="col-md-3">
        <label for="invoice_no" class="form-label">Invoice No</label>
        <input type="text" name="invoice_no" id="invoice_no" class="form-control"
               placeholder="Enter Invoice No" value="{{ old('invoice_no', request('invoice_no')) }}">
    </div>

    <div class="col-md-3">
        <label for="start_date" class="form-label">Exf: Start Date</label>
        <input type="date" name="start_date" id="start_date" class="form-control"
               value="{{ old('start_date', request('start_date')) }}">
    </div>

    <div class="col-md-3">
        <label for="end_date" class="form-label">Exf: End Date</label>
        <input type="date" name="end_date" id="end_date" class="form-control"
               value="{{ old('end_date', request('end_date')) }}">
    </div>

    <div class="col-12">
        <button type="submit" class="btn btn-success">Generate Report</button>

        <a href="{{ route('reports.masterReportExport', request()->only(['site', 'invoice_no', 'start_date', 'end_date'])) }}"
            class="btn btn-primary">
             Download
         </a>

    </div>
</form>

<style>
    .table-container {
        overflow-x: auto;
        max-width: 100%;
        border-radius: 0.5rem;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        background-color: #fff;
    }

    .table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        font-size: 0.95rem;
    }

    .table th, .table td {
        vertical-align: middle;
        white-space: nowrap;
        padding: 0.25rem 1rem;
        border: 1px solid #dee2e6;
    }

    .table thead th {
        position: sticky;
        top: 0;
        z-index: 2;
        background-color: #0056b3; /* Deep blue for headers */
        color: #ffffff;
        text-align: center;
        font-weight: 600;
        border-bottom: 2px solid #00408a;
    }

    .table tbody tr:nth-child(even) {
        background-color: #f8f9fa;
    }

    .table tbody tr:hover {
        background-color: #adcef1;
        transition: background-color 0.2s ease-in-out;
    }

    .table tbody td {
        color: #343a40;
    }

    .table tbody td:first-child {
        font-weight: 500;
    }
</style>


@php
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

    // $sales = [
    //     ['column' => 'invoice_no', 'title' => 'Invoice No'],
    //     ['column' => 'buyer_contract', 'title' => 'Buyer Contract'],
    //     ['column' => 'order_no', 'title' => 'Order No'],
    //     ['column' => 'style_no', 'title' => 'Style No'],
    //     ['column' => 'product_type', 'title' => 'Product Type'],
    //     ['column' => 'shipped_qty', 'title' => 'Shipped Quantity'],
    //     ['column' => 'carton_qty', 'title' => 'Carton Quantity'],
    //     ['column' => 'shipped_fob_value', 'title' => 'Shipped FOB Value'],
    //     ['column' => 'shipped_cm_value', 'title' => 'Shipped CM Value'],
    //     ['column' => 'cbm_value', 'title' => 'CBM Value'],
    //     ['column' => 'gross_wet', 'title' => 'Gross Weight'],
    //     ['column' => 'net_wet', 'title' => 'Net Weight'],
    //     ['column' => 'eta_date', 'title' => 'ETA Date'],
    //     ['column' => 'vessel_name', 'title' => 'Vessel Name'],
    //     ['column' => 'shipbording_date', 'title' => 'Shipboarding Date'],
    //     ['column' => 'bl_no', 'title' => 'BL No'],
    //     ['column' => 'bl_date', 'title' => 'BL Date'],
    //     ['column' => 'final_qty', 'title' => 'Final Quantity'],
    //     ['column' => 'final_fob', 'title' => 'Final FOB'],
    //     ['column' => 'final_cm', 'title' => 'Final CM'],
    //     ['column' => 'remarks', 'title' => 'Remarks'],
    //     ['column' => 'created_by', 'title' => 'Created By'],
    //     ['column' => 'updated_by', 'title' => 'Updated By'],
    //     ['column' => 'created_at', 'title' => 'Created At'],
    //     ['column' => 'updated_at', 'title' => 'Updated At'],
    // ];
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


    // $shipping = [
    //     ['column' => 'id', 'title' => 'ID'],
    //     ['column' => 'invoice_no', 'title' => 'Invoice No'],
    //     ['column' => 'factory', 'title' => 'Factory'],

    //     ['column' => 'ep_no', 'title' => 'EP No'],
    //     ['column' => 'ep_date', 'title' => 'EP Date'],
    //     ['column' => 'ex_pNo', 'title' => 'Export Permit No'], // Assuming ex_pNo means Export Permit No
    //     ['column' => 'exp_date', 'title' => 'Export Date'],
    //     ['column' => 'exp_no', 'title' => 'Export No'],
    //     ['column' => 'ex_factory_date', 'title' => 'Ex-Factory Date'],

    //     ['column' => 'cnf_agent', 'title' => 'CNF Agent'],
    //     ['column' => 'transport_port', 'title' => 'Transport Port'],
    //     ['column' => 'sb_no', 'title' => 'SB No'],
    //     ['column' => 'sb_date', 'title' => 'SB Date'],
    //     ['column' => 'vessel_no', 'title' => 'Vessel No'],
    //     ['column' => 'cargorpt_date', 'title' => 'Cargo Report Date'],

    //     ['column' => 'bring_back', 'title' => 'Bring Back'],
    //     ['column' => 'shipped_out', 'title' => 'Shipped Out'],
    //     ['column' => 'shipped_cancel', 'title' => 'Shipped Cancelled'],
    //     ['column' => 'shipped_back', 'title' => 'Shipped Back'],
    //     ['column' => 'unshipped', 'title' => 'Unshipped'],

    //     ['column' => 'created_by', 'title' => 'Created By'],
    //     ['column' => 'updated_by', 'title' => 'Updated By'],
    //     ['column' => 'created_at', 'title' => 'Created At'],
    //     ['column' => 'updated_at', 'title' => 'Updated At'],
    // ];
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

    $excelHeaders = $table;

    function formatDate($date) {
        try {
            return $date ? \Carbon\Carbon::parse($date)->format('Y-m-d') : '-';
        } catch (\Exception $e) {
            return '-';
        }
    }
isset($data)?: $data = [];
@endphp

<div class="container-fluid py-4">
    <h2 class="mb-4">Sale Detail Master Report</h2>

    @if (empty($data))
    <div class="alert alert-info">No data available for the selected filters.</div>
@else
    <div class="table-container">
        <table class="table table-bordered table-hover text-nowrap">
            <thead class="table-dark">
                <tr>
                    @foreach($excelHeaders as $section => $fields)
                        @foreach($fields as $field)
                            <th>{{ $section }}</th>
                        @endforeach
                    @endforeach
                </tr>
                <tr>
                    @foreach($excelHeaders as $section => $fields)
                        @foreach($fields as $field)
                            <th>{{ $field['title'] }}</th>
                        @endforeach
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($data as $row)
                    <tr>
                        @foreach($excelHeaders as $section => $fields)
                            @foreach($fields as $field)
                                @php
                                    $value = $row[$section][$field['column']] ?? '-';
                                    if (str_contains($field['column'], 'date')) {
                                        $value = formatDate($value);
                                    }
                                @endphp
                                <td>{{ $value }}</td>
                            @endforeach
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- Pagination links -->
    <div class="mt-3">
        {{ $data->appends(request()->except('page'))->links() }}
    </div>
@endif
</div>

{{-- <pre>{{ json_encode($data, JSON_PRETTY_PRINT) }}</pre> --}}


@endsection
