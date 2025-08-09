@extends('template.index')
@section('content')

<div class="main-wrapper">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Preloader -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

    <!-- Auth Wrapper -->
    <div class="auth-wrapper d-flex justify-content-center align-items-center" style="background: linear-gradient(135deg, #1e3a8a, #3b82f6); min-height: 100vh;">
        <div class="auth-box bg-white shadow-lg rounded-3 p-4 p-md-5" style="max-width: 500px; width: 100%;">
            <div class="text-center mb-4">
                <h2 class="fw-bold text-primary">Update Employee</h2>
            </div>

            <!-- Form -->
            <form class="form-horizontal" method="POST" action="{{ route('employee.update', $employee->id) }}">
                @csrf

                <div class="row g-3">
                    <div class="col-12">
                        <!-- Username -->
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-primary text-white" id="basic-addon1">
                                <i class="fas fa-user"></i>
                            </span>
                            <input
                                name="name"
                                type="text"
                                class="form-control form-control-lg"
                                value="{{ $employee->name }}"
                                aria-label="Username"
                                aria-describedby="basic-addon1"
                                required
                            />
                        </div>

                        <!-- Employee ID -->
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-primary text-white" id="basic-addon2">
                                <i class="fas fa-id-badge"></i>
                            </span>
                            <input
                                name="emp_id"
                                type="text"
                                class="form-control form-control-lg"
                                value="{{ $employee->emp_id }}"
                                aria-label="Employee ID"
                                aria-describedby="basic-addon2"
                                required
                            />
                        </div>

                        <!-- Email Address -->
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-primary text-white" id="basic-addon3">
                                <i class="fas fa-envelope"></i>
                            </span>
                            <input
                                name="email"
                                type="email"
                                class="form-control form-control-lg"
                                value="{{ $employee->email }}"
                                aria-label="Email Address"
                                aria-describedby="basic-addon3"
                                required
                            />
                        </div>

                        <!-- Site -->
                        <?php
                        use App\Models\Export;
                        $exporters = Export::pluck('ExpoterName')->toArray();
                        ?>
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-primary text-white" id="basic-addon4">
                                <i class="fas fa-sitemap"></i>
                            </span>
                            <select
                                name="site"
                                class="form-control form-control-lg"
                                required
                                aria-label="Site"
                                aria-describedby="basic-addon4"
                            >
                                <option value="" disabled>Select Site</option>
                                <?php foreach ($exporters as $exporter): ?>
                                    <option value="<?= htmlspecialchars($exporter) ?>" <?= $employee->site == $exporter ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($exporter) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Factory -->
                        @php
                        use App\Models\Factory;
                        $factories = Factory::pluck('factory_name')->toArray();
                        @endphp
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-primary text-white" id="basic-addon5">
                                <i class="fas fa-industry"></i>
                            </span>
                            <select
                                name="factory"
                                class="form-control form-control-lg"
                                required
                                aria-label="Factory"
                                aria-describedby="basic-addon5"
                            >
                                <option value="" disabled>Select Factory</option>
                                @foreach ($factories as $factory)
                                    <option value="{{ htmlspecialchars($factory) }}" {{ $employee->factory == $factory ? 'selected' : '' }}>
                                        {{ htmlspecialchars($factory) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Department -->
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-primary text-white" id="basic-addon6">
                                <i class="fas fa-building"></i>
                            </span>
                            <input
                                name="department"
                                type="text"
                                class="form-control form-control-lg"
                                value="{{ $employee->department }}"
                                aria-label="Department"
                                aria-describedby="basic-addon6"
                                required
                            />
                        </div>

                        <!-- Designation -->
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-primary text-white" id="basic-addon7">
                                <i class="fas fa-briefcase"></i>
                            </span>
                            <input
                                name="designation"
                                type="text"
                                class="form-control form-control-lg"
                                value="{{ $employee->designation }}"
                                aria-label="Designation"
                                aria-describedby="basic-addon7"
                                required
                            />
                        </div>

                        <!-- Address -->
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-primary text-white" id="basic-addon8">
                                <i class="fas fa-map-marker-alt"></i>
                            </span>
                            <input
                                name="address"
                                type="text"
                                class="form-control form-control-lg"
                                value="{{ $employee->address }}"
                                aria-label="Address"
                                aria-describedby="basic-addon8"
                                required
                            />
                        </div>

                        <!-- Remarks -->
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-primary text-white" id="basic-addon9">
                                <i class="fas fa-comment"></i>
                            </span>
                            <input
                                name="remarks"
                                type="text"
                                class="form-control form-control-lg"
                                value="{{ $employee->remarks }}"
                                aria-label="Remarks"
                                aria-describedby="basic-addon9"
                            />
                        </div>

                        <!-- Phone -->
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-primary text-white" id="basic-addon10">
                                <i class="fas fa-phone"></i>
                            </span>
                            <input
                                name="phone"
                                type="tel"
                                class="form-control form-control-lg"
                                value="{{ $employee->phone }}"
                                aria-label="Phone"
                                aria-describedby="basic-addon10"
                                required
                            />
                        </div>
                    </div>
                </div>

                  {{-- update password --}}
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label fw-bold">Update Password (optional)</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-primary text-white" id="basic-addon11">
                                <i class="fas fa-lock"></i>
                            </span>
                            <input
                                name="password"
                                type="password"
                                class="form-control form-control-lg"
                                placeholder="New Password"
                                aria-label="New Password"
                                aria-describedby="basic-addon11"
                            />
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-primary text-white" id="basic-addon12">
                                <i class="fas fa-lock"></i>
                            </span>
                            <input
                                name="password_confirmation"
                                type="password"
                                class="form-control form-control-lg"
                                placeholder="Confirm New Password"
                                aria-label="Confirm New Password"
                                aria-describedby="basic-addon12"
                            />
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="d-grid">
                            <button class="btn btn-primary btn-lg" type="submit">
                                <i class="fas fa-user-edit me-2"></i>Update User
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Required JS -->
    <script src="{{ asset('matrix/assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('matrix/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script>
        $(".preloader").fadeOut();
    </script>
</div>
@endsection
