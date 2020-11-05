var $CodigoReferencia = $('#CodigoReferencia');
var $apellidoMaterno = $('#apellidoMaterno');
var $pasaporte_item = $('#Pasaporte');
var $nombreSegundo = $('#nombreSegundo');
var $tipo_practica = $('#tipoPractica');
var $pasatiempo = $('#CodigoReferencia');
var $EstadoCivil = $('#EstadoCivil');
var $Direccion = $('#Direccion');
var $Apellidos = $('#Apellidos');
var $FechaNac = $('#FechaNacimiento');
var $Telefono = $('#Telefono');
var $Nombres = $('#Nombres');
var $celular = $('#celular');
var $genero = $('#genero');
var $Correo = $('#Correo');
var $Ciudad = $('#Ciudad');
var $Pais = $('#Pais');

// 4
var $Universidad = $('#Universidad');
var $Facultad = $('#Facultad');
var $Carrera = $('#Carrera');
var $Nivel = $('#Nivel');

// 5
var $Tutor = $('#Tutor');
var $TutorBSPI = $('#idtutor');
var $Departamento = $('#Departamento');
var $observacion = $('#observacion');
var $Proyecto = $('#Proyecto');
var $chkActa = $('#chkActa');
var $Unidad = $('#Unidad');

var $HorasProgramada = $('#HorasProgramada');
var $FechaInicio = $('#FechaInicio');
var $FechaFin = $('#FechaFin');

var $horas_miercoles = $('#horas_miercoles');
var $horas_domingo = $('#horas_domingo');
var $horas_viernes = $('#horas_viernes');
var $horas_sabado = $('#horas_sabado');
var $horas_jueves = $('#horas_jueves');
var $horas_martes = $('#horas_martes');
var $horas_lunes = $('#horas_lunes');
var $Horario = $('#Horario');

function calculaHora() {
    if(!$FechaInicio.val() && !$FechaFin.val())
        return false;
    
    var dia_ini = moment($FechaInicio.val());
    var dia_fin = moment($FechaFin.val());
    if(dia_ini>dia_fin)
        return false
    var horas = 0;
    while(dia_fin>=dia_ini){
        // debugger
        switch (dia_ini.day()) {
            case 0:
                try {horas += $horas_domingo.val().length;} catch (error) {}
                break;
            case 1:
                try {horas += $horas_lunes.val().length;} catch (error) {}
                break;
            case 2:
                try {horas += $horas_martes.val().length;} catch (error) {}
                break;
            case 3:
                try {horas += $horas_miercoles.val().length;} catch (error) {}
                break;
            case 4:
                try {horas += $horas_jueves.val().length;} catch (error) {}
                break;
            case 5:
                try {horas += $horas_viernes.val().length;} catch (error) {}
                break;
            case 6:
                try {horas += $horas_sabado.val().length;} catch (error) {}
                break;
            default:
                break;
        }
        dia_ini.add('day', 1);
    }

    // Momments
    // Change HOURS
    $HorasProgramada.val(horas)
    
}

function validarVentana4() {
    var $listErr = [];
    if(!$Universidad.val() || $Universidad.val() == 0){
        $listErr.push($Universidad);
        md.showNotification( 'top','right', 'Seleccione la universidad', 'warning');
    }
    if(!$Facultad.val() || $Facultad.val() == 0){
        $listErr.push($Facultad);
        md.showNotification( 'top','right', 'Seleccione la facultad', 'warning');
    }
    if(!$Nivel.val()){
        $listErr.push($Nivel);
        md.showNotification( 'top','right', 'Escriba el nivel', 'warning');
    }
    if(!$Carrera.val()){
        $listErr.push($Carrera);
        md.showNotification( 'top','right', 'Digite el nombre de la carrera', 'warning');
    }
    if(!$Tutor.val()){
        $listErr.push($Tutor);
        md.showNotification( 'top','right', 'Escriba el nombre del tutor', 'warning');
    }
    addWarningsInput($listErr);
    setTimeout(() => {
        removeWarnings();
    }, 2000);
    return !( !$Universidad.val() || $Universidad.val() == 0 ||  !$Facultad.val() || $Facultad.val() == 0 ||
        !$Nivel.val() || !$Carrera.val() || !$Tutor.val()
    );
}

function validarVentana5() {   
    var $listErr = [];
    if(!$Departamento.val() || $Departamento.val() == 0){
        $listErr.push($Departamento);
        md.showNotification( 'top','right', 'Seleccione el Departamento', 'warning');
    }
    if(!$Unidad.val() || $Unidad.val() == 0){
        $listErr.push($Unidad);
        md.showNotification( 'top','right', 'Seleccione la Unidad', 'warning');
    }
    if(!$TutorBSPI.val() || $TutorBSPI.val() == 0){
        $listErr.push($TutorBSPI);
        md.showNotification( 'top','right', 'Seleccione el tutor BSPI', 'warning');
    }
    if(!$Proyecto.val()){
        $listErr.push($Proyecto);
        md.showNotification( 'top','right', 'Escriba el nombre del proyecto', 'warning');
    }
    if(!$chkActa.is(':checked')){
        $listErr.push($chkActa);
        md.showNotification( 'top','right', 'Debe marcar la opción de normativas', 'warning');
    }
    addWarningsInput($listErr);
    setTimeout(() => {
        removeWarnings();
    }, 2000);
    return !( !$Departamento.val() || $Departamento.val() == 0 ||  !$Unidad.val() || $Unidad.val() == 0 ||
        !$Proyecto.val() || !$chkActa.is(':checked') || !$Tutor.val() || $Tutor.val() == 0  || !$TutorBSPI.val() || $TutorBSPI.val() == 0
    );
}
function validarVentana6() {
    var $listErr = [];
    var dia_ini = moment($FechaInicio.val());
    var dia_fin = moment($FechaFin.val());
    if(!$HorasProgramada.val() || $HorasProgramada.val()<=0){
        $listErr.push($HorasProgramada);
        md.showNotification( 'top','right', 'Agregue horas programadas', 'warning');
    }
    if(!$FechaInicio.val() || !$FechaFin.val()){
        $listErr.push($FechaInicio);
        $listErr.push($FechaFin);
        md.showNotification( 'top','right', 'Seleccione la fecha de inicio y fin', 'warning');
    }
    if(dia_ini>dia_fin){
        $listErr.push($FechaInicio);
        $listErr.push($FechaFin);
        md.showNotification( 'top','right', 'Corrija las fechas', 'warning');
    }
    if(!$Horario.val()){
        $listErr.push($Horario);
        md.showNotification( 'top','right', 'Agregue un horario', 'warning');
    }
    addWarningsInput($listErr);
    setTimeout(() => {
        removeWarnings();
    }, 2000);
    return !(!$HorasProgramada.val() || $HorasProgramada.val()<=0 || !$FechaInicio.val() || !$FechaFin.val() || dia_ini>dia_fin || !$Horario.val());
}
async function pasaporte_existe(valor) {
    let result={};

    try {
        console.log(valor);
        result = await $.ajax({
            url: url_passpor_exist + '?pasaporte=' +valor,
            type: 'GET',
        });
    } catch (error) {
        console.log(error);
        return {
            exist : false
        };
    }

    return result;
}




/**
 * Validar cada Ventana
 */
async function validaVentana(){
    switch ($("#progressbar li.active").length) {
        // Ventana 1
        case 1:
            return true
        // Ventana 2
        case 2:
            // Retorna falso es inválido, true es válido
            return validarVentana2();
        // Ventana 3
        case 3:
            return validarVentana3();
        case 4:
            return validarVentana4();
        case 5:
            return validarVentana5();
        case 6:
            return validarVentana6();
        default:
            break;
    }
}


/**
 * Validar cada Ventana
 */
async function validaVentanaEditar(){
    switch ($("#progressbar li.active").length) {
        // Ventana 1
        case 1:
            return true
        // Ventana 2
        case 2:
            // Retorna falso es inválido, true es válido
            return validarVentanaTipoPractica();
        // Ventana 3
        case 3:
            return validarVentana3();
        case 4:
            return validarVentana4();
        case 5:
            return validarVentana5();
        case 6:
            return validarVentana6();
        default:
            break;
    }
}

/**
 * Validar cada Ventana
 */
async function validaVentanaCambiarPeriodo(){
    switch ($("#progressbar li.active").length) {
        // Ventana 1
        case 1:
            return validarVentana2SinPasaporte();
        // Ventana 2
        case 2:
            return validarVentana4();
        case 3:
            return validarVentana5();
        case 4:
            return validarVentana6();
        default:
            break;
    }
}

/**
 *  Remove warnings
 */

function removeWarnings() {
    $CodigoReferencia.parent().children('.error1').css({display:'none'});
    $apellidoMaterno.parent().children('.error1').css({display:'none'});
    $pasaporte_item.parent().children('.error1').css({display:'none'});
    $nombreSegundo.parent().children('.error1').css({display:'none'});
    $tipo_practica.parent().children('.error1').css({display:'none'});
    $pasatiempo.parent().children('.error1').css({display:'none'});
    $EstadoCivil.parent().children('.error1').css({display:'none'});
    $Direccion.parent().children('.error1').css({display:'none'});
    $Apellidos.parent().children('.error1').css({display:'none'});
    $Telefono.parent().children('.error1').css({display:'none'});
    $FechaNac.parent().children('.error1').css({display:'none'});
    $Nombres.parent().children('.error1').css({display:'none'});
    $celular.parent().children('.error1').css({display:'none'});
    $genero.parent().children('.error1').css({display:'none'});
    $Correo.parent().children('.error1').css({display:'none'});
    $Ciudad.parent().children('.error1').css({display:'none'});
    $Pais.parent().children('.error1').css({display:'none'});
    $Departamento.parent().children('.error1').css({display:'none'});

    $observacion.parent().children('.error1').css({display:'none'});
    $Proyecto.parent().children('.error1').css({display:'none'});
    $chkActa.parent().children('.error1').css({display:'none'});
    $Unidad.parent().children('.error1').css({display:'none'});

    $Universidad.parent().children('.error1').css({display:'none'});
    $Facultad.parent().children('.error1').css({display:'none'});
    $Carrera.parent().children('.error1').css({display:'none'});
    $Nivel.parent().children('.error1').css({display:'none'});
    $Tutor.parent().children('.error1').css({display:'none'});
    $TutorBSPI = $('#idtutor');
    $Departamento.parent().children('.error1').css({display:'none'});
    $observacion.parent().children('.error1').css({display:'none'});
    $Proyecto.parent().children('.error1').css({display:'none'});
    $chkActa.parent().children('.error1').css({display:'none'});
    $Unidad.parent().children('.error1').css({display:'none'});
    $HorasProgramada.parent().children('.error1').css({display:'none'});
    $FechaInicio.parent().children('.error1').css({display:'none'});
    $FechaFin.parent().children('.error1').css({display:'none'});
    $horas_miercoles.parent().children('.error1').css({display:'none'});
    $horas_domingo.parent().children('.error1').css({display:'none'});
    $horas_viernes.parent().children('.error1').css({display:'none'});
    $horas_sabado.parent().children('.error1').css({display:'none'});
    $horas_jueves.parent().children('.error1').css({display:'none'});
    $horas_martes.parent().children('.error1').css({display:'none'});
    $horas_lunes.parent().children('.error1').css({display:'none'});
    $Horario.parent().children('.error1').css({display:'none'});
}

function addWarningsInput(items = []){
    try {
        for (const item of items) {
            item.parent().children('.error1').css({display:'initial'})
        }
    } catch (error) {
        
    }
}

function crearVoluntario() {
    return validarVentana2SinPasaporte() && validarVentana4() && validarVentana5() && validarVentana6();
}

function cambiarPeriodoVoluntario() {
    return validarVentana2() && validarVentana3() && validarVentana4() && validarVentana5() && validarVentana6();
}

function requerido(query) {
    return $(query).val();
}

// validarVentanaTipoPractica n° 2 sin pasaporte
async function validarVentanaTipoPractica() {
    removeWarnings();
    
    if(!$tipo_practica.val()){
        addWarningsInput([$tipo_practica]);
    }
    setTimeout(() => {
        removeWarnings();
    }, 2000);
    // Si no existe pasa y si tiene un tipo de práctica pasa
    return $tipo_practica.val();
}

// Ventana n° 2 
async function validarVentana2() {
    removeWarnings();
    var existe = await pasaporte_existe($pasaporte_item.val());
    if(existe.exist){
        md.showNotification( 'top','right', 'El voluntario ya existe', 'warning');
        addWarningsInput([$pasaporte_item]);
    }
    if($pasaporte_item.val() === '' || $pasaporte_item.val().length <10){
        md.showNotification( 'top','right', 'Pasaporte no es válido', 'warning');
        addWarningsInput([$pasaporte_item]);
    }
    if(!$tipo_practica.val()){
        addWarningsInput([$tipo_practica]);
    }
    setTimeout(() => {
        removeWarnings();
    }, 2000);
    // Si no existe pasa y si tiene un tipo de práctica pasa
    return !existe.exist && $tipo_practica.val() &&  $pasaporte_item.val().length >=10
}

// Ventana n° 2
async function validarVentana2SinPasaporte() {
    removeWarnings();

    if(!$tipo_practica.val()){
        addWarningsInput([$tipo_practica]);
    }
    setTimeout(() => {
        removeWarnings();
    }, 2000);
    // Si tiene un tipo de práctica pasa
    return $tipo_practica.val();
}

function validarVentana3(){
    var $listErr = [];
    // Nombres
    if(!$Nombres.val()){
        $listErr.push($Nombres);
        md.showNotification( 'top','right', 'Ingrese el nombre', 'warning');
    }
    if(!$nombreSegundo.val()){
        $listErr.push($nombreSegundo);
        md.showNotification( 'top','right', 'Ingrese el segundo nombre', 'warning');
    }
    // Apellidos
    if(!$Apellidos.val()){
        $listErr.push($Apellidos);
        md.showNotification( 'top','right', 'Ingrese el primer apellido', 'warning');
    }
    if(!$apellidoMaterno.val()){
        $listErr.push($apellidoMaterno);
        md.showNotification( 'top','right', 'Ingrese el segundo apellido', 'warning');
    }
    // Género
    if(!$genero.val() || $genero.val() == 0){
        $listErr.push($genero);
        md.showNotification( 'top','right', 'Seleccione su género', 'warning');
    }
    // Dirección
    if(!$Direccion.val()){
        $listErr.push($Direccion);
        md.showNotification( 'top','right', 'Ingrese la dirección de su residencia actual', 'warning');
    }
    // Correo
    if(!emailreg.test($Correo.val())){
        $listErr.push($Correo);
        md.showNotification( 'top','right', 'Ingrese un correo electrónico válido', 'warning');
    }
    // Estado civil
    if(!$EstadoCivil.val() || $EstadoCivil.val() == 0){
        $listErr.push($EstadoCivil);
        md.showNotification( 'top','right', 'Seleccione el estado civil', 'warning');
    }
    // País
    if(!$Pais.val() || $Pais.val() == 0){
        $listErr.push($Pais);
        md.showNotification( 'top','right', 'Seleccione el país', 'warning');
    }
    // Ciudad
    if(!$Ciudad.val() || $Ciudad.val() == 0){
        $listErr.push($Ciudad);
        md.showNotification( 'top','right', 'Seleccione la ciudad', 'warning');
    }
    // Pasatiempo
    if(!$pasatiempo.val() || $pasatiempo.val() == 0){
        $listErr.push($pasatiempo);
        md.showNotification( 'top','right', 'Seleccione su pasatiempo', 'warning');
    }
    // Teléfono
    if($Telefono.val()){
        if(!soloNum.test($Telefono.val())){
            $listErr.push($Telefono);
            md.showNotification( 'top','right', 'Ingrese un número de teléfono válido', 'warning');
        }
    }
    // Celular
    if($celular.val()){
        if( !soloNum.test($celular.val()) ){
            $listErr.push($celular);
            md.showNotification( 'top','right', 'Ingrese un número de celular válido', 'warning');
        }
    }
    // Fecha nac
    if(!regexobjDate.test($FechaNac.val())){
        $listErr.push($FechaNac);
        md.showNotification( 'top','right', 'Fecha de nacimiento errónea', 'warning');
    }
    addWarningsInput($listErr);
    setTimeout(() => {
        removeWarnings();
    }, 2000);
    var bandTelf = false;
    if( $Telefono.val()){
        bandTelf = !soloNum.test($Telefono.val())
    }
    var bandCel = false;
    if( $celular.val()){
        bandCel = !soloNum.test($celular.val())
    }

    return !( !regexobjDate.test($FechaNac.val()) ||  !$Nombres.val() || !$nombreSegundo.val() || !emailreg.test($Correo.val()) || !$Apellidos.val() || !$apellidoMaterno.val() || (!$genero.val() || $genero.val() == 0) || (!$Pais.val() || $Pais.val() == 0) || 
        (!$Ciudad.val() || $Ciudad.val() == 0) || (!$pasatiempo.val() || $pasatiempo.val() == 0) ||  bandCel || bandTelf );
}

