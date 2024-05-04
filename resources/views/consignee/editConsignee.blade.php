@extends('template.index')
@section('content')

<div class="card">
    <div class="card-header">
        <a href="{{route('consignee.consignee')}}" class="btn btn-success btn-sm">Back</a>
    </div>
    <form class="form-horizontal" action="{{route('consignee.updateConsignee', $consignee->id)}}" method="POST">
        @csrf
      <div class="card-body">
        <h4 class="card-title">Consignee Update</h4>
        <x-message/>
        <div class="form-group row">
          <label for="consignee_name" class="col-sm-3 text-end control-label col-form-label">Consignee Name</label>
        <div class="col-sm-9"> 
            <input type="text" name="consignee_name" class="form-control" id="consignee_name" placeholder="Consignee Name" value="{{ $consignee->consignee_name }}" /> 
        </div> 
        </div>

        <div class="form-group row">
          <label for="consignee_site" class="col-sm-3 text-end control-label col-form-label">Consignee Site</label>
        <div class="col-sm-9"> 
            <input type="text" name="consignee_site" class="form-control" id="consignee_site" placeholder="Consignee site" value="{{ $consignee->consignee_site }}" />
        </div>
        </div>
        

        <div class="form-group row">
          <label for="consignee_address" class="col-sm-3 text-end control-label col-form-label">Consignee Address</label>
        <div class="col-sm-9"> 
            <input type="text" name="consignee_address" class="form-control" id="consignee_address" placeholder="Consignee Address" value="{{ $consignee->consignee_address }}" />
        </div>
        </div>

        <div class="form-group row">
          <label for="consignee_country" class="col-sm-3 text-end control-label col-form-label">Consignee Country</label>
        <div class="col-sm-9"> 
            <input type="text" name="consignee_country" class="form-control" id="consignee_country" placeholder="Consignee Country" value="{{ $consignee->consignee_country }}" />
        </div>
        </div>
  

        <div class="border-top"> <div class="card-body"> 
            <input type="submit" value="Save" class="btn btn-primary">
        </div> </div>

    </form>
</div>

@endsection

