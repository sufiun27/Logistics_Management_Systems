@extends('template.index')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary mb-0"><i class="bi bi-bell-fill me-2"></i>notify</h2>
        <a href="{{ route('notify.create') }}" class="btn btn-gradient-primary shadow-sm">
            <i class="bi bi-plus-circle me-2"></i>Create New Notify
        </a>
    </div>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="card shadow border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center" style="width: 50px;">#</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th class="text-center" style="width: 200px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($notifies as $notify)
                            <tr>
                                <td class="text-center text-secondary">{{ $notify->id }}</td>
                                <td class="fw-semibold">{{ $notify->name }}</td>
                                <td>{{ $notify->address ?? 'N/A' }}</td>
                                <td class="text-center">
                                    <a href="{{ route('notify.show', $notify) }}" class="btn btn-outline-info btn-sm me-1" title="View">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('notify.edit', $notify) }}" class="btn btn-outline-warning btn-sm me-1" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('notify.destroy', $notify) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete this notify?')" title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">
                                    <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                                    No notify found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.css">
<style>
.btn-gradient-primary {
    background: linear-gradient(90deg, #1e90ff 0%, #00c6ff 100%);
    color: #fff;
    border: none;
}
.btn-gradient-primary:hover {
    background: linear-gradient(90deg, #00c6ff 0%, #1e90ff 100%);
    color: #fff;
}
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endpush
@endsection
