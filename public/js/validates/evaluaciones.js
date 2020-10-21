function validarEvaluaciones() {
    var elements = document.querySelectorAll('.input-evaluate-field');
    if(!elements)return false;
    for (const element of elements) {
        element.classList.remove('border-danger');
        if(!element.value){
            element.classList.add('border-danger');
            md.showNotification( 'top','right', 'Campos incompletos', 'warning');
            return false;
        }
        if(element.value >=0 && element.value <= 100){
            continue;
        }else{
            element.classList.add('border-danger');
            md.showNotification( 'top','right', 'Valores incorrectos', 'warning');
            return false;
        }
    }
    if(!(document.getElementById('txtsi').checked || document.getElementById('txtno').checked)){
        md.showNotification( 'top','right', 'Marque una opción (si o no)', 'warning');
        return false;
    }
    return true
}