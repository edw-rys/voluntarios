@section('scripts_cdn')
    <script type="text/javascript"
        src="https://maps.google.com/maps/api/js?key=AIzaSyBBtHFtOx8jTPm2M5zeYFt9WPXMRAkY33k&callback=initMap"></script>
@endsection
@section('scripts')
    <script>
        var url_passpor_exist = "{{ route('api.admin.voluntarios.existe-pasaporte') }}";
        var url_ciudad = "{{ route('api.admin.voluntarios.ciudades') }}";
        var url_facultad = "{{ route('api.admin.voluntarios.facultad') }}";

    </script>
    <script type="text/javascript" src="{{ asset('js/validates/creacion-voluntario.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/core/maps.js') }}"></script>
    <script>
        function cargarCiudades(pais_id) {
            $.ajax({
                url: "{{ route('api.admin.voluntarios.ciudades') }}"+ '?pais='+pais_id,
                beforeSend: function(xhr) {
                    xhr.overrideMimeType("text/plain; charset=x-user-defined");
                }
            })
            .done(function(data) {
                console.log(data);
                try {
                    data = JSON.parse(data);
                } catch (error) {}
                var select = '';
                if(data && Array.isArray(data)){
                    for (const ciudad of data) {
                        Cuidad+='<option value="'+ciudad.id+'">'+ciudad.Nombre +'</option>';
                    }
                }
                document.getElementById('Cuidad').innerHTML = Cuidad;
            });
        }

        function cargarFacultades(universidad_id) {
            $.ajax({
                url: "{{ route('api.admin.voluntarios.facultad') }}"+ '?pais=' + universidad_id,
                beforeSend: function(xhr) {
                    xhr.overrideMimeType("text/plain; charset=x-user-defined");
                }
            })
            .done(function(data) {
                try {
                    data = JSON.parse(data);
                } catch (error) {}
                var select = '';
                if(data && Array.isArray(data)){
                    for (const ciudad of data) {
                        Cuidad+='<option value="'+ciudad.id+'">'+ciudad.Nombre +'</option>';
                    }
                }
                document.getElementById('Cuidad').innerHTML = Cuidad;
            });
        }
    </script>
@endsection
