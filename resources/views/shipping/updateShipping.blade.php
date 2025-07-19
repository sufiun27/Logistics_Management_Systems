@extends('template.index')
@section('content')

@php $s = $shipping; @endphp
<div class="card">
    <div class="card-header">
    </div>
    <div class="card-body">
        <h4 class="card-title">
            <a href="{{route('shipping.shipping')}}" class="btn btn-dark">Back</a>
        </h4>
        <x-message/>

        <div class="row">
            <div class="col-6">
                <hr>
                <h5>Shipment Status Information</h5>
                <hr>
                @php
    use App\Models\Export;

    // Fetch unique factory names from the Export model
    $exporters = Export::pluck('ExpoterName', 'ExpoterName'); // ['ABC Ltd' => 'ABC Ltd', ...]

    $shipmentFields = [
        ['label' => 'Invoice No', 'name' => 'invoice_no', 'type' => 'text', 'value' => $s->invoice_no, 'readonly' => true],
        ['label' => 'Factory', 'name' => 'factory', 'type' => 'select', 'value' => $s->factory], // changed type to 'select'
        ['label' => 'Ep No', 'name' => 'ep_no', 'type' => 'text', 'value' => $s->ep_no],
        ['label' => 'Ep Date', 'name' => 'ep_date', 'type' => 'date', 'value' => $s->ep_date],
        ['label' => 'Exp No', 'name' => 'exp_no', 'type' => 'text', 'value' => $s->exp_no],
        ['label' => 'Exp Date', 'name' => 'exp_date', 'type' => 'date', 'value' => $s->exp_date],
        ['label' => 'Ex-Factory Date', 'name' => 'ex_factory_date', 'type' => 'date', 'value' => $s->ex_factory_date],
        ['label' => 'SB No', 'name' => 'sb_no', 'type' => 'text', 'value' => $s->sb_no],
        ['label' => 'SB Date', 'name' => 'sb_date', 'type' => 'date', 'value' => $s->sb_date],
    ];
@endphp

<form action="{{ route('shipping.updateShippingStatusInfo', $s->id) }}" method="POST">
    @csrf

    @foreach ($shipmentFields as $field)
        <div class="form-group row">
            <label for="{{ $field['name'] }}" class="col-sm-3 text-end control-label col-form-label">
                {{ $field['label'] }}:
            </label>
            <div class="col-sm-9">
                @if ($field['type'] === 'select' && $field['name'] === 'factory')
                    <select name="{{ $field['name'] }}" id="{{ $field['name'] }}" class="form-control">
                        <option value="">Select Factory</option>
                        @foreach ($exporters as $value => $label)
                            <option value="{{ $value }}" {{ $field['value'] == $value ? 'selected' : '' }}>
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
                        value="{{ $field['value'] }}"
                        @if (isset($field['readonly']) && $field['readonly']) readonly @endif
                        @if ($field['name'] === 'invoice_no') required @endif
                    />
                @endif
            </div>
        </div>
    @endforeach

    <div class="border-top">
        <div class="card-body">
            <input type="submit" value="Update Shipment Status Information" class="btn btn-success">
        </div>
    </div>
</form>

            </div>

            <div class="col-6">
                <hr>
                <h5>Other Information</h5>
                <hr>
                <form action="{{route('shipping.updateOtherInformation', $s->id)}}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label for="transport_port" class="col-sm-3 text-end control-label col-form-label">Local Transport:</label>
                        <div class="col-sm-9">
                            <select name="transport_port" id="transport_port" class="form-control">
                                @foreach ($transports as $transport)
                                    <option value="{{ $transport->port }}"
                                        @if ($transport->port == $s->transport_port) class="bg-success" selected @endif>
                                        {{ $transport->port }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    @php
                        $otherFields = [
                            ['label' => 'CNF Agent', 'name' => 'cnf_agent', 'type' => 'text', 'value' => $s->cnf_agent],
                            ['label' => 'Vessel No', 'name' => 'vessel_no', 'type' => 'text', 'value' => $s->vessel_no],
                            ['label' => 'Cargo Report Date', 'name' => 'cargorpt_date', 'type' => 'date', 'value' => $s->cargorpt_date],
                        ];
                    @endphp

                    @foreach ($otherFields as $field)
                        <div class="form-group row">
                            <label for="{{ $field['name'] }}" class="col-sm-3 text-end control-label col-form-label">{{ $field['label'] }}:</label>
                            <div class="col-sm-9">
                                <input
                                    type="{{ $field['type'] }}"
                                    name="{{ $field['name'] }}"
                                    class="form-control"
                                    id="{{ $field['name'] }}"
                                    value="{{ $field['value'] }}"
                                />
                            </div>
                        </div>
                    @endforeach

                    <div class="border-top">
                        <div class="card-body">
                            <input type="submit" value="Update Other Information" class="btn btn-success">
                        </div>
                    </div>
                </form>

                <hr>
                <h5>Remarks</h5>
                <hr>
                <form action="{{route('shipping.updateRemarks', $s->id)}}" method="POST">
                    @csrf
                    @php
                        $remarkFields = [
                            ['label' => 'Bring Back', 'name' => 'bring_back', 'value' => $s->bring_back],
                            ['label' => 'Shipped Out', 'name' => 'shipped_out', 'value' => $s->shipped_out],
                            ['label' => 'Shipped Cancel', 'name' => 'shipped_cancel', 'value' => $s->shipped_cancel],
                            ['label' => 'Shipped Back', 'name' => 'shipped_back', 'value' => $s->shipped_back],
                            ['label' => 'Un-Shipped', 'name' => 'unshipped', 'value' => $s->unshipped],
                        ];
                    @endphp

                    @foreach ($remarkFields as $field)
                        <div class="form-group row">
                            <label for="{{ $field['name'] }}" class="col-sm-3 text-end control-label col-form-label">{{ $field['label'] }}:</label>
                            <div class="col-sm-9">
                                <input
                                    type="text"
                                    name="{{ $field['name'] }}"
                                    class="form-control"
                                    id="{{ $field['name'] }}"
                                    value="{{ $field['value'] }}"
                                />
                            </div>
                        </div>
                    @endforeach

                    <div class="border-top">
                        <div class="card-body">
                            <input type="submit" value="Update Remarks" class="btn btn-success">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
