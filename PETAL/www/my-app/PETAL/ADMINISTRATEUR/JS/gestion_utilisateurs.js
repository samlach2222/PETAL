function SupprimerUtilisateurs() {

    let idList = [];

    document.querySelectorAll('.CB').forEach(function(elem) {
        // Pour chacune des checkboxs
        if(elem.checked){ // si elle est cochée
            let id = elem.parentElement.querySelector('#identifiant').value;
            let admin = elem.parentElement.querySelector('#administrateur').value;

            console.log(id);
            console.log(admin);

            idList.push(id);

            elem.parentElement.remove();
        }
    });

    let jsonArray = JSON.stringify(idList);

    console.log("test");

    $.post('../PHP/script_gestion_utilisateurs.php', {
        data: jsonArray
    });
}