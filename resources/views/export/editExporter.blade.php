@extends('template.index')

@section('content')
    <!-- resources/views/exporter/create.blade.php -->
<div class="card">
    <div class="card-header">
        @if($errors->any())
        <div class="alert alert-danger">
        @foreach($errors->all() as $err)
        <li>{{$err}}</li>
        @endforeach
        </div>
       @endif
        <x-message/>
    </div>
    <div class="card-body">
        <form action="{{ route('export.updateExporter',$exporters->id) }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="ExpoterNo" class="form-label">Exporter Number:</label>
                <input type="text" name="ExpoterNo" class="form-control" value="{{ $exporters->ExpoterNo }}" required>
            </div>
    
            <div class="mb-3">
                <label for="ExpoterName" class="form-label">Exporter Name:</label>
                <input type="text" name="ExpoterName" class="form-control" value="{{ $exporters->ExpoterName }}" required>
            </div>
    
            <div class="mb-3">
                <label for="ExpoterAddress" class="form-label">Exporter Address:</label>
                <input type="text" name="ExpoterAddress" class="form-control" value="{{ $exporters->ExpoterAddress }}" required>
            </div>
    
            <div class="mb-3">
                <label for="RegDetails" class="form-label">Registration Details:</label>
                <input type="text" name="RegDetails" class="form-control" value="{{ $exporters->RegDetails }}" required>
            </div>
    
            <div class="mb-3">
                <label for="EPBReg" class="form-label">EPB Registration:</label>
                <input type="text" name="EPBReg" class="form-control" value="{{ $exporters->EPBReg }}" required>
            </div>
    
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection
