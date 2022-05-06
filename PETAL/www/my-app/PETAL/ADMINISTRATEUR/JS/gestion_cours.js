function SupprimerCours() {
    let idList = [];
    const curId = document.querySelector('#session').value;
    document.querySelectorAll('.CB').forEach(function(elem) {
        // Pour chacune des checkboxs
        if(elem.checked){ // si elle est cochée
            let id = elem.parentElement.querySelector('#idCours').value;
            idList.push(id);
            elem.parentElement.remove();

        }
    });
    let jsonArray = JSON.stringify(idList);
    // Requete POST via AJAX
    $.post('../PHP/script_cours.php', {
        data: jsonArray
    });
}

function EditerCours() {
    let idList = [];
    document.querySelectorAll('.CB').forEach(function(elem) {
        // Pour chacune des checkboxs
        if(elem.checked){ // si elle est cochée
            let id = elem.parentElement.querySelector('#idCours').value;
            idList.push(id);
        }
    });

    if(idList.length === 1) {
        let id = idList[0];
        // Requete POST via AJAX
        window.location.replace("../HTML/edition_cours.php?id="+id);
    }
    else {
        AlertError("Vous ne pouvez pas modifier plus d'un Cours");
    }
}
function AjoutCours() {
    var nom=document.getElementById('matiere').value;
    window.location.replace("../HTML/edition_cours.php?matiere="+nom);
}