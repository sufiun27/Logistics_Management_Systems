@extends('template.index')
@section('content')
    <div class="card">
        <div class="card-header">
            <label for="invoice_no">Invoice No: </label>
            <input id="invoice_no" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <div id="invoices"></div>
        </div>

        <div class="card-title d-flex">
            <h3>Logistics : </h3>
            <a href="{{ route('logistics.indexLogistics') }}" class="btn btn-success">Back</a>
            <x-message/>
        </div>

        <form class="form-horizontal" action="{{ route('logistics.storeLogistics') }}" method="POST">
            @csrf

            @php
                // Define form sections and their fields
                $sections = [
                    'Custom Related Cost Entry' => [
                        ['name' => 'invoice_no', 'label' => 'Invoice No', 'placeholder' => 'Invoice No', 'required' => true, 'type' => 'text', 'wrapper' => 'displayDiv', 'readonly' => true,],
                        ['name' => 'receivable_amount', 'label' => 'Receivable Amount', 'placeholder' => 'Receivable Amount', 'type' => 'number'],
                        ['name' => 'doc_process_fee', 'label' => 'Doc Process Fee', 'placeholder' => 'Doc Process Fee', 'type' => 'number'],
                    ],
                    'Export Charge Entry' => [
                        ['name' => 'seal_lock_charge', 'label' => 'Seal Lock Charge', 'placeholder' => 'Seal Lock Charge', 'type' => 'number'],
                        ['name' => 'agency_commission', 'label' => 'Agency Commission', 'placeholder' => 'Agency Commission', 'type' => 'number'],
                        ['name' => 'documentation_charge', 'label' => 'Documentation Charge', 'placeholder' => 'Documentation Charge', 'type' => 'number'],
                        ['name' => 'transportation_charge', 'label' => 'Transportation Charge', 'placeholder' => 'Transportation Charge', 'type' => 'number'],
                    ],
                    'Other Charge' => [
                        ['name' => 'short_shipment_certificate_fee', 'label' => 'Short Shipment Certificate Fee', 'placeholder' => 'Short Shipment Certificate Fee', 'type' => 'number'],
                        ['name' => 'factory_loading_fee', 'label' => 'Factory Loading Fee', 'placeholder' => 'Factory Loading Fee', 'type' => 'number'],
                        ['name' => 'uploading_fee_forwarder_wh', 'label' => 'Uploading Fee Forwarder WH', 'placeholder' => 'Uploading Fee Forwarder WH', 'type' => 'number'],
                        ['name' => 'truck_demurrage_fee_delay_at_depot', 'label' => 'Truck Demurrage Fee Delay at Depot', 'placeholder' => 'Truck Demurrage Fee Delay at Depot', 'type' => 'number'],
                        ['name' => 'cfs_depot_mixed_cargo_loading_fee', 'label' => 'CFS Depot Mixed Cargo Loading Fee', 'placeholder' => 'CFS Depot Mixed Cargo Loading Fee', 'type' => 'number'],
                        ['name' => 'customs_misc_remark_reasons_charge', 'label' => 'Customs Misc Remark Reasons Charge', 'placeholder' => 'Customs Misc Remark Reasons Charge', 'type' => 'number'],
                        ['name' => 'customs_remark_charge_misc_reasons', 'label' => 'Customs Remark Charge Misc Reasons', 'placeholder' => 'Customs Remark Charge Misc Reasons', 'type' => 'text'],
                    ],
                    'Date Information' => [
                        ['name' => 'cargo_ho_date', 'label' => 'Cargo HO Date', 'placeholder' => 'Cargo HO Date', 'type' => 'date'],
                        ['name' => 'deadline_bill_submission', 'label' => 'Deadline for Bill Submission', 'placeholder' => 'Deadline for Bill Submission', 'type' => 'date'],
                        ['name' => 'bill_received_date', 'label' => 'Bill Received Date', 'placeholder' => 'Bill Received Date', 'type' => 'date'],
                        ['name' => 'status', 'label' => 'Status', 'placeholder' => 'Status', 'type' => 'text'],
                        ['name' => 'forwarder_name', 'label' => 'Forwarder Name', 'placeholder' => 'Forwarder Name', 'type' => 'text'],
                        ['name' => 'total_charges', 'label' => 'Total Charges', 'placeholder' => 'Total Charges', 'type' => 'number', 'readonly' => true],
                    ],
                ];
            @endphp

            <div class="row">
            @foreach ($sections as $sectionTitle => $fields)
                <div class="col-6">
                    <hr>
                    <h3>&nbsp;&nbsp; {{ $sectionTitle }}</h3>
                    <hr>
                    @foreach ($fields as $field)
                        <div class="form-group row">
                            <label for="{{ $field['name'] }}" class="col-sm-3 text-end col-form-label">{{ $field['label'] }}:</label>
                            <div class="col-sm-9">
                                @php
                                    $required = isset($field['required']) && $field['required'] ? 'required' : '';
                                    $readonly = isset($field['readonly']) && $field['readonly'] ? 'readonly' : '';
                                @endphp

                                @if (isset($field['wrapper']))
                                    <div id="{{ $field['wrapper'] }}">
                                @endif

                                <input
                                    type="{{ $field['type'] }}"
                                    name="{{ $field['name'] }}"
                                    class="form-control"
                                    id="{{ $field['name'] }}"
                                    placeholder="{{ $field['placeholder'] }}"
                                    value="{{ old($field['name']) }}"
                                    {{ $required }}
                                    {{ $readonly }}
                                    @if ($field['type'] === 'number') step="0.01" @endif
                                    @if ($field['name'] === 'invoice_no' && !isset($field['wrapper'])) readonly @endif
                                />

                                @if (isset($field['wrapper']))
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>

        <div class="border-top">
            <div class="card-body">
                <input type="submit" value="Save" class="btn btn-primary">
            </div>
        </div>
    </form>
</div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#invoice_no').on('input', function() {
                var invoice_no = $(this).val();
                $.ajax({
                    url: "{{ route('getInvoice') }}",
                    method: "POST",
                    data: {
                        invoice_no: invoice_no,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        $('#invoices').trigger("reset");
                        $('#invoices').html(data);
                    }
                });
            });

            $('#invoices').on('click', '.invoiceCell', function() {
                var invoiceValue = $(this).text();
                $('#displayDiv').html('<input type="text" readonly name="invoice_no" class="form-control" id="invoice_no" value="' + invoiceValue + '" />');
                $('#invoices').html('');
            });

            function updateTotalCharges() {
                @php
                    $chargeFields = [];
                    foreach ($sections as $fields) {
                        foreach ($fields as $field) {
                            if ($field['name'] !== 'cargo_ho_date' && $field['name'] !== 'deadline_bill_submission' && $field['name'] !== 'bill_received_date' && $field['name'] !== 'status' && $field['name'] !== 'forwarder_name' && $field['name'] !== 'invoice_no' && $field['name'] !== 'total_charges') {
                                $chargeFields[] = $field['name'];
                            }
                        }
                    }
                @endphp
                var totalCharges = 0;
                @foreach ($chargeFields as $field)
                    totalCharges += parseFloat($('#{{ $field }}').val()) || 0;
                @endforeach
                $('#total_charges').val(totalCharges.toFixed(2));
            }

            @foreach ($chargeFields as $field)
                $('#{{ $field }}').on('change', updateTotalCharges);
            @endforeach

            updateTotalCharges();
        });
    </script>
@endsection
