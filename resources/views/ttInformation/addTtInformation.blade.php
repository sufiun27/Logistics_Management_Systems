@extends('template.index')
@section('content')

<div class="card">
    <div class="card-header">
        <a href="{{ route('ttInformation.ttInformation') }}" class="btn btn-success btn-sm">Back</a>
    </div>
    <form class="form-horizontal" action="{{ route('ttInformation.storeTtInformation') }}" method="POST">
        @csrf
        <div class="card-body">
            <h4 class="card-title">Add TT information</h4>
            <x-message/>

            <!-- Add fields for tt_information table -->
            <div class="form-group row">
                <label for="tt_no" class="col-sm-3 text-end control-label col-form-label">TT Number</label>
                <div class="col-sm-9">
                    <input type="text" name="tt_no" class="form-control" id="tt_no" placeholder="TT Number" value="{{ old('tt_no') }}" />
                </div>
            </div>

            <div class="form-group row">
                <label for="tt_amount" class="col-sm-3 text-end control-label col-form-label">TT Amount</label>
                <div class="col-sm-9">
                    <input type="text" name="tt_amount" class="form-control" id="tt_amount" placeholder="TT Amount" value="{{ old('tt_amount') }}" />
                </div>
            </div>

            <div class="form-group row">
                <label for="tt_currency" class="col-sm-3 text-end control-label col-form-label">TT Currency</label>
                <div class="col-sm-9">
                    <select name="tt_currency" id="tt_currency" class="form-control">
                        <option value="USD" {{ old('tt_currency') == 'USD' ? 'selected' : '' }}>USD</option>
                        <option value="TK" {{ old('tt_currency') == 'TK' ? 'selected' : '' }}>TK</option>
                        <option value="Pound" {{ old('tt_currency') == 'Pound' ? 'selected' : '' }}>Pound</option>
                        <option value="HK" {{ old('tt_currency') == 'HK' ? 'selected' : '' }}>HK</option>
                    </select>
                </div>
            </div>


            <div class="form-group row">
                <label for="bank_name" class="col-sm-3 text-end control-label col-form-label">Bank Name</label>
                <div class="col-sm-9">
                    <input type="text" name="bank_name" class="form-control" id="bank_name" placeholder="Bank Name" value="{{ old('bank_name') }}" />
                </div>
            </div>

            <div class="form-group row">
                <label for="tt_site" class="col-sm-3 text-end control-label col-form-label">TT Site</label>
                <div class="col-sm-9">
                    <select name="tt_site" id="tt_site" class="form-control">
                        @foreach($exrter as $exrter)
                        <option value="{{$exrter->ExpoterName}}" {{ old('tt_site') == $exrter->ExpoterName ? 'selected' : '' }}>{{$exrter->ExpoterName}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="tt_date" class="col-sm-3 text-end control-label col-form-label">TT Date</label>
                <div class="col-sm-9">
                    <input type="date" name="tt_date" class="form-control" id="tt_date" placeholder="TT Date" value="{{ old('tt_date') }}" />
                </div>
            </div>

            <div class="form-group row">
                <label for="tt_remarks" class="col-sm-3 text-end control-label col-form-label">TT Remarks</label>
                <div class="col-sm-9">
                    <textarea name="tt_remarks" class="form-control" id="tt_remarks" placeholder="TT Remarks">{{ old('tt_remarks') }}</textarea>
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
