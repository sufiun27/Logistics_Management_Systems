@extends('template.index')

@section('content')
@php
use App\Models\Export;
$exporters = Export::pluck('ExpoterName', 'ExpoterName'); // key-value pair (label => value)
@endphp

    <div class="card">
        <div class="card-header">
            <label for="invoice_no">Invoice No: </label>
            <input id="invoice_no" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <div id="invoices"></div>
        </div>
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('shipping.shipping') }}" class="btn btn-dark">Back</a>
            </h4>
            <x-message/>

            <form class="form-horizontal" action="{{ route('shipping.storeShipmentStatusInfo') }}" method="POST">
                @csrf

                <div class="row">
                    <!-- Shipment Status Information -->
                    <div class="col-6">
                        <hr>
                        <h5>Shipment Status Information</h5>
                        <hr>

                        @php
                            $shipmentFields = [
                                [
                                    'label' => 'Invoice No',
                                    'name' => 'invoice_no',
                                    'type' => 'text',
                                    'readonly' => true,
                                    'placeholder' => 'Select Invoice',
                                    'required' => true,
                                ],
                                [
                                    'label' => 'Factory',
                                    'name' => 'factory',
                                    'type' => 'select', // change to select
                                    'placeholder' => 'Select Factory'
                                ],
                                [
                                    'label' => 'Ep No',
                                    'name' => 'ep_no',
                                    'type' => 'text',
                                    'placeholder' => 'Ep No'
                                ],
                                [
                                    'label' => 'Ep Date',
                                    'name' => 'ep_date',
                                    'type' => 'date',
                                    'placeholder' => 'Ep Date'
                                ],
                                [
                                    'label' => 'Exp No',
                                    'name' => 'exp_no',
                                    'type' => 'text',
                                    'placeholder' => 'Exp No'
                                ],
                                [
                                    'label' => 'Exp Date',
                                    'name' => 'exp_date',
                                    'type' => 'date',
                                    'placeholder' => 'Exp Date'
                                ],
                                [
                                    'label' => 'Ex-Factory Date',
                                    'name' => 'ex_factory_date',
                                    'type' => 'date',
                                    'placeholder' => 'Ex-Factory Date'
                                ],
                                [
                                    'label' => 'SB No',
                                    'name' => 'sb_no',
                                    'type' => 'text',
                                    'placeholder' => 'SB No'
                                ],
                                [
                                    'label' => 'SB Date',
                                    'name' => 'sb_date',
                                    'type' => 'date',
                                    'placeholder' => 'SB Date'
                                ]
                            ];
                        @endphp

                        @foreach ($shipmentFields as $field)
                            <div class="form-group row">
                                <label for="{{ $field['name'] }}" class="col-sm-3 text-end control-label col-form-label">
                                    {{ $field['label'] }}:
                                </label>
                                <div class="col-sm-9">
                                    @if ($field['name'] === 'invoice_no')
                                        <div id="displayDiv">
                                            <input
                                                type="{{ $field['type'] }}"
                                                name="{{ $field['name'] }}"
                                                required
                                                class="form-control"
                                                id="{{ $field['name'] }}"
                                                placeholder="{{ $field['placeholder'] }}"
                                                value="{{ old($field['name'], request()->get('invoice_no')) }}"
                                                @if (!empty($field['readonly'])) readonly @endif
                                            />
                                        </div>
                                    @elseif ($field['type'] === 'select' && $field['name'] === 'factory')
                                        <select name="{{ $field['name'] }}"
                                                id="{{ $field['name'] }}"
                                                class="form-control">
                                            <option value="">{{ $field['placeholder'] }}</option>
                                            @foreach ($exporters as $value => $label)
                                                <option value="{{ $value }}" {{ old($field['name']) == $value ? 'selected' : '' }}>
                                                    {{ $label }}
                                                </option>
                                            @endforeach
                                        </select>
                                    @else
                                        <input
                                            type="{{ $field['type'] }}"
                                            name="{{ $field['name'] }}"
                                            class="form-control"
                                            id="{{ $field['name'] }}"
                                            placeholder="{{ $field['placeholder'] }}"
                                            value="{{ old($field['name']) }}"
                                        />
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div> <!-- end col-6 -->

                    <!-- Other Information -->
                    <div class="col-6">
                        <hr>
                        <h5>Other Information</h5>
                        <hr>

                        @php
                            $otherFields = [
                                [
                                    'label' => 'cnf_agent',
                                    'name' => 'cnf_agent',
                                    'type' => 'text',
                                    'placeholder' => 'cnf_agent'
                                ],
                                [
                                    'label' => 'vessel_no',
                                    'name' => 'vessel_no',
                                    'type' => 'text',
                                    'placeholder' => 'vessel_no'
                                ],
                                [
                                    'label' => 'cargorpt_date',
                                    'name' => 'cargorpt_date',
                                    'type' => 'date',
                                    'placeholder' => 'cargorpt_date'
                                ]
                            ];

                            $remarksFields = [
                                [
                                    'label' => 'Bring Back',
                                    'name' => 'bring_back',
                                    'type' => 'text',
                                    'placeholder' => 'bring_back'
                                ],
                                [
                                    'label' => 'Shipped Out',
                                    'name' => 'shipped_out',
                                    'type' => 'text',
                                    'placeholder' => 'shipped_out'
                                ],
                                [
                                    'label' => 'Shipped Cancel',
                                    'name' => 'shipped_cancel',
                                    'type' => 'text',
                                    'placeholder' => 'shipped_cancel'
                                ],
                                [
                                    'label' => 'Shipped Back',
                                    'name' => 'shipped_back',
                                    'type' => 'text',
                                    'placeholder' => 'shipped_back'
                                ],
                                [
                                    'label' => 'Un-Shipped',
                                    'name' => 'unshipped',
                                    'type' => 'text',
                                    'placeholder' => 'unshipped'
                                ]
                            ];
                        @endphp

                        <!-- Local Transport Select -->
                        <div class="form-group row">
                            <label for="transport_port" class="col-sm-3 text-end control-label col-form-label">Local Transport:</label>
                            <div class="col-sm-9">
                                <select name="transport_port" id="transport_port" class="form-control">
                                    @foreach ($transports as $transport)
                                        <option value="{{ $transport->port }}">{{ $transport->port }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Other Information Fields -->
                        @foreach ($otherFields as $field)
                            <div class="form-group row">
                                <label for="{{ $field['name'] }}" class="col-sm-3 text-end control-label col-form-label">{{ $field['label'] }}:</label>
                                <div class="col-sm-9">
                                    <div id="displayDiv">
                                        <input type="{{ $field['type'] }}"
                                               name="{{ $field['name'] }}"
                                               class="form-control"
                                               id="{{ $field['name'] }}"
                                               placeholder="{{ $field['placeholder'] }}"
                                               value="{{ old($field['name']) }}" />
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <!-- Remarks Section -->
                        <hr>
                        <h5>Remarks</h5>
                        <hr>

                        @foreach ($remarksFields as $field)
                            <div class="form-group row">
                                <label for="{{ $field['name'] }}" class="col-sm-3 text-end control-label col-form-label">{{ $field['label'] }}:</label>
                                <div class="col-sm-9">
                                    <div id="displayDiv">
                                        <input type="{{ $field['type'] }}"
                                               name="{{ $field['name'] }}"
                                               class="form-control"
                                               id="{{ $field['name'] }}"
                                               placeholder="{{ $field['placeholder'] }}"
                                               value="{{ old($field['name']) }}" />
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div> <!-- end col-6 -->
                </div> <!-- end row -->

                <div class="border-top">
                    <div class="card-body">
                        <input type="submit" value="Save" class="btn btn-primary">
                    </div>
                </div>
            </form>
        </div>
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
        });
    </script>
@endsection
