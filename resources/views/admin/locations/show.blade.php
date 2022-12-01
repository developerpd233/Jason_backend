@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.location.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.locations.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.location.fields.id') }}
                        </th>
                        <td>
                            {{ $location->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.location.fields.location') }}
                        </th>
                        <td>
                            {{ $location->location }}
                        </td>
                    </tr>
                    @if($qr)
                    <tr>
                        <th>
                            {{ trans('cruds.location.fields.qr_code') }}
                        </th>
                        <td>
                            <a href="{{url('admin/qr-codes/'.$qr->id)}}"><span class="label label-info">{{ $qr->qr_Code }}</span></a>
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.locations.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection