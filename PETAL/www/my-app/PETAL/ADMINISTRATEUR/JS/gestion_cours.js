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
    $.post('../PHP/script_gestion_cours.php', {
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
        var nom=document.getElementById('matiere').value;
        // Requete POST via AJAX
        window.location.replace("../HTML/edition_cours.php?id="+id+"&matiere="+nom);
    }
    else if (idList.length > 1) {
        AlertError("Vous ne pouvez pas modifier plus d'un cours");
    } else {
        AlertError("Vous n'avez pas sélectionner de cours");
    }
}
function AjoutCours() {
    var nom=document.getElementById('matiere').value;
    window.location.replace("../HTML/edition_cours.php?matiere="+nom);
}