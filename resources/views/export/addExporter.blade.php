@extends('template.index')

@section('content')
    <!-- resources/views/exporter/create.blade.php -->
<div class="card">
    <div class="card-body">
        <form action="{{ route('export.storeExporter') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="ExpoterNo" class="form-label">Exporter Number:</label>
                <input type="text" name="ExpoterNo" class="form-control" value="{{ old('ExpoterNo') }}" required>
            </div>
    
            <div class="mb-3">
                <label for="ExpoterName" class="form-label">Exporter Name:</label>
                <input type="text" name="ExpoterName" class="form-control" value="{{ old('ExpoterName') }}" required>
            </div>
    
            <div class="mb-3">
                <label for="ExpoterAddress" class="form-label">Exporter Address:</label>
                <input type="text" name="ExpoterAddress" class="form-control" value="{{ old('ExpoterAddress') }}" required>
            </div>
    
            <div class="mb-3">
                <label for="RegDetails" class="form-label">Registration Details:</label>
                <input type="text" name="RegDetails" class="form-control" value="{{ old('RegDetails') }}" required>
            </div>
    
            <div class="mb-3">
                <label for="EPBReg" class="form-label">EPB Registration:</label>
                <input type="text" name="EPBReg" class="form-control" value="{{ old('EPBReg') }}" required>
            </div>
    
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection
