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
            <form class="form-horizontal" action="{{route('sales.store')}}" method="POST">
                @csrf

                <div class="row ">
                    <div class="col-6 ">
                        <hr>
                        <h3>&nbsp;&nbsp; Item Info Entry</h3>
                        <hr>
                        <div class="form-group row">
                            <label for="invoice_no" class="col-sm-3 text-end control-label col-form-label">Invoice No:</label>
                            <div class="col-sm-9">
                            <div id="displayDiv">
                                <input type="text" name="invoice_no" class="form-control" id="invoice_no" placeholder="Invoice No" value="{{ old('invoice_no') }}" required />
                            </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="order_no" class="col-sm-3 text-end control-label col-form-label">Order No:</label>
                            <div class="col-sm-9">
                                <input type="text" name="order_no" class="form-control" id="order_no" placeholder="Order No" value="{{ old('order_no') }}" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="style_no" class="col-sm-3 text-end control-label col-form-label">Style No:</label>
                            <div class="col-sm-9">
                                <input type="text" name="style_no" class="form-control" id="style_no" placeholder="Style No" value="{{ old('style_no') }}" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="product_type" class="col-sm-3 text-end control-label col-form-label">Product Type:</label>
                            <div class="col-sm-9">
                                <input type="text" name="product_type" class="form-control" id="product_type" placeholder="Product Type" value="{{ old('product_type') }}" />
                            </div>
                        </div>
                    </div>{{-- End of col-6 --}}

                    <div class="col-6 ">
                        <hr>
                        <h3>&nbsp;&nbsp; Quantity & Value</h3>
                        <hr>

                        <div class="form-group row">
                            <label for="shipped_qty" class="col-sm-3 text-end control-label col-form-label">Shipped Quantity:</label>
                            <div class="col-sm-9">
                                <input type="number" name="shipped_qty" class="form-control" id="shipped_qty" placeholder="Shipped Quantity" value="{{ old('shipped_qty') }}" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="carton_qty" class="col-sm-3 text-end control-label col-form-label">Carton Quantity:</label>
                            <div class="col-sm-9">
                                <input type="number" name="carton_qty" class="form-control" id="carton_qty" placeholder="Shipped Carton Quantity" value="{{ old('carton_qty') }}" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="shipped_fob_value" class="col-sm-3 text-end control-label col-form-label">Shipped FOB Value:</label>
                            <div class="col-sm-9">
                                <input type="text" name="shipped_fob_value" class="form-control" id="shipped_fob_value" placeholder="Shipped FOB Value" value="{{ old('shipped_fob_value') }}" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="shipped_cm_value" class="col-sm-3 text-end control-label col-form-label">Shipped CM Value:</label>
                            <div class="col-sm-9">
                                <input type="text" name="shipped_cm_value" class="form-control" id="shipped_cm_value" placeholder="Shipped CM Value" value="{{ old('shipped_cm_value') }}" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cbm_value" class="col-sm-3 text-end control-label col-form-label">Shipped CBM Value:</label>
                            <div class="col-sm-9">
                                <input type="text" name="cbm_value" class="form-control" id="cbm_value" placeholder="Shipped CBM Value" value="{{ old('cbm_value') }}" />
                            </div>
                        </div>
                    </div>{{-- End of col-6 --}}

                    <div class="col-6 ">
                        <hr>
                        <h3>&nbsp;&nbsp; Shipment Status Info</h3>
                        <hr>

                    <div class="form-group row">
                        <label for="eta_date" class="col-sm-3 text-end control-label col-form-label">ETA Date:</label>
                        <div class="col-sm-9">
                            <input type="date" name="eta_date" class="form-control" id="eta_date" value="{{ old('eta_date') }}" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="vessel_name" class="col-sm-3 text-end control-label col-form-label">Vessel Name:</label>
                        <div class="col-sm-9">
                            <input type="text" name="vessel_name" class="form-control" id="vessel_name" placeholder="Vessel Name" value="{{ old('vessel_name') }}" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="shipbording_date" class="col-sm-3 text-end control-label col-form-label">Shipboarding Date:</label>
                        <div class="col-sm-9">
                            <input type="date" name="shipbording_date" class="form-control" id="shipbording_date" value="{{ old('shipbording_date') }}" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="bl_no" class="col-sm-3 text-end control-label col-form-label">BL No:</label>
                        <div class="col-sm-9">
                            <input type="text" name="bl_no" class="form-control" id="bl_no" placeholder="BL No" value="{{ old('bl_no') }}" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="bl_date" class="col-sm-3 text-end control-label col-form-label">BL Date:</label>
                        <div class="col-sm-9">
                            <input type="date" name="bl_date" class="form-control" id="bl_date" value="{{ old('bl_date') }}" />
                        </div>
                    </div>
                    </div>{{-- End of col-6 --}}

                    <div class="col-6 ">
                        <hr>
                        <h3>&nbsp;&nbsp; Exception Value</h3>
                        <hr>

                    <div class="form-group row">
                        <label for="final_qty" class="col-sm-3 text-end control-label col-form-label">Final Quantity:</label>
                        <div class="col-sm-9">
                            <input type="number" name="final_qty" class="form-control" id="final_qty" placeholder="Final Quantity" value="{{ old('final_qty') }}" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="final_fob" class="col-sm-3 text-end control-label col-form-label">Final FOB:</label>
                        <div class="col-sm-9">
                            <input type="text" name="final_fob" class="form-control" id="final_fob" placeholder="Final FOB" value="{{ old('final_fob') }}" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="final_cm" class="col-sm-3 text-end control-label col-form-label">Final CM:</label>
                        <div class="col-sm-9">
                            <input type="text" name="final_cm" class="form-control" id="final_cm" placeholder="Final CM" value="{{ old('final_cm') }}" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="remarks" class="col-sm-3 text-end control-label col-form-label">Remarks:</label>
                        <div class="col-sm-9">
                            <textarea name="remarks" class="form-control" id="remarks" placeholder="Remarks">{{ old('remarks') }}</textarea>
                        </div>
                    </div>
                    </div>{{-- End of col-6 --}}
                </div>{{-- End of row --}}


                <div class="border-top"> <div class="card-body">
                    <input type="submit" value="Save" class="btn btn-primary">
                </div> </div>

            </form>


        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#invoice_no').on('input', function() {
                var invoice_no = $(this).val();

                $.ajax({
                        url: "{{ route('sales.get_invoice') }}",
                        method: "POST",
                        data: {
                            invoice_no: invoice_no,
                            _token: "{{ csrf_token() }}" // Include CSRF token
                        },
                        success: function(data) {
                            $('#invoices').trigger("reset");
                            $('#invoices').html(data);

                        }
                    });

                });
                ///////////////////
        $(document).ready(function() {

            // Event delegation for dynamically added elements
            $('#invoices').on('click', '.invoiceCell', function() {
                // Get the text content of the clicked cell
                var invoiceValue = $(this).text();

                // Display the value in the displayDiv
                $('#displayDiv').html('<input type="text" readonly name="invoice_no" class="form-control" id="invoice_no"  value="'+ invoiceValue+'" />' );
                $('#invoices').html('');
                //document.getElementById('invoice_no').value = '';
            });

            ///end document ready
        });

        ///end document ready
        });
    </script>
@endsection
