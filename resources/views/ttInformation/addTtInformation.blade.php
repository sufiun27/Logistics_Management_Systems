@extends('template.index')
@section('content')

@php
    use App\Models\Export;
    $exporters = Export::pluck('ExpoterName', 'ExpoterName');
@endphp

<div class="container-fluid">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Add TT Information</h5>
            <a href="{{ route('ttInformation.ttInformation') }}" class="btn btn-light btn-sm">Back</a>
        </div>
        <div class="card-body">
            <form class="form-horizontal" action="{{ route('ttInformation.storeTtInformation') }}" method="POST" id="ttInformationForm">
                @csrf
                <h4 class="card-title mb-4">TT Information</h4>
                <x-message/>

                @php
                    $fields = [
                        [
                            'label' => 'TT Number',
                            'name' => 'tt_no',
                            'type' => 'text',
                            'placeholder' => 'Enter TT Number',
                            'required' => true,
                        ],
                        [
                            'label' => 'TT Amount',
                            'name' => 'tt_amount',
                            'type' => 'number',
                            'placeholder' => 'Enter TT Amount',
                            'required' => true,
                            'step' => '0.01',
                        ],
                        [
                            'label' => 'TT Currency',
                            'name' => 'tt_currency',
                            'type' => 'select',
                            'options' => [
                                'USD' => 'USD',
                                'TK' => 'TK',
                                'Pound' => 'Pound',
                                'HK' => 'HK',
                            ],
                            'placeholder' => 'Select Currency',
                            'required' => true,
                        ],
                        [
                            'label' => 'Bank Name',
                            'name' => 'bank_name',
                            'type' => 'text',
                            'placeholder' => 'Enter Bank Name',
                            'required' => true,
                        ],
                        [
                            'label' => 'TT Site',
                            'name' => 'tt_site',
                            'type' => 'select',
                            // Note: $exporters should be passed from the controller, e.g. compact('exporters')
                            'options' => $exporters ?? [],
                            'placeholder' => 'Select TT Site',
                            'required' => true,
                        ],
                        [
                            'label' => 'TT Date',
                            'name' => 'tt_date',
                            'type' => 'date',
                            'placeholder' => 'Select TT Date',
                            'required' => true,
                        ],
                        [
                            'label' => 'TT Remarks',
                            'name' => 'tt_remarks',
                            'type' => 'textarea',
                            'placeholder' => 'Enter TT Remarks',
                        ],
                    ];
                @endphp

                @foreach ($fields as $field)
                    <div class="mb-3 row">
                        <label for="{{ $field['name'] }}" class="col-sm-3 col-form-label fw-medium">
                            {!! $field['label'] !!} {!! !empty($field['required']) ? '<span class="text-danger">*</span>' : '' !!}:
                        </label>
                        <div class="col-sm-9">
                            @if ($field['type'] === 'select')
                                <select
                                    name="{{ $field['name'] }}"
                                    id="{{ $field['name'] }}"
                                    class="form-select @error($field['name']) is-invalid @enderror"
                                    aria-label="{{ $field['placeholder'] }}"
                                    @if (!empty($field['required'])) required @endif
                                >
                                    <option value="" disabled {{ old($field['name']) ? '' : 'selected' }}>
                                        {{ $field['placeholder'] }}
                                    </option>
                                    @foreach ($field['options'] as $value => $label)
                                        <option value="{{ $value }}" {{ old($field['name']) == $value ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                            @elseif ($field['type'] === 'textarea')
                                <textarea
                                    name="{{ $field['name'] }}"
                                    id="{{ $field['name'] }}"
                                    class="form-control @error($field['name']) is-invalid @enderror"
                                    placeholder="{{ $field['placeholder'] }}"
                                    rows="4"
                                    @if (!empty($field['required'])) required @endif
                                >{{ old($field['name']) }}</textarea>
                            @else
                                <input
                                    type="{{ $field['type'] }}"
                                    name="{{ $field['name'] }}"
                                    id="{{ $field['name'] }}"
                                    class="form-control @error($field['name']) is-invalid @enderror"
                                    placeholder="{{ $field['placeholder'] }}"
                                    value="{{ old($field['name']) }}"
                                    @if (!empty($field['required'])) required @endif
                                    @if (isset($field['step'])) step="{{ $field['step'] }}" @endif
                                />
                            @endif
                            @error($field['name'])
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                @endforeach

                <div class="border-top pt-3 mt-4">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="reset" class="btn btn-outline-secondary ms-2">Reset</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap 5 JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
$(document).ready(function() {
    // Form validation
    $('#ttInformationForm').on('submit', function(e) {
        let isValid = true;

        $(this).find('input[required], select[required], textarea[required]').each(function() {
            if (!$(this).val()) {
                $(this).addClass('is-invalid');
                isValid = false;
            } else {
                $(this).removeClass('is-invalid');
            }
        });

        if (!isValid) {
            e.preventDefault();
            $(this).find('.is-invalid').first().focus();
        }
    });

    // Clear invalid state on input/change
    $('input, select, textarea').on('input change', function() {
        $(this).removeClass('is-invalid');
    });
});
</script>

<style>
.card {
    border-radius: 0.5rem;
}
.card-header {
    border-radius: 0.5rem 0.5rem 0 0;
}
.form-control, .form-select, textarea {
    border-radius: 0.375rem;
}
.form-control.is-invalid, .form-select.is-invalid, textarea.is-invalid {
    border-color: #dc3545;
}
</style>
@endsection
