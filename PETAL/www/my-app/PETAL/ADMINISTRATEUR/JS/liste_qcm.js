function SupprimerQCM() {
    let idList = [];
    const curId = document.querySelector('#session').value;
    document.querySelectorAll('.CB').forEach(function(elem) {
        // Pour chacune des checkboxs
        if(elem.checked){ // si elle est cochée
            let id = elem.parentElement.querySelector('#identifiant').value;
            if(id === curId){
                AlertError("Vous ne pouvez pas supprimer le qcm actuel");
            }
            else {
                idList.push(id);
                elem.parentElement.remove();
            }
        }
    });
    let jsonArray = JSON.stringify(idList);
    // Requete POST via AJAX
    $.post('../PHP/script_liste_qcm.php', {
        data: jsonArray
    });
}

function EditerQCM() {
    let idList = [];
    document.querySelectorAll('.CB').forEach(function(elem) {
        // Pour chacune des checkboxs
        if(elem.checked){ // si elle est cochée
            let id = elem.parentElement.querySelector('#identifiant').value;
            idList.push(id);
        }
    });

    if(idList.length === 1) {
        let id = idList[0];
        // Requete POST via AJAX
        console.log("qcm");
        $.post('../PHP/script_edition_qcm.php', {
            data: id
        });
    }
    else {
        AlertError("Vous ne pouvez pas modifier plus d'un qcm");
    }
}