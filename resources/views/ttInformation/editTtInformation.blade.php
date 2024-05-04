@extends('template.index')
@section('content')

<div class="card">
    <div class="card-header">
        <a href="{{ route('ttInformation.ttInformation') }}" class="btn btn-success btn-sm">Back</a>
    </div>
    <form class="form-horizontal" action="{{ route('ttInformation.updateTtInformation', $tt->id) }}" method="POST">
        @csrf
        <div class="card-body">
            <h4 class="card-title">Update TT information</h4>
            <x-message/>
    
            <!-- Add fields for tt_information table -->
            <div class="form-group row">
                <label for="tt_no" class="col-sm-3 text-end control-label col-form-label">TT Number</label>
                <div class="col-sm-9">
                    <input type="text" name="tt_no" class="form-control" id="tt_no" placeholder="TT Number" value="{{ $tt->tt_no }}" />
                </div>
            </div>

            <div class="form-group row">
                <label for="tt_amount" class="col-sm-3 text-end control-label col-form-label">TT Amount</label>
                <div class="col-sm-9">
                    <input type="text" name="tt_amount" class="form-control" id="tt_amount" placeholder="TT Amount" value="{{ $tt->tt_amount }}" />
                </div>
            </div>

            <div class="form-group row">
                <label for="tt_currency" class="col-sm-3 text-end control-label col-form-label">TT Currency</label>
                <div class="col-sm-9">
                    <select name="tt_currency" id="tt_currency" class="form-control">
                        <option value="USD" {{ $tt->tt_currency == 'USD' ? 'selected' : '' }}>USD</option>
                        <option value="TK" {{ $tt->tt_currency == 'TK' ? 'selected' : '' }}>TK</option>
                        <option value="Pound" {{ $tt->tt_currency == 'Pound' ? 'selected' : '' }}>Pound</option>
                        <option value="HK" {{ $tt->tt_currency == 'HK' ? 'selected' : '' }}>HK</option>
                    </select>
                </div>
            </div>
            
            
            <div class="form-group row">
                <label for="bank_name" class="col-sm-3 text-end control-label col-form-label">Bank Name</label>
                <div class="col-sm-9">
                    <input type="text" name="bank_name" class="form-control" id="bank_name" placeholder="Bank Name" value="{{ $tt->bank_name }}" />
                </div>
            </div>
            
            <div class="form-group row">
                <label for="tt_site" class="col-sm-3 text-end control-label col-form-label">TT Site</label>
                <div class="col-sm-9">
                    <select name="tt_site" id="tt_site" class="form-control">
                        <option value="APPERAL" {{ $tt->tt_site == 'APPERAL' ? 'selected' : '' }}>APPERAL</option>
                        <option value="HLBD" {{ $tt->tt_site == 'HLBD' ? 'selected' : '' }}>HLBD</option>
                        <option value="INTIMATE" {{ $tt->tt_site == 'INTIMATE' ? 'selected' : '' }}>INTIMATE</option>
                        <option value="HOPYICK" {{ $tt->tt_site == 'HOPYICK' ? 'selected' : '' }}>HOPYICK</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="tt_remarks" class="col-sm-3 text-end control-label col-form-label">TT Remarks</label>
                <div class="col-sm-9">
                    <textarea name="tt_remarks" class="form-control" id="tt_remarks" placeholder="TT Remarks">{{ $tt->tt_remarks }}</textarea>
                </div>
            </div>

            <!-- Add more fields for other columns in the tt_information table -->

            <div class="border-top">
                <div class="card-body">
                    <input type="submit" value="Save" class="btn btn-primary">
                </div>
            </div>
        </div>
    </form>
</div>

@endsection
