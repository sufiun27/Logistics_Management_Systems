@extends('template.index')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Update Profile</h4>
        </div>
        <div class="card-body">
            {{-- ✅ Display Success/Error Messages --}}
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('user.detailsUpdate', $user->id) }}" method="GET">
                @csrf
                

                <div class="row g-3">
                    {{-- Name --}}
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Full Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                    </div>

                    {{-- Employee ID (readonly) --}}
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Employee ID</label>
                        <input type="text" class="form-control" value="{{ $user->emp_id }}" readonly>
                    </div>

                    {{-- Email (can't update) --}}
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Email (cannot be changed)</label>
                        <input type="email" class="form-control" value="{{ $user->email }}" disabled>
                    </div>

                    {{-- Designation --}}
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Designation</label>
                        <input type="text" name="designation" class="form-control" value="{{ old('designation', $user->designation) }}">
                    </div>

                    {{-- Department --}}
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Department</label>
                        <input readonly type="text" name="department" class="form-control" value="{{ old('department', $user->department) }}">
                    </div>

                    {{-- Site --}}
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Site</label>
                        <input readonly type="text" name="site" class="form-control" value="{{ old('site', $user->site) }}">
                    </div>

                    {{-- Phone --}}
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Phone</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}">
                    </div>

                    {{-- Address --}}
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Address</label>
                        <input type="text" name="address" class="form-control" value="{{ old('address', $user->address) }}">
                    </div>

                    {{-- Remarks --}}
                    <div class="col-md-12">
                        <label class="form-label fw-bold">Remarks</label>
                        <textarea name="remarks" class="form-control" rows="2">{{ old('remarks', $user->remarks) }}</textarea>
                    </div>

                    <hr>

                    <h3>Password Section</h3>

                    <hr>

                    {{-- Password (Optional) --}}
                   
                    <div class="col-md-6">
                      <label class="form-label fw-bold">Old Password </label>
                      <input type="old_password" name="old_password" class="form-control" placeholder="Leave blank to keep current password">
                  </div>


                    <div class="col-md-6">
                        <label class="form-label fw-bold">New Password </label>
                        <input type="password" name="password" class="form-control" placeholder="Leave blank to keep current password">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm new password">
                    </div>
                </div>

                <div class="mt-4 text-end">
                    <button type="submit" class="btn btn-success px-4">Update Profile</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
