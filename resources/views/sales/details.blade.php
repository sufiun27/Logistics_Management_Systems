@extends('template.index')
@section('content')
    <div class="card">

        {{-- <div class="card-header">
            <label for="invoice_no">Invoice No: </label>
            <input id="invoice_no" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <div id="invoices"></div>
        </div> --}}

        <div class="card-title">
            <a href="{{route('sales.index')}}" class="btn btn-success">Back</a>
            <a href="{{route('sales.delete',$s->id)}}" class="btn btn-danger">Delete</a>
            <x-message/>
        </div>
        @php
        // Define the form sections and fields in an array
        $formSections = [
            [
                'title' => 'Item Info Entry',
                'fields' => [
                    [
                        'label' => 'Invoice No:',
                        'name' => 'invoice_no',
                        'type' => 'text',
                        'readonly' => true,
                        'placeholder' => 'Invoice No',
                        'value' => $s->invoice_no,
                        'required' => true,
                        'wrapper' => 'displayDiv' // Optional wrapper div ID
                    ],
                    [
                        'label' => 'Buyer Contract:',
                        'name' => 'buyer_contract',
                        'type' => 'text',
                        'placeholder' => 'Buyer Contract',
                        'value' => $s->buyer_contract
                    ],
                    [
                        'label' => 'Order No:',
                        'name' => 'order_no',
                        'type' => 'text',
                        'placeholder' => 'Order No',
                        'value' => $s->order_no
                    ],
                    [
                        'label' => 'Style No:',
                        'name' => 'style_no',
                        'type' => 'text',
                        'placeholder' => 'Style No',
                        'value' => $s->style_no
                    ],
                    [
                        'label' => 'Product Type:',
                        'name' => 'product_type',
                        'type' => 'text',
                        'placeholder' => 'Product Type',
                        'value' => $s->product_type
                    ]
                ]
            ],
            [
                'title' => 'Quantity & Value',
                'fields' => [
                    [
                        'label' => 'Shipped Quantity:',
                        'name' => 'shipped_qty',
                        'type' => 'number',
                        'placeholder' => 'Shipped Quantity',
                        'value' => $s->shipped_qty
                    ],
                    [
                        'label' => 'Carton Quantity:',
                        'name' => 'carton_qty',
                        'type' => 'number',
                        'placeholder' => 'Shipped Carton Quantity',
                        'value' => $s->carton_qty
                    ],
                    [
                        'label' => 'Shipped FOB Value:',
                        'name' => 'shipped_fob_value',
                        'type' => 'text',
                        'placeholder' => 'Shipped FOB Value',
                        'value' => $s->shipped_fob_value
                    ],
                    [
                        'label' => 'Shipped CM Value:',
                        'name' => 'shipped_cm_value',
                        'type' => 'text',
                        'placeholder' => 'Shipped CM Value',
                        'value' => $s->shipped_cm_value
                    ],
                    [
                        'label' => 'Shipped CBM Value:',
                        'name' => 'cbm_value',
                        'type' => 'text',
                        'placeholder' => 'Shipped CBM Value',
                        'value' => $s->cbm_value
                    ],
                    [
                        'label' => 'Gross Wet:',
                        'name' => 'gross_wet',
                        'type' => 'text',
                        'placeholder' => 'Gross Wet',
                        'value' => $s->gross_wet
                    ],
                    [
                        'label' => 'Net Wet:',
                        'name' => 'net_wet',
                        'type' => 'text',
                        'placeholder' => 'Net Wet',
                        'value' => $s->net_wet
                    ]
                ]
            ],
            [
                'title' => 'Shipment Status Info',
                'fields' => [
                    [
                        'label' => 'ETA Date:',
                        'name' => 'eta_date',
                        'type' => 'date',
                        'value' => $s->eta_date
                    ],
                    [
                        'label' => 'Vessel Name:',
                        'name' => 'vessel_name',
                        'type' => 'text',
                        'placeholder' => 'Vessel Name',
                        'value' => $s->vessel_name
                    ],
                    [
                        'label' => 'Shipboarding Date:',
                        'name' => 'shipbording_date',
                        'type' => 'date',
                        'value' => $s->shipbording_date
                    ],
                    [
                        'label' => 'BL No:',
                        'name' => 'bl_no',
                        'type' => 'text',
                        'placeholder' => 'BL No',
                        'value' => $s->bl_no
                    ],
                    [
                        'label' => 'BL Date:',
                        'name' => 'bl_date',
                        'type' => 'date',
                        'value' => $s->bl_date
                    ]
                ]
            ],
            [
                'title' => 'Exception Value',
                'fields' => [
                    [
                        'label' => 'Final Quantity:',
                        'name' => 'final_qty',
                        'type' => 'number',
                        'placeholder' => 'Final Quantity',
                        'value' => $s->final_qty
                    ],
                    [
                        'label' => 'Final FOB:',
                        'name' => 'final_fob',
                        'type' => 'text',
                        'placeholder' => 'Final FOB',
                        'value' => $s->final_fob
                    ],
                    [
                        'label' => 'Final CM:',
                        'name' => 'final_cm',
                        'type' => 'text',
                        'placeholder' => 'Final CM',
                        'value' => $s->final_cm
                    ],
                    [
                        'label' => 'Remarks:',
                        'name' => 'remarks',
                        'type' => 'textarea',
                        'placeholder' => 'Remarks',
                        'value' => $s->remarks
                    ]
                ]
            ]
        ];
        @endphp

        <form class="form-horizontal" action="{{ route('sales.update', $s->id) }}" method="POST">
            @csrf

            <div class="row">
                @foreach ($formSections as $section)
                    <div class="col-6">
                        <hr>
                        <h3>&nbsp;&nbsp; {{ $section['title'] }}</h3>
                        <hr>
                        @foreach ($section['fields'] as $field)
                            <div class="form-group row">
                                <label for="{{ $field['name'] }}" class="col-sm-3 text-end control-label col-form-label">{{ $field['label'] }}</label>
                                <div class="col-sm-9">
                                    @if (isset($field['wrapper']))
                                        <div id="{{ $field['wrapper'] }}">
                                    @endif
                                    @if ($field['type'] === 'textarea')
                                        <textarea
                                            name="{{ $field['name'] }}"
                                            class="form-control"
                                            id="{{ $field['name'] }}"
                                            placeholder="{{ $field['placeholder'] ?? '' }}"
                                        >{{ $field['value'] }}</textarea>
                                    @else
                                        <input
                                            type="{{ $field['type'] }}"
                                            name="{{ $field['name'] }}"
                                            class="form-control"
                                            id="{{ $field['name'] }}"
                                            placeholder="{{ $field['placeholder'] ?? '' }}"
                                            value="{{ $field['value'] }}"
                                            @if (isset($field['readonly']) && $field['readonly']) readonly @endif
                                            @if (isset($field['required']) && $field['required']) required @endif
                                            @if ($field['type'] === 'number') step="0.01" @endif
                                        />
                                    @endif
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
                    <input type="submit" value="Update" class="btn btn-primary">
                </div>
            </div>
        </form>


        </div>
    </div>



@endsection
