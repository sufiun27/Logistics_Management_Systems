@extends('template.index')
@section('content')
<div class="card">
    <div class="card-header">
        <a href="{{route('DestCountry.DestCountry')}}" class="btn btn-success btn-sm">Back</a>
    </div>
    <div class="card-body">
        @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $err)
            <li>{{$err}}</li>
            @endforeach
        </div>
        @endif

        @if(session('success'))
        <div class="alert alert-success">{{session('success')}}</div>
        @endif
        <p>Update Destination Country</p>
        <form action="{{route('DestCountry.updateDestCountry',$destcountry->id)}}" method="post">
            @csrf
            <input type="text" name="country_code" placeholder="Country Code" value="{{$destcountry->country_code}}" class="form-control"><br>
            <input type="text" name="country_name" placeholder="Country Name" value="{{$destcountry->country_name}}" class="form-control"><br>
            <input type="text" name="port" placeholder="Port" class="form-control" value="{{$destcountry->port}}"><br>
            <input type="submit" value="Save" class="btn btn-primary btn-sm">
        </form>
    </div>
</div>
@endsection

