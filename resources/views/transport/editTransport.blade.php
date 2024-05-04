@extends('template.index')
@section('content')

<div class="card">
    <div class="card-header">
        <a href="{{route('transport.transport')}}" class="btn btn-success btn-sm">Back</a>
    </div>
    <form class="form-horizontal" action="{{route('transport.updateTransport',$transport->id)}}" method="POST">
        @csrf
      <div class="card-body">
        <h4 class="card-title">Update Transport</h4>
        <x-message/>
        <div class="form-group row">
          <label for="name" class="col-sm-3 text-end control-label col-form-label"> Name</label>
        <div class="col-sm-9"> 
            <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="{{ $transport->name }}" /> 
        </div> 
        </div>

        <div class="form-group row">
          <label for="address" class="col-sm-3 text-end control-label col-form-label">Address</label>
        <div class="col-sm-9"> 
            <input type="text" name="address" class="form-control" id="address" placeholder= "Address" value="{{ $transport->address }}" />
        </div>
        </div>

        <div class="form-group row">
          <label for="port" class="col-sm-3 text-end control-label col-form-label">Port</label>
        <div class="col-sm-9"> 
            <input type="text" name="port" id="port" placeholder="Port" value="{{ $transport->port }}" class="form-control" />
        </div>
        </div>
  

        <div class="border-top"> <div class="card-body"> 
            <input type="submit" value="Save" class="btn btn-primary">
        </div> </div>

    </form>
</div>

@endsection

