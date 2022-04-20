function SupprimerUtilisateurs() {
    document.querySelectorAll('.CB').forEach(function(elem) {
        // Pour chacune des checkboxs
        if(elem.checked){ // si elle est cochée
            elem.parentElement.remove();
        }
    });

}