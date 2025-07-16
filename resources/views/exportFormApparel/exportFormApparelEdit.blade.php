@extends('template.index')

@section('content')
<div class="card">
    <div class="card-header">
        <a href="{{ route('exportFormApparel.exportFormApparel') }}" class="btn btn-success btn-sm">Back</a>
    </div>
    <x-message/>
    <div class="card-body">
        <form action="{{ route('exportFormApparel.exportFormApparelUpdate', $exportForm->id) }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-6">
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
                            <input type="{{ $type }}" {{ $required ? 'required' : '' }} name="{{ $name }}" class="form-control" id="{{ $name }}" placeholder="{{ $label }}" value="{{ old($name, $exportForm->$name) }}" />
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="col-6">
                    <div class="form-group row">
                        <label for="consignee_name" class="col-sm-3 text-end control-label col-form-label">Consignee Name:</label>
                        <div class="col-sm-9">
                            <select id="consignee_name" required name="consignee_name" class="form-control">
                                <option value="">Select Consignee Name</option>
                                @foreach($consignees->unique('consignee_name') as $consignee)
                                <option value="{{ $consignee->consignee_name }}" {{ old('consignee_name', $exportForm->consignee_name) == $consignee->consignee_name ? 'selected' : '' }}>{{ $consignee->consignee_name }}</option>
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
                            <select id="{{ $name }}" name="{{ $name }}" class="form-control" disabled data-old="{{ old($name, $exportForm->$name) }}">
                                <option value="">Select {{ $label }}</option>
                            </select>
                        </div>
                    </div>
                    @endforeach

                    <hr>

                    <div class="form-group row">
                        <label for="notify_name" class="col-sm-3 text-end control-label col-form-label">Notify:</label>
                        <div class="col-sm-9">
                            <select id="notify_name" required name="notify_name" class="form-control">
                                <option value="">Select Notify</option>
                                @foreach($notifies as $notify)
                                <option value="{{ $notify->name }}" {{ old('notify_name', $exportForm->notify_name) == $notify->name ? 'selected' : '' }}>{{ $notify->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group row mt-3">
                            <label for="notify_address" class="col-sm-3 text-end control-label col-form-label">Address:</label>
                            <div class="col-sm-9">
                                <input type="text" id="notify_address" name="notify_address" class="form-control"
                                    value="{{ old('notify_address', $exportForm->notify_address) }}" readonly>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <!-- Destination Country & Transport Information -->
                    <div class="form-group row">
                        <label for="dst_country_name" class="col-sm-3 text-end control-label col-form-label">Destination Country:</label>
                        <div class="col-sm-9">
                            <select id="dst_country_name" required name="dst_country_name" class="form-control">
                                <option value="">Select Destination Country</option>
                                @foreach($dest_countries->unique('country_name') as $destcountry)
                                <option value="{{ $destcountry->country_name }}" {{ old('dst_country_name', $exportForm->dst_country_name) == $destcountry->country_name ? 'selected' : '' }}>{{ $destcountry->country_name }}</option>
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
                            <select id="{{ $name }}" name="{{ $name }}" class="form-control" disabled data-old="{{ old($name, $exportForm->$name) }}">
                                <option value="">Select {{ $label }}</option>
                            </select>
                        </div>
                    </div>
                    @endforeach

                    <hr>
                    <!-- Transport Information Entry -->
                    <div class="form-group row">
                        <label for="transport_name" class="col-sm-3 text-end control-label col-form-label">Transport Name:</label>
                        <div class="col-sm-9">
                            <select id="transport_name" required name="transport_name" class="form-control">
                                <option value="">Select Transport Name</option>
                                @foreach($transports as $transport)
                                <option value="{{ $transport->name }}" {{ old('transport_name', $exportForm->transport_name) == $transport->name ? 'selected' : '' }}>{{ $transport->name }}</option>
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
                            <select id="{{ $name }}" name="{{ $name }}" class="form-control" disabled data-old="{{ old($name, $exportForm->$name) }}">
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

                    <div class="form-group row">
                        <label for="tt_no" class="col-sm-3 text-end control-label col-form-label">TT No:</label>
                        <div class="col-sm-9">
                            <input name="tt_no" required id="tt_no" type="text" class="form-control" value="{{ old('tt_no', $exportForm->tt_no) }}" placeholder="Put TT No"/>
                            <span id="tt_validation" class="text-danger"></span>
                        </div>
                    </div>

                    {{-- <div class="form-group row">
                        <label for="invoice_site" class="col-sm-3 text-end control-label col-form-label">Create By Site:</label>
                        <div class="col-sm-9">
                            <input type="text" name="invoice_site" id="invoice_site" class="form-control" value="{{ old('invoice_site', $exportForm->invoice_site) }}" placeholder="Put Origin Site">
                        </div>
                    </div> --}}

                    <div class="form-group row">
                        <label for="invoice_site" class="col-sm-3 text-end control-label col-form-label">Create By Site:</label>
                        <div class="col-sm-9">
                            <select name="invoice_site" id="invoice_site" class="form-control">
                                @foreach($exrter as $exrter)
                                    <option value="{{ $exrter->ExpoterName }}" {{ $exportForm->invoice_site == $exrter->ExpoterName ? 'selected' : '' }}>
                                        {{ $exrter->ExpoterName }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="tt_date" class="col-sm-3 text-end control-label col-form-label">TT Date:</label>
                        <div class="col-sm-9">
                            <input name="tt_date" required id="tt_date" type="date" class="form-control" value="{{ old('tt_date', $exportForm->tt_date) }}" placeholder="Put TT date"/>
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
                                <option value="PCS" {{ old('unit', $exportForm->unit) == 'PCS' ? 'selected' : '' }}>PCS</option>
                                <option value="SET" {{ old('unit', $exportForm->unit) == 'SET' ? 'selected' : '' }}>SET</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="quantity" class="col-sm-3 text-end control-label col-form-label">Quantity:</label>
                        <div class="col-sm-9">
                            <input required name="quantity" id="quantity" type="number" class="form-control" value="{{ old('quantity', $exportForm->quantity) }}" placeholder="Quantity"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="currency" class="col-sm-3 text-end control-label col-form-label">Currency:</label>
                        <div class="col-sm-9">
                            <select required id="currency" name="currency" class="form-control">
                                <option value="USDollers" {{ old('currency', $exportForm->currency) == 'USDollers' ? 'selected' : '' }}>USDollers</option>
                                <option value="EUros" {{ old('currency', $exportForm->currency) == 'EUros' ? 'selected' : '' }}>EUros</option>
                                <option value="Pound" {{ old('currency', $exportForm->currency) == 'Pound' ? 'selected' : '' }}>Pound</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="amount" class="col-sm-3 text-end control-label col-form-label">Amount:</label>
                        <div class="col-sm-9">
                            <input required name="amount" id="amount" type="number" class="form-control" value="{{ old('amount', $exportForm->amount) }}" placeholder="Amount"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cm_percentage" class="col-sm-3 text-end control-label col-form-label">CM Percentage:</label>
                        <div class="col-sm-9">
                            <input required readonly name="cm_percentage" id="cm_percentage" type="number" class="form-control" value="{{ $cmValue->cm_value }}" placeholder="..%"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="incoterm" class="col-sm-3 text-end control-label col-form-label">Incoterm:</label>
                        <div class="col-sm-9">
                            <select id="incoterm" required name="incoterm" class="form-control">
                                <option value="">Select Incoterm</option>
                                @foreach(['FOB','CPT','CFR','DDP','FCA','CIF','DAP','EXW','CnF'] as $incoterm)
                                <option value="{{ $incoterm }}" {{ old('incoterm', $exportForm->incoterm) == $incoterm ? 'selected' : '' }}>{{ $incoterm }}</option>
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
                            id="{{ $name }}" type="{{ $type }}"
                            class="form-control"
                            value="{{ old($name, $exportForm->$name) }}"
                            placeholder="{{ $label }}"
                            @if($type === 'number') step="0.0001" @endif
                            />
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
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

    // Consignee Cascade with auto-select
    $('#consignee_name').on('change', function() {
        var consigneeName = $(this).val();
        $('#consignee_site').prop('disabled', true).html('<option value="">Select Consignee Site</option>');
        $('#consignee_country').prop('disabled', true).html('<option value="">Select Consignee Country</option>');
        $('#consignee_address').prop('disabled', true).html('<option value="">Select Consignee Address</option>');
        if (consigneeName) {
            var sites = [...new Set(consignees.filter(c => c.consignee_name === consigneeName).map(c => c.consignee_site))];
            $('#consignee_site').html('<option value="">Select Consignee Site</option>' + sites.map(site => `<option value="${site}">${site}</option>`).join(''));
            $('#consignee_site').prop('disabled', false);

            // Auto-select old value if present
            var oldSite = $('#consignee_site').data('old');
            if (oldSite) {
                $('#consignee_site').val(oldSite).trigger('change');
            }
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

            var oldCountry = $('#consignee_country').data('old');
            if (oldCountry) {
                $('#consignee_country').val(oldCountry).trigger('change');
            }
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

            var oldAddress = $('#consignee_address').data('old');
            if (oldAddress) {
                $('#consignee_address').val(oldAddress);
            }
        }
    });

    // Destination Country Cascade with auto-select
    $('#dst_country_name').on('change', function() {
        var countryName = $(this).val();
        $('#dst_country_code').prop('disabled', true).html('<option value="">Select Country Code</option>');
        $('#dst_country_port').prop('disabled', true).html('<option value="">Select Port</option>');
        if (countryName) {
            var codes = [...new Set(dest_countries.filter(c => c.country_name === countryName).map(c => c.country_code))];
            $('#dst_country_code').html('<option value="">Select Country Code</option>' + codes.map(code => `<option value="${code}">${code}</option>`).join(''));
            $('#dst_country_code').prop('disabled', false);

            var oldCode = $('#dst_country_code').data('old');
            if (oldCode) {
                $('#dst_country_code').val(oldCode).trigger('change');
            }
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

            var oldPort = $('#dst_country_port').data('old');
            if (oldPort) {
                $('#dst_country_port').val(oldPort);
            }
        }
    });

    // Transport Cascade with auto-select
    $('#transport_name').on('change', function() {
        var transportName = $(this).val();
        $('#transport_address').prop('disabled', true).html('<option value="">Select Transport Address</option>');
        $('#transport_port').prop('disabled', true).html('<option value="">Select Transport Port</option>');
        if (transportName) {
            var addresses = [...new Set(transports.filter(t => t.name === transportName).map(t => t.address))];
            $('#transport_address').html('<option value="">Select Transport Address</option>' + addresses.map(address => `<option value="${address}">${address}</option>`).join(''));
            $('#transport_address').prop('disabled', false);

            var oldAddress = $('#transport_address').data('old');
            if (oldAddress) {
                $('#transport_address').val(oldAddress).trigger('change');
            }
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

            var oldPort = $('#transport_port').data('old');
            if (oldPort) {
                $('#transport_port').val(oldPort);
            }
        }
    });

    // TT No Validation (AJAX)
    $('#tt_no').on('input', function() {
        var tt_no = $(this).val();
        if(tt_no.length > 0){
            $.ajax({
                url: "{{ route('exportFormApparel.addExportFormApparelTtNo') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "tt_no": tt_no
                },
                success: function(response) {
                    $('#tt_validation').html(response);
                }
            });
        } else {
            $('#tt_validation').html('');
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

    // On page load, trigger only the first dropdown in each cascade
    if($('#consignee_name').val()){
        $('#consignee_name').trigger('change');
    }
    if($('#dst_country_name').val()){
        $('#dst_country_name').trigger('change');
    }
    if($('#transport_name').val()){
        $('#transport_name').trigger('change');
    }
    if($('#notify_name').val()){
        $('#notify_name').trigger('change');
    }
    updateIncotermCalculation();
});
</script>
@endsection
