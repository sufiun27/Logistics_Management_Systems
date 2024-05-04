@extends('template.index')

@section('content')

    <div class="card">
        <div class="card-header">
            
        </div>
        <div class="card-body">



            
            <div class="roe">
                <div class="col-6">
                    <form class="form-horizontal" action="{{route('shipping.storeShipmentOtherInfo')}}" method="POST">
                        @csrf
                        <h4 class="card-title">
                            <a href="{{route('shipping.shipping')}}" class="btn btn-dark">Back</a>
                            <a href="{{route('shipping.addShipping',compact('invoice_no'))}}" class="btn btn-success">Shipment Status Info </a>

                            @if(isset($invoice_no))
                            {{-- @php $invoice_no = $_GET['invoice_no']; @endphp --}}
                            <a href="{{route('shipping.addShipmentOtherInfo1',['id' => $invoice_no])}}" class="btn btn-info">Other Info</a>
                            <a href="{{route('shipping.addInvoiceRemarks1',['id' => $invoice_no])}}" class="btn btn-info">Invoice Remarks</a>
                            @endif
                        </h4>

                        <x-message/>

                        <div class="form-group row">
                          <label for="invoice_no" class="col-sm-3 text-end control-label col-form-label"> Invoice No:</label>
                        <div class="col-sm-9"> 
                            <div id="displayDiv">
                                <input type="text" readonly name="invoice_no" class="form-control" id="invoice_no" placeholder="Select Invoice" value="{{$invoice_no}}" /> 
                               
                            </div> 
                        </div> 
                        </div>
                
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

                        
                
                        <div class="border-top"> <div class="card-body"> 
                            <input type="submit" value="Save" class="btn btn-primary">
                        </div> </div>
                
                    </form>
                </div>
            </div>
            
            
              


        </div>
    </div>

@endsection

