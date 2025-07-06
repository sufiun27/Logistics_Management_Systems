@extends('template.index')

@section('content')
    <div class="container mt-5">
        <h1>Edit Notify</h1>
        <form action="{{ route('notify.update', $notify) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name', $notify->name) }}">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address (Optional)</label>
                <input type="text" name="address" id="address"
                    class="form-control @error('address') is-invalid @enderror"
                    value="{{ old('address', $notify->address) }}">
                @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('notify.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
