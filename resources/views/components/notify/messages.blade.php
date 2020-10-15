


@if (session()->has('notify'))
    {{-- @if (session()->get('notify.model') === 'toast2') --}}
    <script>
        md.showNotification('top','right', "{{ session()->get('notify')->message }}", "{{ session()->get('notify')->type }}")
        </script>
    {{-- @endif --}}
    {{ session()->forget('notify') }}
@endif
