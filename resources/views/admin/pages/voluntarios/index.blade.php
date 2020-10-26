@extends('admin.templates.template')
@include('admin.partials.datatable')

@section('content')
<div class="page-header-title"><i class=""></i></div>
@include('components.forms.filters')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        {!! $dataTable->table([], false) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
