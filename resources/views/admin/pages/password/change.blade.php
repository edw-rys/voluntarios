@extends('admin.templates.template')
{{-- @include('admin.partials.datatable') --}}

@section('content')
    <div class="container-fluid ">
        <div class="row">
            <div class="col-md-7 m-auto">
                <div class="card card-profile">
                    <div class="card-body">
                        <h6 class="card-category text-gray"></h6>
                        <h4 class="card-title">{{ trans('global.profile.title_pssw') }}</h4>
                        <form action="{{ route('client.change_password.post') }}" method="post" class="mt-4">
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
                            <button type="submit"
                                name="change_password"
                                class="btn btn-primary pull-center">{{ trans('global.profile.btn_pssw_change') }}</button>
                        </form>
                        <div class="mt-3">
                            @include('alerts.errorBags')
                            @include('alerts.errorSessions')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
