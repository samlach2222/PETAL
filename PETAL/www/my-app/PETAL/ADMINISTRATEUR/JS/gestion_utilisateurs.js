function SupprimerUtilisateurs() {
    let idList = [];
    document.querySelectorAll('.CB').forEach(function(elem) {
        // Pour chacune des checkboxs
        if(elem.checked){ // si elle est cochée
            let id = elem.parentElement.querySelector('#identifiant').value;
            idList.push(id);
            elem.parentElement.remove();
        }
    });
    let jsonArray = JSON.stringify(idList);
    // Requete POST via AJAX
    $.post('../PHP/script_gestion_utilisateurs.php', {
        data: jsonArray
    });
}

function EditerUtilisateur() {
    let idList = [];
    let adminList = [];
    document.querySelectorAll('.CB').forEach(function(elem) {
        // Pour chacune des checkboxs
        if(elem.checked){ // si elle est cochée
            let id = elem.parentElement.querySelector('#identifiant').value;
            let admin = elem.parentElement.querySelector('#administrateur').value;
            idList.push(id);
            adminList.push(admin);
        }
    });

    if(idList.length === 1 && adminList.length === 1) {
        let id = idList[0];
        let typeUtilisateur = adminList[0];

        if(typeUtilisateur == 1){ // si l'utilisateur est admin
            // Requete POST via AJAX
            $.post('../PHP/script_edition_admin.php', {
                data: id
            });
        }
        else {
            console.log("user");
            $.post('../PHP/script_edition_etudiant.php', {
                data: id
            });
        }
    }
    else {
        AlertError("Vous ne pouvez modifier plus d'un utilisateur");
    }
}