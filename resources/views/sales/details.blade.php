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
            <form class="form-horizontal" action="{{route('sales.update',$s->id)}}" method="POST">
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
                                <input readonly type="text" name="invoice_no" class="form-control" id="invoice_no" placeholder="Invoice No" value="{{ $s->invoice_no }}" required />
                            </div>
                            </div>
                        </div>
                    
                        <div class="form-group row">
                            <label for="order_no" class="col-sm-3 text-end control-label col-form-label">Order No:</label>
                            <div class="col-sm-9">
                                <input type="text" name="order_no" class="form-control" id="order_no" placeholder="Order No" value="{{ $s->order_no }}" />
                            </div>
                        </div>
                    
                        <div class="form-group row">
                            <label for="style_no" class="col-sm-3 text-end control-label col-form-label">Style No:</label>
                            <div class="col-sm-9">
                                <input type="text" name="style_no" class="form-control" id="style_no" placeholder="Style No" value="{{ $s->style_no }}" />
                            </div>
                        </div>
        
                        <div class="form-group row">
                            <label for="product_type" class="col-sm-3 text-end control-label col-form-label">Product Type:</label>
                            <div class="col-sm-9">
                                <input type="text" name="product_type" class="form-control" id="product_type" placeholder="Product Type" value="{{ $s->product_type }}" />
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
                                <input type="number" name="shipped_qty" class="form-control" id="shipped_qty" placeholder="Shipped Quantity" value="{{ $s->shipped_qty }}" />
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="carton_qty" class="col-sm-3 text-end control-label col-form-label">Carton Quantity:</label>
                            <div class="col-sm-9">
                                <input type="number" name="carton_qty" class="form-control" id="carton_qty" placeholder="Shipped Carton Quantity" value="{{ $s->carton_qty }}" />
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="shipped_fob_value" class="col-sm-3 text-end control-label col-form-label">Shipped FOB Value:</label>
                            <div class="col-sm-9">
                                <input type="text" name="shipped_fob_value" class="form-control" id="shipped_fob_value" placeholder="Shipped FOB Value" value="{{ $s->shipped_fob_value }}" />
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="shipped_cm_value" class="col-sm-3 text-end control-label col-form-label">Shipped CM Value:</label>
                            <div class="col-sm-9">
                                <input type="text" name="shipped_cm_value" class="form-control" id="shipped_cm_value" placeholder="Shipped CM Value" value="{{ $s->shipped_cm_value }}" />
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="cbm_value" class="col-sm-3 text-end control-label col-form-label">Shipped CBM Value:</label>
                            <div class="col-sm-9">
                                <input type="text" name="cbm_value" class="form-control" id="cbm_value" placeholder="Shipped CBM Value" value="{{ $s->cbm_value }}" />
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
                            <input type="date" name="eta_date" class="form-control" id="eta_date" value="{{ $s->eta_date }}" />
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="vessel_name" class="col-sm-3 text-end control-label col-form-label">Vessel Name:</label>
                        <div class="col-sm-9">
                            <input type="text" name="vessel_name" class="form-control" id="vessel_name" placeholder="Vessel Name" value="{{ $s->vessel_name }}" />
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="shipbording_date" class="col-sm-3 text-end control-label col-form-label">Shipboarding Date:</label>
                        <div class="col-sm-9">
                            <input type="date" name="shipbording_date" class="form-control" id="shipbording_date" value="{{ $s->shipbording_date }}" />
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="bl_no" class="col-sm-3 text-end control-label col-form-label">BL No:</label>
                        <div class="col-sm-9">
                            <input type="text" name="bl_no" class="form-control" id="bl_no" placeholder="BL No" value="{{ $s->bl_no }}" />
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="bl_date" class="col-sm-3 text-end control-label col-form-label">BL Date:</label>
                        <div class="col-sm-9">
                            <input type="date" name="bl_date" class="form-control" id="bl_date" value="{{ $s->bl_date }}" />
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
                            <input type="number" name="final_qty" class="form-control" id="final_qty" placeholder="Final Quantity" value="{{ $s->final_qty }}" />
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="final_fob" class="col-sm-3 text-end control-label col-form-label">Final FOB:</label>
                        <div class="col-sm-9">
                            <input type="text" name="final_fob" class="form-control" id="final_fob" placeholder="Final FOB" value="{{ $s->final_fob }}" />
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="final_cm" class="col-sm-3 text-end control-label col-form-label">Final CM:</label>
                        <div class="col-sm-9">
                            <input type="text" name="final_cm" class="form-control" id="final_cm" placeholder="Final CM" value="{{ $s->final_cm }}" />
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="remarks" class="col-sm-3 text-end control-label col-form-label">Remarks:</label>
                        <div class="col-sm-9">
                            <textarea name="remarks" class="form-control" id="remarks" placeholder="Remarks">{{ $s->remarks }}</textarea>
                        </div>
                    </div>    
                    </div>{{-- End of col-6 --}}
                </div>{{-- End of row --}}


                <div class="border-top"> <div class="card-body"> 
                    <input type="submit" value="Update" class="btn btn-primary">
                </div> </div>
        
            </form>

            
        </div>
    </div>


   
@endsection