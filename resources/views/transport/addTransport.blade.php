@extends('template.index')
@section('content')

<div class="card">
    <div class="card-header">
        <a href="{{route('transport.transport')}}" class="btn btn-success btn-sm">Back</a>
    </div>
    <form class="form-horizontal" action="{{route('transport.storeTransport')}}" method="POST">
        @csrf
      <div class="card-body">
        <h4 class="card-title">Add Transport</h4>
        <x-message/>
        <div class="form-group row">
          <label for="name" class="col-sm-3 text-end control-label col-form-label"> Name</label>
        <div class="col-sm-9"> 
            <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="{{ old('name') }}" /> 
        </div> 
        </div>

        <div class="form-group row">
          <label for="address" class="col-sm-3 text-end control-label col-form-label">Address</label>
        <div class="col-sm-9"> 
            <input type="text" name="address" class="form-control" id="address" placeholder= "Address" value="{{ old('address') }}" />
        </div>
        </div>

        <div class="form-group row">
          <label for="port" class="col-sm-3 text-end control-label col-form-label">Port</label>
        <div class="col-sm-9"> 
            <input type="text" name="port" id="port" placeholder="Port" value="{{ old('port') }}" class="form-control" />
        </div>
        </div>
  

        <div class="border-top"> <div class="card-body"> 
            <input type="submit" value="Save" class="btn btn-primary">
        </div> </div>

    </form>
</div>

@endsection

