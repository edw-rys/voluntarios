$CodigoReferencia = $('#CodigoReferencia');
$apellidoMaterno = $('#apellidoMaterno');
$nombreSegundo = $('#nombreSegundo');
$tipo_practica = $('#tipoPractica');
$pasaporte_item = $('#Pasaporte');
$EstadoCivil = $('#EstadoCivil');
$Direccion = $('#Direccion');
$Apellidos = $('#Apellidos');
$Telefono = $('#Telefono');
$Nombres = $('#Nombres');
$celular = $('#celular');
$genero = $('#genero');
$Correo = $('#Correo');
$Cuidad = $('#Cuidad');
$Pais = $('#Pais');

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
            break;
            // Ventana 3
        case 2:
           
            return validarVentana2();
            break;
        default:
            break;
    }
    
}

/**
 *  Remove warnings
 */

function removeWarnings() {
    $pasaporte_item.parent().children('.error1').css({display:'none'})
    $tipo_practica.parent().children('.error1').css({display:'none'})
    $tipo_practica.parent().children('.error1').css({display:'none'})
    $tipo_practica.parent().children('.error1').css({display:'none'})
    $tipo_practica.parent().children('.error1').css({display:'none'})
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
function validarVentana2() {
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

}