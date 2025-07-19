@extends('template.index')
@section('content')
    <div class="card">

        <div class="card-header">
            <label for="invoice_no">Invoice No: </label>
            <input id="invoice_no" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <div id="invoices"></div>
        </div>

        <div class="card-title">
            <a href="{{route('sales.index')}}" class="btn btn-success">Back</a>
            <x-message/>
        </div>
        <form class="form-horizontal" action="{{ route('sales.store') }}" method="POST">
            @csrf

            @php
                $formSections = [
                    [
                        'title' => 'Item Info Entry',
                        'fields' => [
                            [
                                'label' => 'Invoice No',
                                'name' => 'invoice_no',
                                'type' => 'text',
                                'placeholder' => 'Invoice No',
                                'required' => true,
                                'wrapper' => 'displayDiv'
                            ],
                            [
                                'label' => 'Buyer Contract',
                                'name' => 'buyer_contract',
                                'type' => 'text',
                                'placeholder' => 'Buyer Contract',
                                'required' => false
                            ],
                            [
                                'label' => 'Order No',
                                'name' => 'order_no',
                                'type' => 'text',
                                'placeholder' => 'Order No',
                                'required' => false
                            ],
                            [
                                'label' => 'Style No',
                                'name' => 'style_no',
                                'type' => 'text',
                                'placeholder' => 'Style No',
                                'required' => false
                            ],
                            [
                                'label' => 'Product Type',
                                'name' => 'product_type',
                                'type' => 'text',
                                'placeholder' => 'Product Type',
                                'required' => false
                            ]
                        ]
                    ],
                    [
                        'title' => 'Quantity & Value',
                        'fields' => [
                            [
                                'label' => 'Shipped Quantity',
                                'name' => 'shipped_qty',
                                'type' => 'number',
                                'placeholder' => 'Shipped Quantity',
                                'required' => false
                            ],
                            [
                                'label' => 'Carton Quantity',
                                'name' => 'carton_qty',
                                'type' => 'number',
                                'placeholder' => 'Shipped Carton Quantity',
                                'required' => false
                            ],
                            [
                                'label' => 'Shipped FOB Value',
                                'name' => 'shipped_fob_value',
                                'type' => 'number',
                                'placeholder' => 'Shipped FOB Value',
                                'required' => false
                            ],
                            [
                                'label' => 'Shipped CM Value',
                                'name' => 'shipped_cm_value',
                                'type' => 'number',
                                'placeholder' => 'Shipped CM Value',
                                'value' => 20,
                                'required' => false
                            ],
                            [
                                'label' => 'Shipped CBM Value',
                                'name' => 'cbm_value',
                                'type' => 'number',
                                'placeholder' => 'Shipped CBM Value',
                                'required' => false
                            ],
                            [
                                'label' => 'Gross Wet',
                                'name' => 'gross_wet',
                                'type' => 'number',
                                'placeholder' => 'Gross Wet',
                                'required' => false
                            ],
                            [
                                'label' => 'Net Wet',
                                'name' => 'net_wet',
                                'type' => 'number',
                                'placeholder' => 'Net Wet',
                                'required' => false
                            ]
                        ]
                    ],
                    [
                        'title' => 'Shipment Status Info',
                        'fields' => [
                            [
                                'label' => 'ETA Date',
                                'name' => 'eta_date',
                                'type' => 'date',
                                'placeholder' => '',
                                'required' => false
                            ],
                            [
                                'label' => 'Vessel Name',
                                'name' => 'vessel_name',
                                'type' => 'text',
                                'placeholder' => 'Vessel Name',
                                'required' => false
                            ],
                            [
                                'label' => 'Shipboarding Date',
                                'name' => 'shipbording_date',
                                'type' => 'date',
                                'placeholder' => '',
                                'required' => false
                            ],
                            [
                                'label' => 'BL No',
                                'name' => 'bl_no',
                                'type' => 'text',
                                'placeholder' => 'BL No',
                                'required' => false
                            ],
                            [
                                'label' => 'BL Date',
                                'name' => 'bl_date',
                                'type' => 'date',
                                'placeholder' => '',
                                'required' => false
                            ]
                        ]
                    ],
                    [
                        'title' => 'Exception Value',
                        'fields' => [
                            [
                                'label' => 'Final Quantity',
                                'name' => 'final_qty',
                                'type' => 'number',
                                'placeholder' => 'Final Quantity',
                                'required' => false
                            ],
                            [
                                'label' => 'Final FOB',
                                'name' => 'final_fob',
                                'type' => 'number',
                                'placeholder' => 'Final FOB',
                                'required' => false
                            ],
                            [
                                'label' => 'Final CM',
                                'name' => 'final_cm',
                                'type' => 'number',
                                'placeholder' => 'Final CM',
                                'required' => false
                            ],
                            [
                                'label' => 'Remarks',
                                'name' => 'remarks',
                                'type' => 'textarea',
                                'placeholder' => 'Remarks',
                                'required' => false
                            ]
                        ]
                    ]
                ];
            @endphp

            <div class="row">
                @foreach ($formSections as $section)
                    <div class="col-6">
                        <hr>
                        <h3>&nbsp;&nbsp;{{ $section['title'] }}</h3>
                        <hr>
                        @foreach ($section['fields'] as $field)
                            <div class="form-group row">
                                <label for="{{ $field['name'] }}" class="col-sm-3 text-end control-label col-form-label">{{ $field['label'] }}:</label>
                                <div class="col-sm-9">
                                    @if (isset($field['wrapper']))
                                        <div id="{{ $field['wrapper'] }}">
                                    @endif
                                    @if ($field['type'] === 'textarea')
                                        <textarea
                                            name="{{ $field['name'] }}"
                                            class="form-control"
                                            id="{{ $field['name'] }}"
                                            placeholder="{{ $field['placeholder'] }}"
                                            {{ $field['required'] ? 'required' : '' }}
                                        >{{ old($field['name']) }}</textarea>
                                    @else
                                        <input
                                            type="{{ $field['type'] }}"
                                            name="{{ $field['name'] }}"
                                            class="form-control"
                                            id="{{ $field['name'] }}"
                                            placeholder="{{ $field['placeholder'] }}"
                                            value="{{ isset($field['value']) ? $field['value'] : old($field['name']) }}"
                                            {{ $field['required'] ? 'required' : '' }}
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
                    <input type="submit" value="Save" class="btn btn-primary">
                </div>
            </div>
        </form>


        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            // Debounce function to limit AJAX calls
            function debounce(func, delay) {
                let timer;
                return function () {
                    clearTimeout(timer);
                    timer = setTimeout(() => func.apply(this, arguments), delay);
                };
            }

            // Invoice No Input Event
            $('#invoice_no').on('input', debounce(function () {
                var invoice_no = $(this).val().trim();

                if (invoice_no.length > 0) {
                    $.ajax({
                        url: "{{ route('getInvoice') }}",
                        method: "POST",
                        data: {
                            invoice_no: invoice_no,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function (data) {
                            $('#invoices').html(data);
                        },
                        error: function () {
                            $('#invoices').html('<p class="text-danger">Error fetching invoice data.</p>');
                        }
                    });
                } else {
                    $('#invoices').empty();
                }
            }, 300)); // delay = 300ms

            // Click event for dynamic invoice cell selection
            $('#invoices').on('click', '.invoiceCell', function () {
                var invoiceValue = $(this).text().trim();

                $('#displayDiv').html(
                    '<input type="text" readonly name="invoice_no" class="form-control" id="invoice_no" value="' + invoiceValue + '" />'
                );
                $('#invoices').empty();
            });
        });
    </script>

@endsection
