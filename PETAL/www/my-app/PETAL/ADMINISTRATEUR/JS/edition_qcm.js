function AjoutImageQCM() {
    var num=this.id;
    num.replace("bt","");
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
                    document.querySelector('#BtAjoutImage'+num).style.backgroundImage = 'url('+ content +')';
                    document.querySelector('#BtAjoutImage'+num).style.backgroundSize = 'cover';
                    const b64WithPrefix = reader.result;
                    document.querySelector('#b64Image'+num).value = b64WithPrefix.substring(b64WithPrefix.indexOf(',') + 1);
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
    output.setAttribute('id','out'+comp);
    question.appendChild(output);

    var label2=document.createElement('label');
    label2.innerHTML=" : ";
    question.appendChild(label2);

    var inputQ=document.createElement('input');
    inputQ.setAttribute('type','text');
    inputQ.setAttribute('name','question');
    inputQ.setAttribute('id','intitule'+comp);
    question.appendChild(inputQ);

    var button=document.createElement('button');
    button.setAttribute('onclick','AjoutImageQCM()');
    button.setAttribute('class','BtAjoutImage');
    button.setAttribute('id','bt'+comp);
    button.innerHTML="Ajout image";
    question.appendChild(button);

    var inputH=document.createElement('input');
    inputH.setAttribute('type','hidden');
    inputH.setAttribute('name','b64Image');
    inputH.setAttribute('id','b64Image'+comp);
    inputH.setAttribute('value','');
    question.appendChild(inputH);
    question.appendChild(document.createElement('br'));

    var reponse=document.createElement('div');
    reponse.setAttribute('id','reponses'+comp);

    var iRbRepon1=document.createElement('input');
    iRbRepon1.setAttribute('type','radio');
    iRbRepon1.setAttribute('name','reponse');
    iRbRepon1.setAttribute('id','reponseRB'+comp+'a');
    var iRepon1=document.createElement('input');
    iRepon1.setAttribute('type','text');
    iRepon1.setAttribute('name','reponse');
    iRepon1.setAttribute('id','reponse'+comp+'a');
    reponse.appendChild(iRbRepon1);
    reponse.appendChild(iRepon1);
    reponse.appendChild(document.createElement('br'));

    var iRbRepon2=document.createElement('input');
    iRbRepon2.setAttribute('type','radio');
    iRbRepon2.setAttribute('name','reponse');
    iRbRepon2.setAttribute('id','reponseRB'+comp+'b');
    var iRepon2=document.createElement('input');
    iRepon2.setAttribute('type','text');
    iRepon2.setAttribute('name','reponse');
    iRepon2.setAttribute('id','reponse'+comp+'b');
    reponse.appendChild(iRbRepon2);
    reponse.appendChild(iRepon2);
    reponse.appendChild(document.createElement('br'));

    var iRbRepon3=document.createElement('input');
    iRbRepon3.setAttribute('type','radio');
    iRbRepon3.setAttribute('name','reponse');
    iRbRepon3.setAttribute('id','reponseRB'+comp+'c');
    var iRepon3=document.createElement('input');
    iRepon3.setAttribute('type','text');
    iRepon3.setAttribute('name','reponse');
    iRepon3.setAttribute('id','reponse'+comp+'c');
    reponse.appendChild(iRbRepon3);
    reponse.appendChild(iRepon3);
    reponse.appendChild(document.createElement('br'));

    question.appendChild(reponse);
    document.getElementById('questions').appendChild(question);
    comp++;
}