@extends('template.index')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Update Profile</h4>
        </div>

        <div class="card-body">
            {{-- ✅ Success / Error Messages --}}
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

            <form action="{{ route('user.detailsUpdateStore', $user->id) }}" method="POST">
                @csrf
                 {{-- Recommended for updates, but POST works with a route definition --}}

                <div class="row g-3">
                    {{-- Full Name --}}
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Full Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name', $user->name) }}" required>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    {{-- Employee ID --}}
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Employee ID</label>
                        <input type="text" name="emp_id" class="form-control @error('emp_id') is-invalid @enderror"
                            value="{{ old('emp_id', $user->emp_id) }}" required>
                        @error('emp_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    {{-- Email --}}
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email', $user->email) }}" required>
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    {{-- Designation --}}
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Designation</label>
                        <input type="text" name="designation" class="form-control @error('designation') is-invalid @enderror"
                            value="{{ old('designation', $user->designation) }}" required>
                        @error('designation')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    {{-- Department --}}
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Department</label>
                        <input type="text" name="department" class="form-control @error('department') is-invalid @enderror"
                            value="{{ old('department', $user->department) }}" required>
                        @error('department')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    {{-- Site --}}
                    @php
                        use App\Models\Export; // Assume Export is the correct model for sites
                        $sites = Export::pluck('ExpoterName');
                    @endphp
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Site</label>
                        <select name="site" class="form-select @error('site') is-invalid @enderror">
                            <option value="">-- Select Site --</option>
                            @foreach($sites as $site)
                                <option value="{{ $site }}" {{ old('site', $user->site) == $site ? 'selected' : '' }}>
                                    {{ $site }}
                                </option>
                            @endforeach
                        </select>
                        @error('site')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    {{-- Factory --}}
                    @php
                        use App\Models\Factory;
                        $factories = Factory::pluck('factory_name');
                    @endphp
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Factory</label>
                        <select name="factory" class="form-select @error('factory') is-invalid @enderror">
                            <option value="">-- Select Factory --</option>
                            @foreach($factories as $factory)
                                <option value="{{ $factory }}" {{ old('factory', $user->factory) == $factory ? 'selected' : '' }}>
                                    {{ $factory }}
                                </option>
                            @endforeach
                        </select>
                        @error('factory')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    {{-- Phone --}}
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Phone</label>
                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                            value="{{ old('phone', $user->phone) }}">
                        @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    {{-- Address --}}
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Address</label>
                        <input type="text" name="address" class="form-control @error('address') is-invalid @enderror"
                            value="{{ old('address', $user->address) }}">
                        @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    {{-- Remarks --}}
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Remarks</label>
                        <textarea name="remarks" class="form-control @error('remarks') is-invalid @enderror" rows="2">{{ old('remarks', $user->remarks) }}</textarea>
                        @error('remarks')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <hr>

                <h5 class="fw-bold text-primary mt-3">Password Section (Optional)</h5>
                <p class="text-muted small mb-3">To update your password, enter your **New Password**, and **Confirm Password**.</p>

                <div class="row g-3">

                    {{-- New Password --}}
                    <div class="col-md-4">
                        <label class="form-label fw-bold">New Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="New password">
                        @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    {{-- Confirm Password --}}
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Confirm new password">
                        @error('password_confirmation')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
