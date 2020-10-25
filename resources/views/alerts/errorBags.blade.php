@if($errors ?? ''->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error:</strong><br>
        <ul class="mb-0">
            @foreach($errors ?? ''->all() as $error)
            <li>{!! $error !!}</li>
            @endforeach
        </ul>
        {{-- <button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="ik ik-x"></i></button> --}}
    </div>
@endif
