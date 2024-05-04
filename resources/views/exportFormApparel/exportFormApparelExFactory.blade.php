@extends('template.index')
@section('content')
<div class="card">
    
    <div class="card-header">
        <a href="{{route('exportFormApparel.exportFormApparel')}}" class="btn btn-secondary btn-sm">Back</a>

    </div>
    <div class="card-title"><h4>Ex-Factory Information</h4></div>
    <div class="card-body">
        <x-message/>
        <div class="row">
        <form action="{{route('exportFormApparel.exportFormApparelExFactoryUpdate',$efa->id)}}" method="GET">
            @csrf
            <div class="col-6">{{---- col2 start--}}
                <div class="form-group row">
                    <label for="exp_no" class="col-sm-3 text-end control-label col-form-label">Exp No: </label>
                    <div class="col-sm-9"> 
                        <input name="exp_no" id="exp_no" type="number" class="form-control" value="{{ $efa->exp_no }}" placeholder="Exp No"/>
                    </div> 
                   </div>
            
                   <div class="form-group row">
                    <label for="exp_date" class="col-sm-3 text-end control-label col-form-label">Exp Date: </label>
                    <div class="col-sm-9"> 
                        <input name="exp_date" id="exp_date" type="date" class="form-control" value="{{ $efa->exp_date }}" placeholder="Exp Date"/>
                    </div> 
                   </div>
            
                   <div class="form-group row">
                    <label for="exp_permit_no" class="col-sm-3 text-end control-label col-form-label">Exp Permit No: </label>
                    <div class="col-sm-9"> 
                        <input name="exp_permit_no" id="exp_permit_no" type="text" class="form-control" value="{{ $efa->exp_permit_no }}" placeholder="Exp Permit No"/>
                    </div> 
                   </div>
            
                   <div class="form-group row">
                    <label for="bl_no" class="col-sm-3 text-end control-label col-form-label">B/L No: </label>
                    <div class="col-sm-9"> 
                        <input name="bl_no" id="bl_no" type="text" class="form-control" value="{{ $efa->bl_no }}" placeholder="B/L No"/>
                    </div> 
                   </div>
            
                   <div class="form-group row">
                    <label for="bl_date" class="col-sm-3 text-end control-label col-form-label">B/L Date: </label>
                    <div class="col-sm-9"> 
                        <input name="bl_date" id="bl_date" type="date" class="form-control" value="{{ $efa->bl_date }}" placeholder="B/L Date"/>
                    </div> 
                   </div>
            
                   <div class="form-group row">
                    <label for="ex_factory_date" class="col-sm-3 text-end control-label col-form-label">EX-Factory Date: </label>
                    <div class="col-sm-9"> 
                        <input name="ex_factory_date" id=ex_factory_date" type="date" class="form-control" value="{{ $efa->ex_factory_date }}" placeholder="EX-Factory Date"/>
                    </div> 
                   </div>
            
            
            </div>{{---- col2 end--}}
            
            
            <button type="submit" class="btn btn-primary">Submit</button>
            </form>
    </div>
</div>

</div>
@endsection