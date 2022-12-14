@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.location.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.locations.update", [$location->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="location">{{ trans('cruds.location.fields.location') }}</label>
                <input class="form-control {{ $errors->has('location') ? 'is-invalid' : '' }}" type="text" name="location" id="location" value="{{ old('location', $location->location) }}" required>
                @if($errors->has('location'))
                    <span class="text-danger">{{ $errors->first('location') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.location.fields.location_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="qr_codes">{{ trans('cruds.location.fields.qr_code') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('qr_codes') ? 'is-invalid' : '' }}" name="qr_codes[]" id="qr_codes" multiple required>
                    
                    @foreach($qr_codes as $id => $qr_code)
                        <option value="{{ $id }}" {{ (in_array($id, old('qr_codes', [])) || $location->qr_codes->contains($id)) ? 'selected' : '' }}>{{ $qr_code }}</option>
                    @endforeach
                </select>
                @if($errors->has('qr_codes'))
                    <span class="text-danger">{{ $errors->first('qr_codes') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.location.fields.qr_code_helper') }}</span>
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