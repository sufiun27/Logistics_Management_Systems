@extends('template.index')

@section('content')
<div class="card">
    <div class="card-header">
        <a href="{{ route('exportFormApparel.exportFormApparel') }}" class="btn btn-success btn-sm">Back</a>
    </div>
    <x-message/>
    <div class="card-body">
        <form action="{{ route('exportFormApparel.storeExportFormApparel') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-6">
                    <!-- Left Side Inputs -->
                    @foreach([
                        ['item_name', 'Item Name', 'text', false],
                        ['hs_code', 'HS Code', 'text', false],
                        ['hs_code_second', 'HS Code Second', 'text', false],
                        ['invoice_no', 'Invoice No', 'text', true],
                        ['invoice_date', 'Invoice Date', 'date', false],
                        ['contract_no', 'Contract No', 'text', false],
                        ['contract_date', 'Contract Date', 'date', false]
                    ] as [$name, $label, $type, $required])
                    <div class="form-group row">
                        <label for="{{ $name }}" class="col-sm-3 text-end control-label col-form-label">{{ $label }}:</label>
                        <div class="col-sm-9">
                            <input type="{{ $type }}" {{ $required ? 'required' : '' }} name="{{ $name }}" class="form-control" id="{{ $name }}" placeholder="{{ $label }}" value="{{ old($name) }}" />
                            @if($name == 'invoice_no')
                            <span id="invoice_validation" class="text-success"></span>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- Right Side --}}
                <div class="col-6">
                    <!-- Consignee Information -->
                    <div class="form-group row">
                        <label for="consignee_name" class="col-sm-3 text-end control-label col-form-label">Consignee Name:</label>
                        <div class="col-sm-9">
                            <select id="consignee_name" required name="consignee_name" class="form-control">
                                <option value="">Select Consignee Name</option>
                                @foreach($consignees->unique('consignee_name') as $consignee)
                                <option value="{{ $consignee->consignee_name }}" {{ old('consignee_name') == $consignee->consignee_name ? 'selected' : '' }}>{{ $consignee->consignee_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @foreach([
                        ['consignee_site', 'Consignee Site'],
                        ['consignee_country', 'Consignee Country'],
                        ['consignee_address', 'Consignee Address']
                    ] as [$name, $label])
                    <div class="form-group row">
                        <label for="{{ $name }}" class="col-sm-3 text-end control-label col-form-label">{{ $label }}:</label>
                        <div class="col-sm-9">
                            <select id="{{ $name }}" name="{{ $name }}" class="form-control" disabled>
                                <option value="">Select {{ $label }}</option>
                            </select>
                        </div>
                    </div>
                    @endforeach

                    <hr>

                    <!-- Notify Information -->
                    <div class="form-group row">
                        <label for="notify_name" class="col-sm-3 text-end control-label col-form-label">Notify:</label>
                        <div class="col-sm-9">
                            <select id="notify_name" required name="notify_name" class="form-control">
                                <option value="">Select Notify</option>
                                @foreach($notifies as $notify)
                                <option value="{{ $notify->name }}" {{ old('notify_name') == $notify->name ? 'selected' : '' }}>{{ $notify->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mt-3">
                        <label for="notify_address" class="col-sm-3 text-end control-label col-form-label">Address:</label>
                        <div class="col-sm-9">
                            <input type="text" id="notify_address" name="notify_address" class="form-control" value="{{ old('notify_address') }}" readonly>
                        </div>
                    </div>

                    <hr>

                    <!-- Destination Country -->
                    <div class="form-group row">
                        <label for="dst_country_name" class="col-sm-3 text-end control-label col-form-label">Destination Country:</label>
                        <div class="col-sm-9">
                            <select id="dst_country_name" required name="dst_country_name" class="form-control">
                                <option value="">Select Destination Country</option>
                                @foreach($dest_countries->unique('country_name') as $destcountry)
                                <option value="{{ $destcountry->country_name }}" {{ old('dst_country_name') == $destcountry->country_name ? 'selected' : '' }}>{{ $destcountry->country_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @foreach([
                        ['dst_country_code', 'Country Code'],
                        ['dst_country_port', 'Port']
                    ] as [$name, $label])
                    <div class="form-group row">
                        <label for="{{ $name }}" class="col-sm-3 text-end control-label col-form-label">{{ $label }}:</label>
                        <div class="col-sm-9">
                            <select id="{{ $name }}" name="{{ $name }}" class="form-control" disabled>
                                <option value="">Select {{ $label }}</option>
                            </select>
                        </div>
                    </div>
                    @endforeach

                    <hr>

                    <!-- Transport Information -->
                    <div class="form-group row">
                        <label for="transport_name" class="col-sm-3 text-end control-label col-form-label">Transport Name:</label>
                        <div class="col-sm-9">
                            <select id="transport_name" required name="transport_name" class="form-control">
                                <option value="">Select Transport Name</option>
                                @foreach($transports as $transport)
                                <option value="{{ $transport->name }}" {{ old('transport_name') == $transport->name ? 'selected' : '' }}>{{ $transport->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @foreach([
                        ['transport_address', 'Transport Address'],
                        ['transport_port', 'Transport Port']
                    ] as [$name, $label])
                    <div class="form-group row">
                        <label for="{{ $name }}" class="col-sm-3 text-end control-label col-form-label">{{ $label }}:</label>
                        <div class="col-sm-9">
                            <select id="{{ $name }}" name="{{ $name }}" class="form-control" disabled>
                                <option value="">Select {{ $label }}</option>
                            </select>
                        </div>
                    </div>
                    @endforeach
                    <div class="form-group row">
                        <label for="section" class="col-sm-3 text-end control-label col-form-label">Section:</label>
                        <div class="col-sm-9">
                            <input readonly name="section" id="section" type="text" class="form-control" value="Private" placeholder="Private"/>
                        </div>
                    </div>

                    <hr>

                    <!-- TT Information -->
                    <div class="form-group row">
                        <label for="tt_no" class="col-sm-3 text-end control-label col-form-label">TT No:</label>
                        <div class="col-sm-9">
                            <input name="tt_no" required id="tt_no" type="text" class="form-control" value="{{ old('tt_no') }}" placeholder="Put TT No"/>
                            <span id="tt_validation" class="text-danger"></span>
                        </div>
                    </div>

                    {{-- <div class="form-group row">
                        <label for="tt_site" class="col-sm-3 text-end control-label col-form-label">TT Site</label>
                        <div class="col-sm-9">
                            <select name="tt_site" id="tt_site" class="form-control">
                                @foreach($exrter as $exrter)
                                <option value="{{$exrter->ExpoterName}}" {{ old('tt_site') == $exrter->ExpoterName ? 'selected' : '' }}>{{$exrter->ExpoterName}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="invoice_site" class="col-sm-3 text-end control-label col-form-label">Create By Site:</label>
                        <div class="col-sm-9">
                            <input type="text" name="invoice_site" id="invoice_site" class="form-control" value="{{ old('invoice_site') }}" placeholder="Put Origin Site">
                        </div>
                    </div> --}}
                    <div class="form-group row">
                        <label for="invoice_site" class="col-sm-3 text-end control-label col-form-label">Create By Site:</label>
                        <div class="col-sm-9">
                            <select name="invoice_site" id="invoice_site" class="form-control">
                                @foreach($exrter as $exrter)
                                    <option value="{{ $exrter->ExpoterName }}" {{ old('invoice_site') == $exrter->ExpoterName ? 'selected' : '' }}>
                                        {{ $exrter->ExpoterName }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="tt_date" class="col-sm-3 text-end control-label col-form-label">TT Date:</label>
                        <div class="col-sm-9">
                            <input name="tt_date" required id="tt_date" type="date" class="form-control" value="{{ old('tt_date') }}" placeholder="Put TT date"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Quantity & Value Entry -->
                <div class="col-6">
                    <h4>Quantity & Value Entry</h4>
                    <hr>
                    <div class="form-group row">
                        <label for="unit" class="col-sm-3 text-end control-label col-form-label">Unit:</label>
                        <div class="col-sm-9">
                            <select id="unit" required name="unit" class="form-control">
                                <option value="">Select Unit</option>
                                <option value="PCS" {{ old('unit') == 'PCS' ? 'selected' : '' }}>PCS</option>
                                <option value="SET" {{ old('unit') == 'SET' ? 'selected' : '' }}>SET</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="quantity" class="col-sm-3 text-end control-label col-form-label">Quantity:</label>
                        <div class="col-sm-9">
                            <input required name="quantity" id="quantity" type="number" class="form-control" value="{{ old('quantity') }}" placeholder="Quantity"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="currency" class="col-sm-3 text-end control-label col-form-label">Currency:</label>
                        <div class="col-sm-9">
                            <select required id="currency" name="currency" class="form-control">
                                <option value="">Select Currency</option>
                                <option value="USDollers" {{ old('currency') == 'USDollers' ? 'selected' : '' }}>USDollers</option>
                                <option value="EUros" {{ old('currency') == 'EUros' ? 'selected' : '' }}>EUros</option>
                                <option value="Pound" {{ old('currency') == 'Pound' ? 'selected' : '' }}>Pound</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="amount" class="col-sm-3 text-end control-label col-form-label">Amount:</label>
                        <div class="col-sm-9">
                            <input required name="amount" id="amount" type="number" step="0.0001" class="form-control" value="{{ old('amount') }}" placeholder="Amount"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cm_percentage" class="col-sm-3 text-end control-label col-form-label">CM Percentage:</label>
                        <div class="col-sm-9">
                            <input required readonly name="cm_percentage" id="cm_percentage" type="number" class="form-control" value="{{ $cmValue->cm_value ?? '' }}" placeholder="..%"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="incoterm" class="col-sm-3 text-end control-label col-form-label">Incoterm:</label>
                        <div class="col-sm-9">
                            <select id="incoterm" required name="incoterm" class="form-control">
                                <option value="">Select Incoterm</option>
                                @foreach(['FOB','CPT','CFR','DDP','FCA','CIF','DAP','EXW','CnF'] as $incoterm)
                                <option value="{{ $incoterm }}" {{ old('incoterm') == $incoterm ? 'selected' : '' }}>{{ $incoterm }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cm_amount" class="col-sm-3 text-end control-label col-form-label">CM Amount:</label>
                        <div class="col-sm-9">
                            <div id="incoterm_calculation">Calculate Automatically</div>
                        </div>
                    </div>
                    <div id="freight_value"></div>
                </div>

                <!--TODO: from making formate : Ex-Factory Information Entry -->
                <div class="col-6">
                    <h4>Ex-Factory Information Entry</h4>
                    <hr>
                    @foreach([
                        ['exp_no', 'Exp No', 'text'],
                        ['exp_date', 'Exp Date', 'date'],
                        ['exp_permit_no', 'Exp Permit No', 'text'],
                        ['bl_no', 'B/L No', 'text'],
                        ['bl_date', 'B/L Date', 'date'],
                        ['ex_factory_date', 'EX-Factory Date', 'date'],
                        ['net_wet', 'Net Wet', 'number'],
                        ['gross_wet', 'Gross Wet', 'number'],
                    ] as [$name, $label, $type])
                        <div class="form-group row">
                            <label for="{{ $name }}" class="col-sm-3 text-end control-label col-form-label">{{ $label }}:</label>
                            <div class="col-sm-9">
                                <input
                                    name="{{ $name }}"
                                    id="{{ $name }}"
                                    type="{{ $type }}"
                                    class="form-control"
                                    value="{{ old($name) }}"
                                    placeholder="{{ $label }}"
                                    @if($type === 'number') step="0.0001" @endif
                                />
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
var consignees = @json($consignees);
var dest_countries = @json($dest_countries);
var transports = @json($transports);
var notifies = @json($notifies);

$(document).ready(function() {
    // Invoice No Auto-Fill
    $('#invoice_no').on('input', function() {
        var invoiceNo = $(this).val();
        if (invoiceNo.length > 0) {
            $.ajax({
                url: "{{ route('exportFormApparel.fetchInvoiceData') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "invoice_no": invoiceNo
                },
                success: function(response) {
                    console.log(response);
                    if (response.status === 'success') {
                        $('#invoice_validation').html('');
                        $('#invoice_validation').html(response.message || 'Invoice data fetched successfully');
                        // Populate form fields
                        $('#item_name').val(response.data.item_name || '');
                        $('#hs_code').val(response.data.hs_code || '');
                        $('#hs_code_second').val(response.data.hs_code_second || '');
                        $('#invoice_date').val(response.data.invoice_date || '');
                        $('#contract_no').val(response.data.contract_no || '');
                        $('#contract_date').val(response.data.contract_date || '');
                        $('#consignee_name').val(response.data.consignee_name || '').trigger('change');
                        $('#notify_name').val(response.data.notify_name || '').trigger('change');
                        $('#dst_country_name').val(response.data.dst_country_name || '').trigger('change');
                        $('#transport_name').val(response.data.transport_name || '').trigger('change');
                        $('#tt_no').val(response.data.tt_no || '');
                        $('#invoice_site').val(response.data.invoice_site || '');
                        $('#tt_date').val(response.data.tt_date || '');
                        $('#unit').val(response.data.unit || '').trigger('change');
                        $('#quantity').val(response.data.quantity || '');
                        $('#currency').val(response.data.currency || '').trigger('change');
                        $('#amount').val(response.data.amount || '').trigger('input');
                        $('#incoterm').val(response.data.incoterm || '').trigger('change');
                        $('#exp_no').val(response.data.exp_no || '');
                        $('#exp_date').val(response.data.exp_date || '');
                        $('#exp_permit_no').val(response.data.exp_permit_no || '');
                        $('#bl_no').val(response.data.bl_no || '');
                        $('#bl_date').val(response.data.bl_date || '');
                        $('#ex_factory_date').val(response.data.ex_factory_date || '');
                        $('#net_wet').val(response.data.net_wet || '');
                        $('#gross_wet').val(response.data.gross_wet || '');

                        // Trigger cascades for dependent fields
                        setTimeout(function() {
                            $('#consignee_site').val(response.data.consignee_site || '').trigger('change');
                            setTimeout(function() {
                                $('#consignee_country').val(response.data.consignee_country || '').trigger('change');
                                setTimeout(function() {
                                    $('#consignee_address').val(response.data.consignee_address || '');
                                }, 100);
                            }, 100);
                            $('#dst_country_code').val(response.data.dst_country_code || '').trigger('change');
                            setTimeout(function() {
                                $('#dst_country_port').val(response.data.dst_country_port || '');
                            }, 100);
                            $('#transport_address').val(response.data.transport_address || '').trigger('change');
                            setTimeout(function() {
                                $('#transport_port').val(response.data.transport_port || '');
                            }, 100);
                        }, 100);
                    } else {
                        $('#invoice_validation').html(response.message || 'New Invoice No');
                    }
                },
                error: function() {
                    $('#invoice_validation').html('Error fetching invoice data');
                }
            });
        } else {
            $('#invoice_validation').html('');
        }
    });

    // Notify Cascade
    $('#notify_name').on('change', function() {
        var selectedName = $(this).val();
        if (selectedName) {
            var notify = notifies.find(n => n.name === selectedName);
            $('#notify_address').val(notify ? notify.address : '');
        } else {
            $('#notify_address').val('');
        }
    });

    // Consignee Cascade
    $('#consignee_name').on('change', function() {
        var consigneeName = $(this).val();
        $('#consignee_site').prop('disabled', true).html('<option value="">Select Consignee Site</option>');
        $('#consignee_country').prop('disabled', true).html('<option value="">Select Consignee Country</option>');
        $('#consignee_address').prop('disabled', true).html('<option value="">Select Consignee Address</option>');
        if (consigneeName) {
            var sites = [...new Set(consignees.filter(c => c.consignee_name === consigneeName).map(c => c.consignee_site))];
            $('#consignee_site').html('<option value="">Select Consignee Site</option>' + sites.map(site => `<option value="${site}">${site}</option>`).join(''));
            $('#consignee_site').prop('disabled', false);
        }
    });

    $('#consignee_site').on('change', function() {
        var consigneeName = $('#consignee_name').val();
        var consigneeSite = $(this).val();
        $('#consignee_country').prop('disabled', true).html('<option value="">Select Consignee Country</option>');
        $('#consignee_address').prop('disabled', true).html('<option value="">Select Consignee Address</option>');
        if (consigneeSite) {
            var countries = [...new Set(consignees.filter(c => c.consignee_name === consigneeName && c.consignee_site === consigneeSite).map(c => c.consignee_country))];
            $('#consignee_country').html('<option value="">Select Consignee Country</option>' + countries.map(country => `<option value="${country}">${country}</option>`).join(''));
            $('#consignee_country').prop('disabled', false);
        }
    });

    $('#consignee_country').on('change', function() {
        var consigneeName = $('#consignee_name').val();
        var consigneeSite = $('#consignee_site').val();
        var consigneeCountry = $(this).val();
        $('#consignee_address').prop('disabled', true).html('<option value="">Select Consignee Address</option>');
        if (consigneeCountry) {
            var addresses = [...new Set(consignees.filter(c => c.consignee_name === consigneeName && c.consignee_site === consigneeSite && c.consignee_country === consigneeCountry).map(c => c.consignee_address))];
            $('#consignee_address').html('<option value="">Select Consignee Address</option>' + addresses.map(address => `<option value="${address}">${address}</option>`).join(''));
            $('#consignee_address').prop('disabled', false);
        }
    });

    // Destination Country Cascade
    $('#dst_country_name').on('change', function() {
        var countryName = $(this).val();
        $('#dst_country_code').prop('disabled', true).html('<option value="">Select Country Code</option>');
        $('#dst_country_port').prop('disabled', true).html('<option value="">Select Port</option>');
        if (countryName) {
            var codes = [...new Set(dest_countries.filter(c => c.country_name === countryName).map(c => c.country_code))];
            $('#dst_country_code').html('<option value="">Select Country Code</option>' + codes.map(code => `<option value="${code}">${code}</option>`).join(''));
            $('#dst_country_code').prop('disabled', false);
        }
    });

    $('#dst_country_code').on('change', function() {
        var countryName = $('#dst_country_name').val();
        var countryCode = $(this).val();
        $('#dst_country_port').prop('disabled', true).html('<option value="">Select Port</option>');
        if (countryCode) {
            var ports = [...new Set(dest_countries.filter(c => c.country_name === countryName && c.country_code === countryCode).map(c => c.port))];
            $('#dst_country_port').html('<option value="">Select Port</option>' + ports.map(port => `<option value="${port}">${port}</option>`).join(''));
            $('#dst_country_port').prop('disabled', false);
        }
    });

    // Transport Cascade
    $('#transport_name').on('change', function() {
        var transportName = $(this).val();
        $('#transport_address').prop('disabled', true).html('<option value="">Select Transport Address</option>');
        $('#transport_port').prop('disabled', true).html('<option value="">Select Transport Port</option>');
        if (transportName) {
            var addresses = [...new Set(transports.filter(t => t.name === transportName).map(t => t.address))];
            $('#transport_address').html('<option value="">Select Transport Address</option>' + addresses.map(address => `<option value="${address}">${address}</option>`).join(''));
            $('#transport_address').prop('disabled', false);
        }
    });

    $('#transport_address').on('change', function() {
        var transportName = $('#transport_name').val();
        var transportAddress = $(this).val();
        $('#transport_port').prop('disabled', true).html('<option value="">Select Transport Port</option>');
        if (transportAddress) {
            var ports = [...new Set(transports.filter(t => t.name === transportName && t.address === transportAddress).map(t => t.port))];
            $('#transport_port').html('<option value="">Select Transport Port</option>' + ports.map(port => `<option value="${port}">${port}</option>`).join(''));
            $('#transport_port').prop('disabled', false);
        }
    });

    // TT No Validation (AJAX)
    $('#tt_no').on('input', function () {
        var tt_no = $(this).val();
        if (tt_no.length > 0) {
            $.ajax({
                url: "{{ route('exportFormApparel.addExportFormApparelTtNo') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "tt_no": tt_no
                },
                success: function (response) {
                    $('#tt_validation').html(response.html);

                    if (response.tt_date) {
                        $('#tt_date').val(response.tt_date);
                        console.log(response.tt_date)
                    } else {
                        $('#tt_date').val('');
                    }
                }
            });
        } else {
            $('#tt_validation').html('');
            $('#tt_date').val('');
        }
    });


    // Incoterm Calculation
    function updateIncotermCalculation() {
        var cm_percentage = parseFloat($('#cm_percentage').val());
        var amount = parseFloat($('#amount').val());
        var incoterm = $('#incoterm').val();

        if (!isNaN(cm_percentage) && !isNaN(amount) && incoterm) {
            if (['FOB', 'CFR', 'FCA', 'EXW', 'CnF'].includes(incoterm)) {
                var incoterm_calculation = (amount / 100) * cm_percentage;
                var output = '<input readonly name="cm_amount" id="cm_amount" type="text" class="form-control" value="' + incoterm_calculation.toFixed(2) + '" placeholder="' + incoterm_calculation.toFixed(2) + '"/>';
                $('#incoterm_calculation').html(output);
                $('#freight_value').html('');
            } else if (['CPT', 'CIF', 'DAP', 'DDP'].includes(incoterm)) {
                var incoterm_calculation = (amount / 100) * cm_percentage;
                var output = '<input readonly name="cm_amount" id="cm_amount" type="text" class="form-control" value="' + incoterm_calculation.toFixed(2) + '" placeholder="' + incoterm_calculation.toFixed(2) + '"/>';
                var output1 = '<div class="form-group row">' +
                             '<label for="freight_value_input" class="col-sm-3 text-end control-label col-form-label">Freight Value:</label>' +
                             '<div class="col-sm-9">' +
                             '<input name="freight_value" id="freight_value_input" type="text" class="form-control" placeholder="Freight Value"/>' +
                             '</div></div>';
                $('#incoterm_calculation').html(output);
                $('#freight_value').html(output1);
            } else {
                $('#incoterm_calculation').html('Calculate Automatically');
                $('#freight_value').html('');
            }
        } else {
            $('#incoterm_calculation').html('Calculate Automatically');
            $('#freight_value').html('');
        }
    }

    $('#cm_percentage, #amount').on('input', updateIncotermCalculation);
    $('#incoterm').on('change', updateIncotermCalculation);

    // Trigger calculations and cascades for old input
    if ($('#consignee_name').val()) {
        $('#consignee_name').trigger('change');
        setTimeout(function() {
            if ($('#consignee_site').data('old')) $('#consignee_site').val($('#consignee_site').data('old')).trigger('change');
            if ($('#consignee_country').data('old')) $('#consignee_country').val($('#consignee_country').data('old')).trigger('change');
            if ($('#consignee_address').data('old')) $('#consignee_address').val($('#consignee_address').data('old'));
        }, 300);
    }
    if ($('#dst_country_name').val()) {
        $('#dst_country_name').trigger('change');
        setTimeout(function() {
            if ($('#dst_country_code').data('old')) $('#dst_country_code').val($('#dst_country_code').data('old')).trigger('change');
            if ($('#dst_country_port').data('old')) $('#dst_country_port').val($('#dst_country_port').data('old'));
        }, 300);
    }
    if ($('#transport_name').val()) {
        $('#transport_name').trigger('change');
        setTimeout(function() {
            if ($('#transport_address').data('old')) $('#transport_address').val($('#transport_address').data('old')).trigger('change');
            if ($('#transport_port').data('old')) $('#transport_port').val($('#transport_port').data('old'));
        }, 300);
    }
    updateIncotermCalculation();
});
</script>
@endsection
