@extends('template.index')
@section('content')
    <div class="card">
        
        <div class="card-header">
            <label for="invoice_no">Invoice No: </label>
            <input id="invoice_no" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <div id="invoices"></div>
        </div>

        <div class="card-title">
            <a href="{{route('audit.indexAudit')}}" class="btn btn-success">Back</a>
            <x-message/>
        </div>
            <form class="form-horizontal" action="{{route('audit.storeAudit')}}" method="POST">
                @csrf
                
                <div class="row ">
                    <div class="col-6 ">
                        <hr>
                        <h3>&nbsp;&nbsp; Customs Audit Entry</h3>
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
                            <label for="import_reg_no" class="col-sm-3 text-end control-label col-form-label">Import Registration No:</label>
                            <div class="col-sm-9">
                                <input type="text" name="import_reg_no" class="form-control" id="import_reg_no" placeholder="Import Registration No" value="{{ old('import_reg_no') }}" />
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="import_bond" class="col-sm-3 text-end control-label col-form-label">Import Bond:</label>
                            <div class="col-sm-9">
                                <input type="text" name="import_bond" class="form-control" id="import_bond" placeholder="Import Bond" value="{{ old('import_bond') }}" />
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="total_fabric_used" class="col-sm-3 text-end control-label col-form-label">Total Fabric Used:</label>
                            <div class="col-sm-9">
                                <input type="text" name="total_fabric_used" class="form-control" id="total_fabric_used" placeholder="Total Fabric Used" value="{{ old('total_fabric_used') }}" />
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="adjusted_reg" class="col-sm-3 text-end control-label col-form-label">Adjusted Registration:</label>
                            <div class="col-sm-9">
                                <input type="text" name="adjusted_reg" class="form-control" id="adjusted_reg" placeholder="Adjusted Registration" value="{{ old('adjusted_reg') }}" />
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="adjusted_reg_page" class="col-sm-3 text-end control-label col-form-label">Adjusted Registration Page:</label>
                            <div class="col-sm-9">
                                <input type="text" name="adjusted_reg_page" class="form-control" id="adjusted_reg_page" placeholder="Adjusted Registration Page" value="{{ old('adjusted_reg_page') }}" />
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
                        url: "{{ route('shipping.getInvoice') }}",
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