@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.qrCode.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.qr-codes.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="qr_Code">{{ trans('cruds.qrCode.fields.qr_code') }}</label>
                <input class="form-control {{ $errors->has('qr_Code') ? 'is-invalid' : '' }}" type="text" name="qr_Code" id="qr_Code" value="{{ old('qr_Code', '') }}" required>
                @if($errors->has('qr_Code'))
                    <span class="text-danger">{{ $errors->first('qr_Code') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.qrCode.fields.qr_code_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection