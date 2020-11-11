@section('scripts_cdn')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
@endsection

@section('scripts')
    <script>
        var universidades = {!! datosVoluntariosUniversidad() !!}
        var facultades = {!! datosVoluntariosFacultades() !!}
        var departamentos = {!! datosVoluntariosDepartamentos() !!}
        const generarColor = () => "#000000".replace(/0/g, () => (~~(Math.random() * 16)).toString(16))

        function generarDona(id, labels= [], voluntariosTotal= []){
            var doughnut = document.getElementById(id);
            if(! doughnut)return ;
            var doughnutConfig = new Chart(doughnut, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Totales',
                        data: voluntariosTotal,
                        backgroundColor: labels.map(e=> generarColor()),
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true, // Instruct chart js to respond nicely.
                    maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height 
                    // scales: {
                    //     yAxes: [{
                    //         ticks: {
                    //             beginAtZero:true
                    //         }
                    //     }]
                    // },
                }
            });
        }

        generarDona('grafico-universidad-doughnut', universidades.map(e=> e.Nombre), universidades.map(e=> e.voluntarios) )
        generarDona('grafico-facultad-doughnut', facultades.map(e=> e.NombreFacultad), facultades.map(e=> e.voluntarios) )
        generarDona('grafico-departamentos-doughnut', departamentos.map(e=> e.Nombre), departamentos.map(e=> e.voluntarios) )

        function generarBarrasMixed(id, labels= [], voluntariosTotal= []){
            var mixed = document.getElementById(id);
            var mixedConfig = new Chart(mixed, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Totales',
                        data: voluntariosTotal,
                        backgroundColor: labels.map(e=> generarColor()),
                        borderWidth: 1
                    }, {
                        label: 'Totales', // Name the series
                        data: voluntariosTotal,
                        type: 'line', // Specify the data values array
                        fill: false,
                        borderColor: '#2196f3', // Add custom color border (Line)
                        backgroundColor: '#2196f3', // Add custom color background (Points and Fill)
                        borderWidth: 1,
                        order: 2
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    },
                    responsive: true, // Instruct chart js to respond nicely.
                    maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height 
                }
            })
        }
        
        //mixed chart
        generarBarrasMixed('grafico-universidad-mixed', universidades.map(e=> e.Nombre), universidades.map(e=> e.voluntarios) )
        generarBarrasMixed('grafico-facultad-mixed', facultades.map(e=> e.NombreFacultad), facultades.map(e=> e.voluntarios) )
        generarBarrasMixed('grafico-departamentos-mixed', departamentos.map(e=> e.Nombre), departamentos.map(e=> e.voluntarios) )
    </script>
@endsection

@section('end_scripts')
@endsection
