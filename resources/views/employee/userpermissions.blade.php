@extends('template.index')

@section('content')
<div class="container mt-4">

    {{-- ✅ User Information --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">User Information</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Employee ID</th>
                    <td>{{ $user['emp_id'] }}</td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td>{{ $user['name'] }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $user['email'] }}</td>
                </tr>
                <tr>
                    <th>Designation</th>
                    <td>{{ $user['designation'] }}</td>
                </tr>
                <tr>
                    <th>Department</th>
                    <td>{{ $user['department'] }}</td>
                </tr>
                <tr>
                    <th>Site</th>
                    <td>{{ $user['site'] }}</td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td>{{ $user['phone'] }}</td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td>{{ $user['address'] }}</td>
                </tr>
                <tr>
                    <th>Remarks</th>
                    <td>{{ $user['remarks'] }}</td>
                </tr>
            </table>
        </div>
    </div>

    {{-- ✅ Permissions Table --}}
    <div class="card shadow-sm">
        <div class="card-header bg-secondary text-white">
            <h4 class="mb-0">User Permissions</h4>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Module</th>
                        <th>Permission Name</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Assigned At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($permissions as $index => $permission)
                        @php
                            $userPermission = collect($user_permissions)
                                ->firstWhere('permission_id', $permission['id']);
                        @endphp
                        <tr>
                            <td class="fw-bold">{{ $index + 1 }}</td>
                            <td>{{ $permission['module'] }}</td>
                            <td>{{ $permission['name'] }}</td>
                            <td>{{ $permission['description'] }}</td>
                            <td class="text-center">
                                @if($userPermission && $userPermission['status'] == 1)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                @if($userPermission)
                                    {{ \Carbon\Carbon::parse($userPermission['created_at'])->format('Y-m-d H:i') }}
                                @else
                                    <span class="text-muted">Not Assigned</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
