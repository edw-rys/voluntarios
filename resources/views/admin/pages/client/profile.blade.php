@extends('clients.templates.template')
{{-- @include('admin.partials.datatable') --}}

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">{{ trans('global.profile.edit_profile') }}</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('client.profile.update') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Company (disabled)</label>
                                        <input type="text" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{ trans('global.profile.identification_number') }}</label>
                                        <input type="text" class="form-control"  value="{{ isset($user) ? $user->identification_number : '' }}" disabled>
                                    </div>
                                </div>
                                <input type="hidden" name="id" value="{{ optimus()->encode($user->id) }}">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{ trans('global.profile.email') }}</label>
                                        <input type="email" class="form-control @error('email') {{ 'is-invalid' }} @enderror" name="email" value="{{ old('email', isset($user) ? $user->email : '') }}">
                                        @error('email')
                                            <p class="help-block">{!! $message !!}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{ trans('global.profile.first_name') }}</label>
                                        <input type="text" name="first_name" class="form-control @error('first_name') {{ 'is-invalid' }} @enderror" value="{{ old('first_name', isset($user) ? $user->first_name : '') }}" required>
                                        @error('first_name')
                                            <p class="help-block">{!! $message !!}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{ trans('global.profile.second_name') }}</label>
                                        <input type="text" class="form-control @error('second_name') {{ 'is-invalid' }} @enderror" name="second_name" value="{{ old('second_name', isset($user) ? $user->second_name : '') }}">
                                        @error('second_name')
                                            <p class="help-block">{!! $message !!}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{ trans('global.profile.last_name') }}</label>
                                        <input type="text" class="form-control @error('last_name') {{ 'is-invalid' }} @enderror" name="last_name" value="{{ old('last_name', isset($user) ? $user->last_name : '') }}" required>
                                        @error('last_name')
                                            <p class="help-block">{!! $message !!}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{ trans('global.profile.source_name') }}</label>
                                        <input type="text" class="form-control @error('source_name') {{ 'is-invalid' }} @enderror" name="source_name" value="{{ old('source_name', isset($user) ? $user->source_name : '') }}"> 
                                        @error('source_name')
                                            <p class="help-block">{!! $message !!}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{ trans('global.profile.address') }}</label>
                                        <input type="text" class="form-control @error('address') {{ 'is-invalid' }} @enderror" name="address" value="{{ old('source_name', isset($user) ? $user->address : '') }}">
                                        @error('address')
                                            <p class="help-block">{!! $message !!}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{ trans('global.profile.city') }}</label>
                                        <input type="text" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{ trans('global.profile.country') }}</label>
                                        <input type="text" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{ trans('global.profile.postal_code') }}</label>
                                        <input type="text" class="form-control" value="{{ old('postal_code', isset($user) ? $user->postal_code : '') }}">
                                    </div>
                                </div>
                            </div> --}}
 
                            <button type="submit" class="btn btn-primary pull-right">{{ trans('global.profile.update_profile') }}</button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-profile">
                    <div class="card-body">
                        <h6 class="card-category text-gray"></h6>
                        <h4 class="card-title">{{ trans('global.profile.title_pssw') }}</h4>
                        <form action="{{ route('client.update_password.post') }}" method="post" class="mt-4">
                            <div class="row">
                                <div class="col-md-9" style="margin: 0 auto">
                                    <div class="form-group">
                                        <label class="">{{ trans('global.profile.old_password') }}</label>
                                        <input type="password" class="form-control" name="old_password">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-9" style="margin: 0 auto">
                                    <div class="form-group">
                                        <label class="">{{ trans('global.profile.new_password') }}</label>
                                        <input type="password" class="form-control" name="new_password">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-9" style="margin: 0 auto">
                                    <div class="form-group">
                                        <label class="">{{ trans('global.profile.confirm_password') }}</label>
                                        <input type="password" class="form-control" name="confirm_password">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary pull-center">{{ trans('global.profile.btn_pssw_change') }}</button>
                        </form>
                    </div>
                </div>
                @include('alerts.errorBags')
                @include('alerts.errorSessions')
            </div>
        </div>
    </div>
@endsection
