@if (session()->has('message'))
    <p class="alert alert-info alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="ik ik-x"></i></button>
        <i class="icon fas fa-info"></i> {!! session()->get('message') !!}
    </p>
    @php session()->forget('message') @endphp
@endif

@if (session()->has('status'))
    <p class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="ik ik-x"></i></button>
        <i class="icon fas fa-check"></i> {!! session()->get('status') !!}
    </p>
    @php session()->forget('status') @endphp
@endif

@if (session()->has('error'))
    <p class="alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="ik ik-x"></i></button>
        <i class="icon fas fa-ban"></i> {!! session()->get('error') !!}
    </p>
    @php session()->forget('error') @endphp
@endif

@if (session()->has('warning'))
    <p class="alert alert-warning alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="ik ik-x"></i></button>
        <i class="icon fas fa-exclamation-triangle"></i> {!! session()->get('warning') !!}
    </p>
    @php session()->forget('warning') @endphp
@endif

@if (session()->has('info'))
    <p class="alert alert-info alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="ik ik-x"></i></button>
        <i class="icon fas fa-info"></i> {!! session()->get('info') !!}
    </p>
    @php session()->forget('info') @endphp
@endif
