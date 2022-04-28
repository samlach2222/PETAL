function myFunction() {
    document.querySelectorAll('.input_matiere').forEach(function(elem) {
        // Pour chacune des checkboxs
        if(elem.checked){ // si elle est cochée
            elem.parentElement.remove();
        }
    });

}