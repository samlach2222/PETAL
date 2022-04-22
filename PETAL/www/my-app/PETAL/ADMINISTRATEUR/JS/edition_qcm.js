function AjoutImageProfil() {
    var input = document.createElement('input');
    input.type = 'file';
    input.onchange = e => {
        // Récuparation de la réference du fichier
        const file = e.target.files[0];

        // Check size
        const fsize = file.size;
        if (fsize > 8 * 1000000) { // 8 Mb max size
            window.alert('Veuillez utiliser des images de moins de 8Mo');
        } else {
            if(file && file['type'].split('/')[0] === 'image'){ // si le fichier est une image
                // Création du lecteur
                const reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = readerEvent => {
                    const content = readerEvent.target.result;
                    document.querySelector('.BtAjoutImage').style.backgroundImage = 'url('+ content +')';
                    document.querySelector('.BtAjoutImage').style.backgroundSize = 'cover';
                    const b64WithPrefix = reader.result;
                    document.querySelector('#b64Image').value = b64WithPrefix.substring(b64WithPrefix.indexOf(',') + 1);
                }
            }
            else {
                window.alert("Veuillez choisir un fichier valide");
            }
        }
    }
    input.click();
}
var comp=2;
function ajoutQuestion() {
    var question=document.createElement('div');
    question.setAttribute('class','question');

    var label1=document.createElement('label');
    label1.innerHTML="Question";
    question.appendChild(label1);

    var output=document.createElement('output');
    output.innerHTML=comp;
    comp++;
    question.appendChild(output);

    var label2=document.createElement('label');
    label2.innerHTML=" : ";
    question.appendChild(label2);

    var inputQ=document.createElement('input');
    inputQ.setAttribute('type','text');
    inputQ.setAttribute('name','question');
    question.appendChild(inputQ);

    var button=document.createElement('button');
    button.setAttribute('onclick','AjoutImageQCM()');
    button.setAttribute('class','BtAjoutImage');
    button.innerHTML="Ajout image";
    question.appendChild(button);

    var inputH=document.createElement('input');
    inputH.setAttribute('type','hidden');
    inputH.setAttribute('name','b64Image');
    inputH.setAttribute('id','b64Image');
    inputH.setAttribute('value','');
    question.appendChild(inputH);
    question.appendChild(document.createElement('br'));

    var reponse=document.createElement('div');
    reponse.setAttribute('id','reponses');

    var iRbRepon1=document.createElement('input');
    iRbRepon1.setAttribute('type','radio');
    iRbRepon1.setAttribute('name','reponse1');
    var iRepon1=document.createElement('input');
    iRepon1.setAttribute('type','text');
    iRepon1.setAttribute('name','reponse1');
    reponse.appendChild(iRbRepon1);
    reponse.appendChild(iRepon1);
    reponse.appendChild(document.createElement('br'));

    var iRbRepon2=document.createElement('input');
    iRbRepon2.setAttribute('type','radio');
    iRbRepon2.setAttribute('name','reponse2');
    var iRepon2=document.createElement('input');
    iRepon2.setAttribute('type','text');
    iRepon2.setAttribute('name','reponse2');
    reponse.appendChild(iRbRepon2);
    reponse.appendChild(iRepon2);
    reponse.appendChild(document.createElement('br'));

    var iRbRepon3=document.createElement('input');
    iRbRepon3.setAttribute('type','radio');
    iRbRepon3.setAttribute('name','reponse3');
    var iRepon3=document.createElement('input');
    iRepon3.setAttribute('type','text');
    iRepon3.setAttribute('name','reponse3');
    reponse.appendChild(iRbRepon3);
    reponse.appendChild(iRepon3);
    reponse.appendChild(document.createElement('br'));

    question.appendChild(reponse);
    document.getElementById('formQCM').appendChild(question);
}
