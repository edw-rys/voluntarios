@section('scripts_cdn')
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script> -->
    <script type="text/javascript" src="{{ asset('js/chart.min.js')}}"></script>
@endsection

@section('scripts')
    <script>
        var universidades = {!! datosVoluntariosUniversidad() !!}
        var facultades = {!! datosVoluntariosFacultades() !!}
        var departamentos = {!! datosVoluntariosDepartamentos() !!}
        const generarColor = () => "#000000".replace(/0/g, () => (~~(Math.random() * 16)).toString(16))

        function addData(id, numData, chart) {
            for (var i = 0; i < numData; i++) {
                chart.data.datasets[0].data.push(Math.random() * 100);
                // chart.data.labels.push("Label" + i);
                var newwidth = $(id).width() + 60;
                $(id).width(newwidth);
            }
        }

        function generarBarras(id, chartData){
            // debugger;
            var rectangleSet = false;

            var canvasTest = $(id);
            var chartTest = new Chart(canvasTest, {
                type: 'bar',
                data: chartData,
                // maintainAspectRatio: false,
                responsive: true,
                options: {

                    legend: {
                        display: false
                    },
                    scales: {
                        xAxes: [{
                            ticks: {
                                fontSize: 12,
                                display: false
                            }
                        }],
                        yAxes: [{
                            ticks: {
                                fontSize: 12,
                                beginAtZero: true
                            }
                        }]
                    },
                    animation: {
                        onComplete: function () {
                            if (!rectangleSet) {
                                var scale = window.devicePixelRatio;                       

                                var sourceCanvas = chartTest.chart.canvas;
                                var copyWidth = chartTest.scales['y-axis-0'].width - 10;
                                var copyHeight = chartTest.scales['y-axis-0'].height + chartTest.scales['y-axis-0'].top + 10;

                                var targetCtx = document.querySelector(id+"axis-Test").getContext("2d");

                                targetCtx.scale(scale, scale);
                                targetCtx.canvas.width = copyWidth * scale;
                                targetCtx.canvas.height = copyHeight * scale;

                                targetCtx.canvas.style.width = `${copyWidth}px`;
                                targetCtx.canvas.style.height = `${copyHeight}px`;
                                targetCtx.drawImage(sourceCanvas, 0, 0, copyWidth * scale, copyHeight * scale, 0, 0, copyWidth * scale, copyHeight * scale);

                                var sourceCtx = sourceCanvas.getContext('2d');

                                // Normalize coordinate system to use css pixels.

                                sourceCtx.clearRect(0, 0, copyWidth * scale, copyHeight * scale);
                                rectangleSet = true;
                            }
                        },
                        onProgress: function () {
                            if (rectangleSet === true) {
                                var copyWidth = chartTest.scales['y-axis-0'].width;
                                var copyHeight = chartTest.scales['y-axis-0'].height + chartTest.scales['y-axis-0'].top + 10;

                                var sourceCtx = chartTest.chart.canvas.getContext('2d');
                                sourceCtx.clearRect(0, 0, copyWidth, copyHeight);
                            }
                        }
                    }
                }
            });
            addData('.chartAreaWrapper2', chartData.length, chartTest);

        }

        var dataFilter = universidades.filter(e=>e.voluntarios >0);
        // dataFilter=dataFilter.concat(dataFilter)
        var chartData = {
            labels: dataFilter.map(e=>e.Nombre),//generateLabels(),
            datasets: [{
                label: 'Totales',
                // label: "Test Data Set",
                backgroundColor : dataFilter.map(e=> generarColor()),
                data:  dataFilter.map(e=>e.voluntarios),//generateData()
                borderWidth: 1
            }]
        };
        generarBarras('#grafico-universidad-bar',chartData)

        var dataFilter = facultades.filter(e=>e.voluntarios >0);

        var chartData = {
            labels: dataFilter.map(e=>e.NombreFacultad),//generateLabels(),
            datasets: [{
                label: 'Totales',
                // label: "Test Data Set",
                backgroundColor : dataFilter.map(e=> generarColor()),
                data:  dataFilter.map(e=>e.voluntarios),//generateData()
                borderWidth: 1
            }]
        };
        generarBarras('#grafico-facultad-bar', chartData )

        var dataFilter = departamentos.filter(e=>e.voluntarios >0);

        var chartData = {
            labels: dataFilter.map(e=>e.Nombre),//generateLabels(),
            datasets: [{
                label: 'Totales',
                // label: "Test Data Set",
                backgroundColor : dataFilter.map(e=> generarColor()),
                data:  dataFilter.map(e=>e.voluntarios),//generateData()
                borderWidth: 1
            }]
        };
        generarBarras('#grafico-departamentos-bar', chartData)

        /*function generarBarrasMixed(id, labels= [], voluntariosTotal= []){
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
        */
        //mixed chart
        // generarBarrasMixed('grafico-universidad-mixed', universidades.map(e=> e.Nombre), universidades.map(e=> e.voluntarios) )
        // generarBarrasMixed('grafico-facultad-mixed', facultades.map(e=> e.NombreFacultad), facultades.map(e=> e.voluntarios) )
        // generarBarrasMixed('grafico-departamentos-mixed', departamentos.map(e=> e.Nombre), departamentos.map(e=> e.voluntarios) )
    </script>
    
@endsection

@section('end_scripts')
@endsection
