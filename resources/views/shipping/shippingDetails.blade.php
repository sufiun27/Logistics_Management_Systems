@extends('template.index')
@section('content')

@php $s=$shipping; @endphp
<div class="card">
    <div class="card-header">
        
    </div>
    <div class="card-body">
        <h4 class="card-title">
            <a href="{{route('shipping.shipping')}}" class="btn btn-dark">Back</a>
            <a href="{{route('shipping.updateShipping',$s->id)}}" class="btn btn-info">Update</a>
            <a href="" class="btn btn-danger">Delete</a>
        </h4>
        <x-message/>


        <div class="row">
            
            <div class="col-6 ">
                <hr>
                <h5>Shipment Status Information</h5>
                <hr>
                    
                    <div class="form-group row">
                      <label for="invoice_no" class="col-sm-3 text-end control-label col-form-label"> Invoice No:</label>
                    <div class="col-sm-9"> 
                        <div id="displayDiv">
                            <input type="text" readonly name="invoice_no" class="form-control" id="invoice_no"   value="{{ $s->invoice_no }}" /> 
                           
                        </div> 
                    </div> 
                    </div>
            
                    <div class="form-group row">
                      <label for="ep_no" class="col-sm-3 text-end control-label col-form-label">Ep No:</label>
                    <div class="col-sm-9"> 
                        <input type="text"  name="ep_no" class="form-control" id="ep_no"  value="{{ $s->ep_no }}" />
                    </div>
                    </div>

                    <div class="form-group row">
                        <label for="ep_date" class="col-sm-3 text-end control-label col-form-label">Ep Date:</label>
                      <div class="col-sm-9"> 
                          <input type="date" name="ep_date" class="form-control" id="ep_date"  value="{{ $s->ep_date }}" />
                      </div>
                      </div>
            
                      <div class="form-group row">
                        <label for="exp_no" class="col-sm-3 text-end control-label col-form-label">Exp No:</label>
                      <div class="col-sm-9"> 
                          <input type="text" name="exp_no" class="form-control" id="exp_no"  value="{{ $s->exp_no }}" />
                      </div>
                      </div>

                      <div class="form-group row">
                        <label for="exp_date" class="col-sm-3 text-end control-label col-form-label">Exp Date:</label>
                      <div class="col-sm-9"> 
                          <input type="date" name="exp_date" class="form-control" id="exp_date"  value="{{ $s->exp_date }}" />
                      </div>
                      </div>

                      <div class="form-group row">
                        <label for="ex_factory_date" class="col-sm-3 text-end control-label col-form-label">Ex-Factory Date:</label>
                      <div class="col-sm-9"> 
                          <input type="date" name="ex_factory_date" class="form-control" id="ex_factory_date"  value="{{ $s->ex_factory_date }}" />
                      </div>
                      </div>

                      <div class="form-group row">
                        <label for="sb_no" class="col-sm-3 text-end control-label col-form-label">SB No:</label>
                      <div class="col-sm-9"> 
                          <input type="text" name="sb_no" class="form-control" id="sb_no"  value="{{ $s->sb_no }}" />
                      </div>
                      </div>
                      
                      <div class="form-group row">
                        <label for="sb_date" class="col-sm-3 text-end control-label col-form-label">SB Date:</label>
                      <div class="col-sm-9"> 
                          <input type="date" name="sb_date" class="form-control" id="sb_date"  value="{{ $s->sb_date }}" />
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
                          
                              <option >{{$s->transport_port}}</option>
                          
                      </select>
                  </div>
                  </div>

                  <div class="form-group row">
                      <label for="cnf_agent" class="col-sm-3 text-end control-label col-form-label"> cnf_agent:</label>
                    <div class="col-sm-9"> 
                        <div id="displayDiv">
                            <input type="text"  name="cnf_agent" class="form-control" id="cnf_agent"  value="{{$s->cnf_agent}}" /> 
                        </div> 
                    </div> 
                    </div>

                    <div class="form-group row">
                      <label for="vessel_no" class="col-sm-3 text-end control-label col-form-label"> vessel_no:</label>
                    <div class="col-sm-9"> 
                        <div id="displayDiv">
                            <input type="text"  name="vessel_no" class="form-control" id="vessel_no"  value="{{$s->vessel_no}}" /> 
                        </div> 
                    </div> 
                    </div>

                    

                    <div class="form-group row">
                      <label for="cargorpt_date" class="col-sm-3 text-end control-label col-form-label"> cargorpt_date:</label>
                    <div class="col-sm-9"> 
                        <div id="displayDiv">
                            <input type="date"  name="cargorpt_date" class="form-control" id="cargorpt_date"  value="{{$s->cargorpt_date}}" /> 
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
                          <input type="text"  name="bring_back" class="form-control" id="bring_back"  value="{{$s->bring_back}}" /> 
                      </div> 
                  </div> 
                  </div>

                  <div class="form-group row">
                    <label for="shipped_out" class="col-sm-3 text-end control-label col-form-label"> Shipped Out:</label>
                  <div class="col-sm-9"> 
                      <div id="displayDiv">
                          <input type="text"  name="shipped_out" class="form-control" id="shipped_out"  value="{{$s->shipped_out}}" /> 
                      </div> 
                  </div> 
                  </div>

                  <div class="form-group row">
                    <label for="shipped_cancel" class="col-sm-3 text-end control-label col-form-label"> Shipped Cancel:</label>
                  <div class="col-sm-9"> 
                      <div id="displayDiv">
                          <input type="text"  name="shipped_cancel" class="form-control" id="shipped_cancel"  value="{{$s->shipped_cancel}}" /> 
                      </div> 
                  </div> 
                  </div>

                  <div class="form-group row">
                    <label for="shipped_back" class="col-sm-3 text-end control-label col-form-label"> Shipped Back:</label>
                  <div class="col-sm-9"> 
                      <div id="displayDiv">
                          <input type="text"  name="shipped_back" class="form-control" id="shipped_back"  value="{{$s->shipped_back}}" /> 
                      </div> 
                  </div> 
                  </div>

                  <div class="form-group row">
                    <label for="unshipped" class="col-sm-3 text-end control-label col-form-label"> Un-Shipped:</label>
                  <div class="col-sm-9"> 
                      <div id="displayDiv">
                          <input type="text"  name="unshipped" class="form-control" id="unshipped"  value="{{$s->unshipped}}" /> 
                      </div> 
                  </div> 
                  </div>

            </div>{{---- end col-6 ----}}


            
        </div> {{---- end row ----}}



          


    </div>
</div>
@endsection