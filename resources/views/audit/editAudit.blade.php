@extends('template.index')
@section('content')
    <div class="card">

        <div class="card-title">
            <a href="{{route('audit.indexAudit')}}" class="btn btn-success">Back</a>
            <a href="{{route('audit.deleteAudit',$a->id)}}" class="btn btn-danger">Delete</a>
            <x-message/>
        </div>
           
        <form class="form-horizontal" action="{{route('audit.updateAudit',$a->id)}}"  method="POST"> 
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
                                <input readonly type="text" name="invoice_no" class="form-control" id="invoice_no" placeholder="Invoice No" value="{{ $a->invoice_no }}" required />
                            </div>
                            </div>
                        </div>
                    
                        <div class="form-group row">
                            <label for="import_reg_no" class="col-sm-3 text-end control-label col-form-label">Import Registration No:</label>
                            <div class="col-sm-9">
                                <input type="text" name="import_reg_no" class="form-control" id="import_reg_no" placeholder="Import Registration No" value="{{ $a->import_reg_no }}" />
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="import_bond" class="col-sm-3 text-end control-label col-form-label">Import Bond:</label>
                            <div class="col-sm-9">
                                <input type="text" name="import_bond" class="form-control" id="import_bond" placeholder="Import Bond" value="{{ $a->import_bond }}" />
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="total_fabric_used" class="col-sm-3 text-end control-label col-form-label">Total Fabric Used:</label>
                            <div class="col-sm-9">
                                <input type="text" name="total_fabric_used" class="form-control" id="total_fabric_used" placeholder="Total Fabric Used" value="{{ $a->total_fabric_used }}" />
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="adjusted_reg" class="col-sm-3 text-end control-label col-form-label">Adjusted Registration:</label>
                            <div class="col-sm-9">
                                <input type="text" name="adjusted_reg" class="form-control" id="adjusted_reg" placeholder="Adjusted Registration" value="{{ $a->adjusted_reg }}" />
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="adjusted_reg_page" class="col-sm-3 text-end control-label col-form-label">Adjusted Registration Page:</label>
                            <div class="col-sm-9">
                                <input type="text" name="adjusted_reg_page" class="form-control" id="adjusted_reg_page" placeholder="Adjusted Registration Page" value="{{ $a->adjusted_reg_page }}" />
                            </div>
                        </div>

                <div class="border-top"> <div class="card-body"> 
                    <input type="submit" value="Save" class="btn btn-primary">
                </div> </div>
        
            </form>

            
        </div>
    </div>

@endsection