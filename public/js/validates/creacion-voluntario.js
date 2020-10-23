var $CodigoReferencia = $('#CodigoReferencia');
var $apellidoMaterno = $('#apellidoMaterno');
var $pasaporte_item = $('#Pasaporte');
var $nombreSegundo = $('#nombreSegundo');
var $tipo_practica = $('#tipoPractica');
var $pasatiempo = $('#CodigoReferencia');
var $EstadoCivil = $('#EstadoCivil');
var $Direccion = $('#Direccion');
var $Apellidos = $('#Apellidos');
var $Telefono = $('#Telefono');
var $Nombres = $('#Nombres');
var $celular = $('#celular');
var $genero = $('#genero');
var $Correo = $('#Correo');
var $Cuidad = $('#Cuidad');
var $Pais = $('#Pais');
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
    $Nombres.parent().children('.error1').css({display:'none'});
    $celular.parent().children('.error1').css({display:'none'});
    $genero.parent().children('.error1').css({display:'none'});
    $Correo.parent().children('.error1').css({display:'none'});
    $Cuidad.parent().children('.error1').css({display:'none'});
    $Pais.parent().children('.error1').css({display:'none'});
}

function addWarningsInput(items = []){
    try {
        for (const item of items) {
            item.parent().children('.error1').css({display:'initial'})
        }
    } catch (error) {
        
    }
}

function crearVoluntario () {
    return false
}

function requerido(query) {
    return $(query).val();
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
    // Si no existe pasa y si tiene un tipo de práctica pasa
    return !existe.exist && $tipo_practica.val() &&  $pasaporte_item.val().length >=10
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
    if(!$Cuidad.val() || $Cuidad.val() == 0){
        $listErr.push($Cuidad);
        md.showNotification( 'top','right', 'Seleccione la ciudad', 'warning');
    }
    // Pasatiempo
    if(!$pasatiempo.val() || $pasatiempo.val() == 0){
        $pasatiempo.push($pasatiempo);
        md.showNotification( 'top','right', 'Seleccione su pasatiempo', 'warning');
    }
    // Teléfono
    if(!$Telefono.val() || !soloNum.test($Telefono.val()) || $Telefono.val().length < 10){
        $listErr.push($Telefono);
        md.showNotification( 'top','right', 'Ingrese un número de teléfono válido', 'warning');
    }
    // Celular
    if(!$celular.val() || !soloNum.test($celular.val()) || $celular.val().length < 10){
        $listErr.push($celular);
        md.showNotification( 'top','right', 'Ingrese un número de celular válido', 'warning');
    }
    addWarningsInput($listErr);
    return !(!$Nombres.val() || !$nombreSegundo.val() || !emailreg.test($Correo.val()) || !$Apellidos.val() || !$apellidoMaterno.val() || (!$genero.val() || $genero.val() == 0) || (!$Pais.val() || $Pais.val() == 0) || 
        (!$Cuidad.val() || $Cuidad.val() == 0) || (!$pasatiempo.val() || $pasatiempo.val() == 0) || (!$Telefono.val() || !soloNum.test($Telefono.val()) || $Telefono.val().length < 10) | (!$celular.val() || !soloNum.test($celular.val()) || $celular.val().length < 10));
}