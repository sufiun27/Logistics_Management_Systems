@extends('template.index')

@section('content')
<div class="container mt-5">
    <h1>Notify Details</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $notify->name }}</h5>
            <p class="card-text"><strong>Address:</strong> {{ $notify->address ?? 'N/A' }}</p>
            <p class="card-text"><strong>Created At:</strong> {{ $notify->created_at }}</p>
            <p class="card-text"><strong>Updated At:</strong> {{ $notify->updated_at }}</p>
            <a href="{{ route('notify.index') }}" class="btn btn-primary">Back to List</a>
            <a href="{{ route('notify.edit', $notify) }}" class="btn btn-warning">Edit</a>
        </div>
    </div>
</div>
@endsection
