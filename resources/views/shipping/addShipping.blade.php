@extends('template.index')

@section('content')

    <div class="card">
        <div class="card-header">
            <label for="invoice_no">Invoice No: </label>
            <input id="invoice_no" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <div id="invoices"></div>
        </div>
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{route('shipping.shipping')}}" class="btn btn-dark">Back</a>
            </h4>
            <x-message/>


            <form class="form-horizontal" action="{{route('shipping.storeShipmentStatusInfo')}}" method="POST">
                @csrf
                        

            <div class="row">
                
                <div class="col-6 ">
                    <hr>
                    <h5>Shipment Status Information</h5>
                    <hr>
                        
                        <div class="form-group row">
                          <label for="invoice_no" class="col-sm-3 text-end control-label col-form-label"> Invoice No:</label>
                        <div class="col-sm-9"> 
                            <div id="displayDiv">
                                <input type="text" readonly name="invoice_no" class="form-control" id="invoice_no" placeholder="Select Invoice" @if(isset($_GET['invoice_no'])) value="{{ old('invoice_no') }}" @else value="{{ old('invoice_no') }}" @endif/> 
                               
                            </div> 
                        </div> 
                        </div>
                
                        <div class="form-group row">
                          <label for="ep_no" class="col-sm-3 text-end control-label col-form-label">Ep No:</label>
                        <div class="col-sm-9"> 
                            <input type="text" name="ep_no" class="form-control" id="ep_no" placeholder= "Ep No:" value="{{ old('ep_no') }}" />
                        </div>
                        </div>

                        <div class="form-group row">
                            <label for="ep_date" class="col-sm-3 text-end control-label col-form-label">Ep Date:</label>
                          <div class="col-sm-9"> 
                              <input type="date" name="ep_date" class="form-control" id="ep_date" placeholder= "Ep Date:" value="{{ old('ep_date') }}" />
                          </div>
                          </div>
                
                          <div class="form-group row">
                            <label for="exp_no" class="col-sm-3 text-end control-label col-form-label">Exp No:</label>
                          <div class="col-sm-9"> 
                              <input type="text" name="exp_no" class="form-control" id="exp_no" placeholder= "Exp No:" value="{{ old('exp_no') }}" />
                          </div>
                          </div>

                          <div class="form-group row">
                            <label for="exp_date" class="col-sm-3 text-end control-label col-form-label">Exp Date:</label>
                          <div class="col-sm-9"> 
                              <input type="date" name="exp_date" class="form-control" id="exp_date" placeholder= "Exp Date:" value="{{ old('exp_date') }}" />
                          </div>
                          </div>

                          <div class="form-group row">
                            <label for="ex_factory_date" class="col-sm-3 text-end control-label col-form-label">Ex-Factory Date:</label>
                          <div class="col-sm-9"> 
                              <input type="date" name="ex_factory_date" class="form-control" id="ex_factory_date" placeholder= "Ex-Factory Date:" value="{{ old('ex_factory_date') }}" />
                          </div>
                          </div>

                          <div class="form-group row">
                            <label for="sb_no" class="col-sm-3 text-end control-label col-form-label">SB No:</label>
                          <div class="col-sm-9"> 
                              <input type="text" name="sb_no" class="form-control" id="sb_no" placeholder= "SB No:" value="{{ old('sb_no') }}" />
                          </div>
                          </div>
                          
                          <div class="form-group row">
                            <label for="sb_date" class="col-sm-3 text-end control-label col-form-label">SB Date:</label>
                          <div class="col-sm-9"> 
                              <input type="date" name="sb_date" class="form-control" id="sb_date" placeholder= "SB Date:" value="{{ old('sb_date') }}" />
                          </div>
                          </div>
                
                        
                </div>{{---- end col-6 ----}}

                <div class="col-6 ">
                    <hr>
                    <h5>Other Information</h5>
                    <hr>
                    <div class="form-group row">
                        <label for="transport_port" class="col-sm-3 text-end control-label col-form-label">Local Transport:</label>
                      <div class="col-sm-9"> 
                          <select name="transport_port" id="" class="form-control">
                              @foreach ($transports as $transports)
                                  <option value="{{$transports->port}}">{{$transports->port}}</option>
                              @endforeach
                          </select>
                      </div>
                      </div>

                      <div class="form-group row">
                          <label for="cnf_agent" class="col-sm-3 text-end control-label col-form-label"> cnf_agent:</label>
                        <div class="col-sm-9"> 
                            <div id="displayDiv">
                                <input type="text"  name="cnf_agent" class="form-control" id="cnf_agent" placeholder="cnf_agent" value="{{old('cnf_agent')}}" /> 
                            </div> 
                        </div> 
                        </div>

                        <div class="form-group row">
                          <label for="vessel_no" class="col-sm-3 text-end control-label col-form-label"> vessel_no:</label>
                        <div class="col-sm-9"> 
                            <div id="displayDiv">
                                <input type="text"  name="vessel_no" class="form-control" id="vessel_no" placeholder="vessel_no" value="{{old('vessel_no')}}" /> 
                            </div> 
                        </div> 
                        </div>

                        

                        <div class="form-group row">
                          <label for="cargorpt_date" class="col-sm-3 text-end control-label col-form-label"> cargorpt_date:</label>
                        <div class="col-sm-9"> 
                            <div id="displayDiv">
                                <input type="date"  name="cargorpt_date" class="form-control" id="cargorpt_date" placeholder="cargorpt_date" value="{{old('cargorpt_date')}}" /> 
                            </div> 
                        </div> 
                        </div>

                        <hr>
                        <h5>Remarks</h5>
                        <hr>
                    <div class="form-group row">
                        <label for="bring_back" class="col-sm-3 text-end control-label col-form-label"> Bring Back:</label>
                      <div class="col-sm-9"> 
                          <div id="displayDiv">
                              <input type="text"  name="bring_back" class="form-control" id="bring_back" placeholder="bring_back" value="{{old('bring_back')}}" /> 
                          </div> 
                      </div> 
                      </div>

                      <div class="form-group row">
                        <label for="shipped_out" class="col-sm-3 text-end control-label col-form-label"> Shipped Out:</label>
                      <div class="col-sm-9"> 
                          <div id="displayDiv">
                              <input type="text"  name="shipped_out" class="form-control" id="shipped_out" placeholder="shipped_out" value="{{old('shipped_out')}}" /> 
                          </div> 
                      </div> 
                      </div>

                      <div class="form-group row">
                        <label for="shipped_cancel" class="col-sm-3 text-end control-label col-form-label"> Shipped Cancel:</label>
                      <div class="col-sm-9"> 
                          <div id="displayDiv">
                              <input type="text"  name="shipped_cancel" class="form-control" id="shipped_cancel" placeholder="shipped_cancel" value="{{old('shipped_cancel')}}" /> 
                          </div> 
                      </div> 
                      </div>

                      <div class="form-group row">
                        <label for="shipped_back" class="col-sm-3 text-end control-label col-form-label"> Shipped Back:</label>
                      <div class="col-sm-9"> 
                          <div id="displayDiv">
                              <input type="text"  name="shipped_back" class="form-control" id="shipped_back" placeholder="shipped_back" value="{{old('shipped_back')}}" /> 
                          </div> 
                      </div> 
                      </div>

                      <div class="form-group row">
                        <label for="unshipped" class="col-sm-3 text-end control-label col-form-label"> Un-Shipped:</label>
                      <div class="col-sm-9"> 
                          <div id="displayDiv">
                              <input type="text"  name="unshipped" class="form-control" id="unshipped" placeholder="unshipped" value="{{old('unshipped')}}" /> 
                          </div> 
                      </div> 
                      </div>

                </div>{{---- end col-6 ----}}


                
            </div> {{---- end row ----}}
            
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

