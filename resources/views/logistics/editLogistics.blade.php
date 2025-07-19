@extends('template.index')
@section('content')
    <div class="card">
        <div class="card-title d-flex">
            <h3>Logistics :</h3>
            <a href="{{ route('logistics.indexLogistics') }}" class="btn btn-success">Back</a>
            <a href="{{ route('logistics.deleteLogistics', $l->id) }}" class="btn btn-danger">Delete</a>
            <x-message/>
        </div>

        <form class="form-horizontal" action="{{ route('logistics.updateLogistics', $l->id) }}" method="POST">
            @csrf

            @php
                // Define form sections and their fields
                $sections = [
                    'Custom Related Cost Entry' => [
                        ['name' => 'invoice_no', 'label' => 'Invoice No', 'placeholder' => 'Invoice No', 'required' => true, 'type' => 'text', 'value' => $l->invoice_no, 'readonly' => true, 'wrapper' => 'displayDiv'],
                        ['name' => 'receivable_amount', 'label' => 'Receivable Amount', 'placeholder' => 'Receivable Amount', 'type' => 'number', 'value' => $l->receivable_amount],
                        ['name' => 'doc_process_fee', 'label' => 'Doc Process Fee', 'placeholder' => 'Doc Process Fee', 'type' => 'number', 'value' => $l->doc_process_fee],
                    ],
                    'Export Charge Entry' => [
                        ['name' => 'seal_lock_charge', 'label' => 'Seal Lock Charge', 'placeholder' => 'Seal Lock Charge', 'type' => 'number', 'value' => $l->seal_lock_charge],
                        ['name' => 'agency_commission', 'label' => 'Agency Commission', 'placeholder' => 'Agency Commission', 'type' => 'number', 'value' => $l->agency_commission],
                        ['name' => 'documentation_charge', 'label' => 'Documentation Charge', 'placeholder' => 'Documentation Charge', 'type' => 'number', 'value' => $l->documentation_charge],
                        ['name' => 'transportation_charge', 'label' => 'Transportation Charge', 'placeholder' => 'Transportation Charge', 'type' => 'number', 'value' => $l->transportation_charge],
                    ],
                    'Other Charge' => [
                        ['name' => 'short_shipment_certificate_fee', 'label' => 'Short Shipment Certificate Fee', 'placeholder' => 'Short Shipment Certificate Fee', 'type' => 'number', 'value' => $l->short_shipment_certificate_fee],
                        ['name' => 'factory_loading_fee', 'label' => 'Factory Loading Fee', 'placeholder' => 'Factory Loading Fee', 'type' => 'number', 'value' => $l->factory_loading_fee],
                        ['name' => 'uploading_fee_forwarder_wh', 'label' => 'Uploading Fee Forwarder WH', 'placeholder' => 'Uploading Fee Forwarder WH', 'type' => 'number', 'value' => $l->uploading_fee_forwarder_wh],
                        ['name' => 'truck_demurrage_fee_delay_at_depot', 'label' => 'Truck Demurrage Fee Delay at Depot', 'placeholder' => 'Truck Demurrage Fee Delay at Depot', 'type' => 'number', 'value' => $l->truck_demurrage_fee_delay_at_depot],
                        ['name' => 'cfs_depot_mixed_cargo_loading_fee', 'label' => 'CFS Depot Mixed Cargo Loading Fee', 'placeholder' => 'CFS Depot Mixed Cargo Loading Fee', 'type' => 'number', 'value' => $l->cfs_depot_mixed_cargo_loading_fee],
                        ['name' => 'customs_misc_remark_reasons_charge', 'label' => 'Customs Misc Remark Reasons Charge', 'placeholder' => 'Customs Misc Remark Reasons Charge', 'type' => 'number', 'value' => $l->customs_misc_remark_reasons_charge],
                        ['name' => 'customs_remark_charge_misc_reasons', 'label' => 'Customs Remark Charge Misc Reasons', 'placeholder' => 'Customs Remark Charge Misc Reasons', 'type' => 'text', 'value' => $l->customs_remark_charge_misc_reasons],
                    ],
                    'Date Information' => [
                        ['name' => 'cargo_ho_date', 'label' => 'Cargo HO Date', 'placeholder' => 'Cargo HO Date', 'type' => 'date', 'value' => $l->cargo_ho_date],
                        ['name' => 'deadline_bill_submission', 'label' => 'Deadline for Bill Submission', 'placeholder' => 'Deadline for Bill Submission', 'type' => 'date', 'value' => $l->deadline_bill_submission],
                        ['name' => 'bill_received_date', 'label' => 'Bill Received Date', 'placeholder' => 'Bill Received Date', 'type' => 'date', 'value' => $l->bill_received_date],
                        ['name' => 'status', 'label' => 'Status', 'placeholder' => 'Status', 'type' => 'text', 'value' => $l->status],
                        ['name' => 'forwarder_name', 'label' => 'Forwarder Name', 'placeholder' => 'Forwarder Name', 'type' => 'text', 'value' => $l->forwarder_name],
                        ['name' => 'total_charges', 'label' => 'Total Charges', 'placeholder' => 'Total Charges', 'type' => 'number', 'value' => $l->total_charges, 'readonly' => true],
                    ],
                ];
            @endphp

            <div class="row">
                @foreach ($sections as $sectionTitle => $fields)
                    <div class="col-6">
                        <hr>
                        <h3>   {{ $sectionTitle }}</h3>
                        <hr>
                        @foreach ($fields as $field)
                            <div class="form-group row">
                                <label for="{{ $field['name'] }}" class="col-sm-3 text-end control-label col-form-label">{{ $field['label'] }}:</label>
                                <div class="col-sm-9">

                                    @php
                                        $required = isset($field['required']) && $field['required'] ? 'required' : '';
                                        $readonly = isset($field['readonly']) && $field['readonly'] ? 'readonly' : '';
                                    @endphp

                                    @if (isset($field['wrapper']))
                                        <div id="{{ $field['wrapper'] }}">
                                            <input
                                                type="{{ $field['type'] }}"
                                                name="{{ $field['name'] }}"
                                                class="form-control"
                                                id="{{ $field['name'] }}"
                                                placeholder="{{ $field['placeholder'] }}"
                                                value="{{ $field['value'] }}"
                                                {{ $required }}
                                            {{ $readonly }}
                                            @if ($field['type'] === 'number')
                                                step="0.01"
                                            @endif
                                            />
                                        </div>
                                    @else
                                        <input
                                            type="{{ $field['type'] }}"
                                            name="{{ $field['name'] }}"
                                            class="form-control"
                                            id="{{ $field['name'] }}"
                                            placeholder="{{ $field['placeholder'] }}"
                                            value="{{ $field['value'] }}"
                                            {{ $required }}
                                            {{ $readonly }}
                                            @if ($field['type'] === 'number')
                                                step="0.01"
                                            @endif
                                        />
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
