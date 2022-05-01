function SupprimerUtilisateurs() {
    let idList = [];
    const curId = document.querySelector('#session').value;
    document.querySelectorAll('.CB').forEach(function(elem) {
        // Pour chacune des checkboxs
        if(elem.checked){ // si elle est cochée
            let id = elem.parentElement.querySelector('#identifiant').value;
            if(id === curId){
                AlertError("Vous ne pouvez pas supprimer l'utilisateur actuel");
            }
            else {
                idList.push(id);
                elem.parentElement.remove();
            }
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
    const curId = document.querySelector('#session').value;
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

        if(id === curId){
            AlertError("Vous ne pouvez pas modifier l'utilisateur actuel");
        }
        else {
            if(typeUtilisateur == 1){ // si l'utilisateur est admin (/!\ == et non pas ===)
                window.location.replace("../HTML/edition_admin.php?id=" + id);
            }
            else {
                window.location.replace("../HTML/edition_etudiant.php?id=" + id);
            }
        }
    }
    else if(idList.length > 1 && adminList.length > 1) {
        AlertError("Vous ne pouvez pas modifier plus d'un utilisateur");
    }
}