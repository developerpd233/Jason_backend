@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.user.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.users.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.user.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.name_helper') }}</span>
            </div>
            <div class="form-group" style="display:none;">
                <label class="required" for="email">{{ trans('cruds.user.fields.email') }}</label>
                <input disabled class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email') }}">
                @if($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.email_helper') }}</span>
            </div>
            <div class="form-group" style="display:none;">
                <label class="required" for="password">{{ trans('cruds.user.fields.password') }}</label>
                <input disabled class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" id="password" required>
                @if($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.password_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="roles">{{ trans('cruds.user.fields.roles') }}</label>
                <div style="padding-bottom: 4px">
                    <!-- <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span> -->
                </div>
                <select class="form-control select2 {{ $errors->has('roles') ? 'is-invalid' : '' }}" name="roles[]" id="roles" required>
                    <option value="" selected disabled>Select Role</option>
                    @foreach($roles as $id => $role)
                        <option value="{{ $id }}" {{ in_array($id, old('roles', [])) ? 'selected' : '' }}>{{ $role }}</option>
                    @endforeach
                </select>
                @if($errors->has('roles'))
                    <span class="text-danger">{{ $errors->first('roles') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.roles_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.user.fields.identity') }}</label>
                <select class="form-control {{ $errors->has('identity') ? 'is-invalid' : '' }}" name="identity" id="identity">
                    <option value disabled {{ old('identity', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\User::IDENTITY_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('identity', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('identity'))
                    <span class="text-danger">{{ $errors->first('identity') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.identity_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.user.fields.interest') }}</label>
                <select class="form-control {{ $errors->has('interest') ? 'is-invalid' : '' }}" name="interest" id="interest" required>
                    <option value disabled {{ old('interest', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\User::INTEREST_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('interest', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('interest'))
                    <span class="text-danger">{{ $errors->first('interest') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.interest_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.user.fields.age') }}</label>
                <select class="form-control {{ $errors->has('age') ? 'is-invalid' : '' }}" name="age" id="age" required>
                    <option value disabled {{ old('age', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\User::AGE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('age', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('age'))
                    <span class="text-danger">{{ $errors->first('age') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.age_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.user.fields.relation_preference') }}</label>
                <select class="form-control {{ $errors->has('relation_preference') ? 'is-invalid' : '' }}" name="relationPreference" id="relationPreference" required>
                    <option value disabled {{ old('relation_preference', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\User::RELATION_PREFERENCE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('relationPreference', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('relation_preference'))
                    <span class="text-danger">{{ $errors->first('relation_preference') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.relation_preference_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="favDrink">{{ trans('cruds.user.fields.fav_drink') }}</label>
                <input class="form-control {{ $errors->has('favDrink') ? 'is-invalid' : '' }}" type="text" name="favDrink" id="favDrink" value="{{ old('favDrink', '') }}" required>
                @if($errors->has('favDrink'))
                    <span class="text-danger">{{ $errors->first('favDrink') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.fav_drink_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="favSong">{{ trans('cruds.user.fields.fav_song') }}</label>
                <input class="form-control {{ $errors->has('favSong') ? 'is-invalid' : '' }}" type="text" name="favSong" id="favSong" value="{{ old('favSong', '') }}" required>
                @if($errors->has('favSong'))
                    <span class="text-danger">{{ $errors->first('favSong') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.fav_song_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="hobbies">{{ trans('cruds.user.fields.hobbies') }}</label>
                <input class="form-control {{ $errors->has('hobbies') ? 'is-invalid' : '' }}" type="text" name="hobbies" id="hobbies" value="{{ old('hobbies', '') }}" required>
                @if($errors->has('hobbies'))
                    <span class="text-danger">{{ $errors->first('hobbies') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.hobbies_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="petPeeve">{{ trans('cruds.user.fields.my_dislikes') }}</label>
                <input class="form-control {{ $errors->has('petPeeve') ? 'is-invalid' : '' }}" type="text" name="petPeeve" id="petPeeve" value="{{ old('petPeeve', '') }}" required>
                @if($errors->has('petPeeve'))
                    <span class="text-danger">{{ $errors->first('petPeeve') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.my_dislikes_helper') }}</span>
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