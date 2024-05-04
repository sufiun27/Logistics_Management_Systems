@extends('template.index')
@section('content')
    <div class="card">
        
        

        <div class="card-title">
            <a href="{{route('billing.indexBilling')}}" class="btn btn-success">Back</a>
            <a href="{{route('billing.deleteBilling',$b->id)}}" class="btn btn-danger">Delete</a>
            <x-message/>
        </div>
            <form class="form-horizontal" action="{{route('billing.updateBilling',$b->id)}}"  method="POST"> {{----}}
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
                                <input readonly type="text" name="invoice_no" class="form-control" id="invoice_no" placeholder="Invoice No" value="{{ $b->invoice_no }}" required />
                            </div>
                            </div>
                        </div>
                    
                        <div class="form-group row">
                            <label for="sb_no" class="col-sm-3 text-end control-label col-form-label">SB No:</label>
                            <div class="col-sm-9">
                                <input type="text" name="sb_no" class="form-control" id="sb_no" placeholder="SB No" value="{{ $b->sb_no }}" />
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="sb_date" class="col-sm-3 text-end control-label col-form-label">SB Date:</label>
                            <div class="col-sm-9">
                                <input type="date" name="sb_date" class="form-control" id="sb_date" placeholder="SB Date" value="{{ $b->sb_date }}" />
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="doc_submit_date" class="col-sm-3 text-end control-label col-form-label">Document Submit Date:</label>
                            <div class="col-sm-9">
                                <input type="date" name="doc_submit_date" class="form-control" id="doc_submit_date" placeholder="Document Submit Date" value="{{ $b->doc_submit_date }}" />
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="hk_courier_no" class="col-sm-3 text-end control-label col-form-label">HK Courier No:</label>
                            <div class="col-sm-9">
                                <input type="text" name="hk_courier_no" class="form-control" id="hk_courier_no" placeholder="HK Courier No" value="{{ $b->hk_courier_no }}" />
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="hk_courier_date" class="col-sm-3 text-end control-label col-form-label">HK Courier Date:</label>
                            <div class="col-sm-9">
                                <input type="date" name="hk_courier_date" class="form-control" id="hk_courier_date" placeholder="HK Courier Date" value="{{ $b->hk_courier_date }}" />
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="buyer_courier_no" class="col-sm-3 text-end control-label col-form-label">Buyer Courier No:</label>
                            <div class="col-sm-9">
                                <input type="text" name="buyer_courier_no" class="form-control" id="buyer_courier_no" placeholder="Buyer Courier No" value="{{ $b->buyer_courier_no }}" />
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="buyer_courier_date" class="col-sm-3 text-end control-label col-form-label">Buyer Courier Date:</label>
                            <div class="col-sm-9">
                                <input type="date" name="buyer_courier_date" class="form-control" id="buyer_courier_date" placeholder="Buyer Courier Date" value="{{ $b->buyer_courier_date }}" />
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="lead_time" class="col-sm-3 text-end control-label col-form-label">Lead Time:</label>
                            <div class="col-sm-9">
                                <input type="text" name="lead_time" class="form-control" id="lead_time" placeholder="Lead Time" value="{{ $b->lead_time }}" />
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="bank_submit_date" class="col-sm-3 text-end control-label col-form-label">Bank Submit Date:</label>
                            <div class="col-sm-9">
                                <input type="date" name="bank_submit_date" class="form-control" id="bank_submit_date" placeholder="Bank Submit Date" value="{{ $b->bank_submit_date }}" />
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="mode" class="col-sm-3 text-end control-label col-form-label">Mode:</label>
                            <div class="col-sm-9">
                                <select name="mode" id="mode" class="form-control">
                                    <option value="AIR PP" @if($b->mode == 'AIR PP') selected class="bg-success" @endif >AIR PP</option>
                                    <option value="AIR CC" @if($b->mode == 'AIR CC') selected class="bg-success" @endif>AIR CC</option>
                                    <option value="COURIER" @if($b->mode == 'COURIER') selected class="bg-success" @endif>COURIER</option>
                                    <option value="ROAD PP" @if($b->mode == 'ROAD PP') selected class="bg-success" @endif>ROAD PP</option>
                                    <option value="ROAD CC" @if($b->mode == 'ROAD CC') selected class="bg-success" @endif>ROAD CC</option>
                                    <option value="SEA PP" @if($b->mode == 'SEA PP') selected class="bg-success" @endif>SEA PP</option>
                                    <option value="SEA CC" @if($b->mode == 'SEA CC') selected class="bg-success" @endif>SEA CC</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="bd_thc" class="col-sm-3 text-end control-label col-form-label">BD THC:</label>
                            <div class="col-sm-9">
                                <input type="text" name="bd_thc" class="form-control" id="bd_thc" placeholder="BD THC" value="{{ $b->bd_thc }}" />
                            </div>
                        </div>
                        
                        
                        

                <div class="border-top"> <div class="card-body"> 
                    <input type="submit" value="Update" class="btn btn-primary">
                </div> </div>
        
            </form>

            
        </div>
    </div>


@endsection