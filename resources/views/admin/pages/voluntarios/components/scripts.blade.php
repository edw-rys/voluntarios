@section('scripts_cdn')


    <script type="text/javascript"
        src="https://maps.google.com/maps/api/js?key=AIzaSyBBtHFtOx8jTPm2M5zeYFt9WPXMRAkY33k&callback=initMap"></script>
@endsection
@section('scripts')
    
    <script src="{{ asset('js/multistepform.js') }}" type="text/javascript"></script>
    <script>
        var url_passpor_exist = "{{ route('api.admin.voluntarios.existe-pasaporte') }}";
        var url_ciudad = "{{ route('api.admin.voluntarios.ciudades') }}";
        var url_facultad = "{{ route('api.admin.voluntarios.facultad') }}";

    </script>
    <script type="text/javascript" src="{{ asset('js/core/maps.js') }}"></script>
    <script>
        function cargarCiudades(pais_id, selected = 0) {
            $.ajax({
                    url: "{{ route('api.admin.voluntarios.ciudades') }}" + '?pais=' + pais_id,
                    beforeSend: function(xhr) {
                        xhr.overrideMimeType("text/plain; charset=x-user-defined");
                    }
                })
                .done(function(data) {
                    try {
                        data = JSON.parse(data);
                    } catch (error) {}
                    var select = '';
                    if (data && Array.isArray(data)) {
                        for (const ciudad of data) {
                            select += '<option value="' + ciudad.id + '" '+ (selected == ciudad.id ? 'selected': '') +'>' + ciudad.Nombre + '</option>';
                        }
                    }
                    document.getElementById('Ciudad').innerHTML = select;
                });
        }

        function cargarFacultades(universidad_id = 0, selected = false) {
            $.ajax({
                    url: "{{ route('api.admin.voluntarios.facultad') }}" + '?universidad=' + universidad_id,
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
                    if (data && Array.isArray(data)) {
                        for (const facultad of data) {
                            select += '<option value="' + facultad.idFacultad + '" '+ (selected == facultad.idFacultad ? 'selected': '') +'>' + facultad.NombreFacultad + '</option>';
                        }
                    }
                    document.getElementById('Facultad').innerHTML = select;
                });
        }
        // cargarFacultades($('#Universidad').val());

        function cargarTutores(departamento = 0, selected) {
            $.ajax({
                    url: "{{ route('api.admin.voluntarios.tutores') }}" + '?departamento=' + departamento,
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
                    if (data && Array.isArray(data)) {
                        for (const ususario of data) {
                            select += '<option value="' + ususario.id + '" '+ (selected == ususario.id ?'selected':'') + '>' + ususario.Nombres + ' ' + ususario
                                .Apellidos + '</option>';
                        }
                    }
                    document.getElementById('idtutor').innerHTML = select;
                });
        }
        cargarTutores($('#Departamento').val(), tutor_selected);
        cargarFacultades($('#Universidad').val(), facultad_selected);

    </script>
@endsection

@section('end_scripts')
    <script>
        setInterval(() => {
            $('.select2-container ').css({
                display: 'block'
            })
        }, 500)

    </script>

@endsection
