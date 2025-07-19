@extends('template.index')
@section('content')

@php $s = $shipping; @endphp
<div class="card">
    <div class="card-header">
    </div>
    <div class="card-body">
        <h4 class="card-title">
            <a href="{{route('shipping.shipping')}}" class="btn btn-dark">Back</a>
            <a href="{{route('shipping.updateShipping', $s->id)}}" class="btn btn-info">Update</a>
            <a href="" class="btn btn-danger">Delete</a>
        </h4>
        <x-message/>

        <div class="row">
            <div class="col-6">
                <hr>
                <h5>Shipment Status Information</h5>
                <hr>
                @php
                    $shipmentFields = [
                        ['label' => 'Invoice No', 'name' => 'invoice_no', 'type' => 'text', 'value' => $s->invoice_no, 'readonly' => true],
                        ['label' => 'Factory', 'name' => 'factory', 'type' => 'text', 'value' => $s->factory],
                        ['label' => 'Ep No', 'name' => 'ep_no', 'type' => 'text', 'value' => $s->ep_no],
                        ['label' => 'Ep Date', 'name' => 'ep_date', 'type' => 'date', 'value' => $s->ep_date],
                        ['label' => 'Exp No', 'name' => 'exp_no', 'type' => 'text', 'value' => $s->exp_no],
                        ['label' => 'Exp Date', 'name' => 'exp_date', 'type' => 'date', 'value' => $s->exp_date],
                        ['label' => 'Ex-Factory Date', 'name' => 'ex_factory_date', 'type' => 'date', 'value' => $s->ex_factory_date],
                        ['label' => 'SB No', 'name' => 'sb_no', 'type' => 'text', 'value' => $s->sb_no],
                        ['label' => 'SB Date', 'name' => 'sb_date', 'type' => 'date', 'value' => $s->sb_date],
                    ];
                @endphp

                @foreach ($shipmentFields as $field)
                    <div class="form-group row">
                        <label for="{{ $field['name'] }}" class="col-sm-3 text-end control-label col-form-label">{{ $field['label'] }}:</label>
                        <div class="col-sm-9">
                            <input
                                type="{{ $field['type'] }}"
                                name="{{ $field['name'] }}"
                                class="form-control"
                                id="{{ $field['name'] }}"
                                value="{{ $field['value'] }}"
                                @if (isset($field['readonly']) && $field['readonly']) readonly @endif
                                @if ($field['name'] === 'invoice_no') required @endif
                            />
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="col-6">
                <hr>
                <h5>Other Information</h5>
                <hr>
                <div class="form-group row">
                    <label for="transport_port" class="col-sm-3 text-end control-label col-form-label">Local Transport:</label>
                    <div class="col-sm-9">
                        <select name="transport_port" id="transport_port" class="form-control">
                            <option value="{{ $s->transport_port }}">{{ $s->transport_port }}</option>
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

                <hr>
                <h5>Remarks</h5>
                <hr>
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
            </div>
        </div>
    </div>
</div>
@endsection
