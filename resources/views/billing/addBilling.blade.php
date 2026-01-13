@extends('template.index')
@section('content')
    <div class="card">

        <div class="card-header">
            <label for="invoice_no">Invoice No: </label>
            <input id="invoice_no" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <div id="invoices"></div>
        </div>

        <div class="card-title">
            <a href="{{route('billing.indexBilling')}}" class="btn btn-success">Back</a>
            <x-message/>
        </div>
            <form class="form-horizontal" action="{{route('billing.storeBilling')}}"  method="POST"> {{----}}
                @csrf

                <div class="row ">
                    <div class="col-6 ">
                        <hr>
                        <h3>&nbsp;&nbsp; Billing Information Entry </h3>
                        <hr>
                        <div class="form-group row">
                            <label for="invoice_no" class="col-sm-3 text-end control-label col-form-label">Invoice No:</label>
                            <div class="col-sm-9">
                            <div id="displayDiv">
                                <input type="text" readonly name="invoice_no" class="form-control" id="invoice_no" placeholder="Invoice No" value="{{ old('invoice_no') }}" required />
                            </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="sb_no" class="col-sm-3 text-end control-label col-form-label">SB No:</label>
                            <div class="col-sm-9">
                                <input type="text" name="sb_no" class="form-control" id="sb_no" placeholder="SB No" value="{{ old('sb_no') }}" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="sb_date" class="col-sm-3 text-end control-label col-form-label">SB Date:</label>
                            <div class="col-sm-9">
                                <input type="date" name="sb_date" class="form-control" id="sb_date" placeholder="SB Date" value="{{ old('sb_date') }}" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="doc_submit_date" class="col-sm-3 text-end control-label col-form-label">Document Submit Date:</label>
                            <div class="col-sm-9">
                                <input type="date" name="doc_submit_date" class="form-control" id="doc_submit_date" placeholder="Document Submit Date" value="{{ old('doc_submit_date') }}" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="hk_courier_no" class="col-sm-3 text-end control-label col-form-label">HK Courier No:</label>
                            <div class="col-sm-9">
                                <input type="text" name="hk_courier_no" class="form-control" id="hk_courier_no" placeholder="HK Courier No" value="{{ old('hk_courier_no') }}" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="hk_courier_date" class="col-sm-3 text-end control-label col-form-label">HK Courier Date:</label>
                            <div class="col-sm-9">
                                <input type="date" name="hk_courier_date" class="form-control" id="hk_courier_date" placeholder="HK Courier Date" value="{{ old('hk_courier_date') }}" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="buyer_courier_no" class="col-sm-3 text-end control-label col-form-label">Buyer Courier No:</label>
                            <div class="col-sm-9">
                                <input type="text" name="buyer_courier_no" class="form-control" id="buyer_courier_no" placeholder="Buyer Courier No" value="{{ old('buyer_courier_no') }}" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="buyer_courier_date" class="col-sm-3 text-end control-label col-form-label">Buyer Courier Date:</label>
                            <div class="col-sm-9">
                                <input type="date" name="buyer_courier_date" class="form-control" id="buyer_courier_date" placeholder="Buyer Courier Date" value="{{ old('buyer_courier_date') }}" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="lead_time" class="col-sm-3 text-end control-label col-form-label">Lead Time:</label>
                            <div class="col-sm-9">
                                <input type="text" name="lead_time" class="form-control" id="lead_time" placeholder="Lead Time" value="{{ old('lead_time') }}" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="bank_submit_date" class="col-sm-3 text-end control-label col-form-label">Bank Submit Date:</label>
                            <div class="col-sm-9">
                                <input type="date" name="bank_submit_date" class="form-control" id="bank_submit_date" placeholder="Bank Submit Date" value="{{ old('bank_submit_date') }}" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="mode" class="col-sm-3 text-end control-label col-form-label">Mode:</label>
                            <div class="col-sm-9">
                                <select name="mode" id="mode" class="form-control">
                                    <option value="AIR PP">AIR PP</option>
                                    <option value="AIR CC">AIR CC</option>
                                    <option value="COURIER">COURIER</option>
                                    <option value="ROAD PP">ROAD PP</option>
                                    <option value="ROAD CC">ROAD CC</option>
                                    <option value="SEA PP">SEA PP</option>
                                    <option value="SEA CC">SEA CC</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="bd_thc" class="col-sm-3 text-end control-label col-form-label">BD THC:</label>
                            <div class="col-sm-9">
                                <input type="text" name="bd_thc" class="form-control" id="bd_thc" placeholder="BD THC" value="{{ old('bd_thc') }}" />
                            </div>
                        </div>




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
                        url: "{{ route('getInvoice') }}",
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
