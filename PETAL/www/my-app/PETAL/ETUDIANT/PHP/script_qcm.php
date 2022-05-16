<?php

    include_once('../../ALL/PHP/BDD.php');

    $num = $_SESSION['num'];
    $idQCM = $_GET['id'];

    //requête permettant de récupérer le nom du QCM
    $req2 = $pdo->prepare('SELECT nomQCM FROM qcm WHERE idQCM = :idQCM');
    $req2->execute(array('idQCM' => $idQCM));
    $nom = $req2->fetch();
    $nomQCM = $nom[0];


    //requête permettant de récupérer les questions du QCM et leurs réponses
    $req3 = $pdo->prepare('SELECT * FROM Question WHERE idQCM = :idQCM');
    $req3->execute(array('idQCM' => $idQCM));
    $question = $req3->fetchAll();


    //requête récupérant les bonnes reponses du QCM
    $req3 = $pdo->prepare('SELECT reponseALaQuestion FROM question WHERE idQCM = :idQCM');
    $req3->execute(array('idQCM' => $idQCM));
    $rep = $req3->fetchAll();

    $resultat = 0;


    //update sur repondeDeEtudiant lorsque une réponse a été cochée
    $req4 = $pdo->prepare('UPDATE reponsedeetudiant SET reponseChoisie = :rep WHERE num = :num AND idQuestion = :idQuestion');

    //Select sur repondeDeEtudiant pour savoir si une réponse à déjà était enregistré
    $req6 = $pdo->prepare('SELECT * FROM reponsedeetudiant WHERE num = :num AND idQuestion = :idQuestion');

    //Insert un etudiant avec son numero l'id de la question et sa réponse choisie pour la question, si le Select de $req6 retourne false 
    $req7 = $pdo->prepare('INSERT INTO reponsedeetudiant VALUES (:num, :idQuestion, :repChoisi)');

    for($i=1; $i<=count($question); $i++){
        if(isset($_POST["reponse".$i])){
            //on execute req6 qui va permettre de savoir si une réponse a déjà été enregistré pour cette réponse
            $req6->execute(array('num' => $num, 'idQuestion' => $question[$i-1][0]));
            $verif = $req6->fetch();

            //Si la réponse de l'étudiant n'a pas encore été enregistré pour la question alors on execute req7 qui va insérer sa réponse dans la bdd
            if($verif == false){
                $req7->execute(array('num' => $num, 'idQuestion' => $question[$i-1][0], 'repChoisi' => $_POST["reponse".$i]));
            }

            //Sinon on met à jour la réponse de l'étudiant
            else{
                $req4->execute(array('rep' => $_POST["reponse".$i], 'num' => $num, 'idQuestion' => $question[$i-1][0]));                
            }

            //vérification de la réponse 
            //incrémentation du résultat si réponse bonne
            if($rep[$i-1][0]== $_POST["reponse".$i]){
                $resultat++;
            }
        }
    }


    echo"
        <div>
            <a id='retour' href='../../ETUDIANT/HTML/accueil_etudiant.php'> Retour </a>
            <h1> ".$nomQCM." </h1>
            <output> ".$resultat." / ".count($question)." </output>
            <br/>

        </div>
        <br/>
    ";

    echo" 
    <br/>
    <br/>

    <form action='' method='post'>
    ";
    
    $n = 1;

    foreach($question as $row){
        echo"

        <div id=".$row[0].">
            <div id='intitule'>
                <span> Question ".$n." : </span>
                <span> ".$row[1]." </span>";
        if(!is_null($row[2])){
            echo"
                <img src='data:image;base64,".base64_encode($row[2])."'> </img>
                ";
        }

        echo"
            </div>
            <br/>
                <span id='rep'> Reponse ".$n." :</span>
                    <br/>                
                    <label>";


        $req6->execute(array('num' => $num, 'idQuestion' => $row[0])); // on prépare avec l'id utilisateur et l'id question
        $res = $req6->fetch();

        $reponseChoisieBdd = $res[2];
        if($res[2] != null){
            switch($res[2]){
                case 1:
                    echo"
                        <input type='radio' checked name=\"reponse".$n."\" value='1'/> ".$row[4]."
                        <br/>
                        <input type='radio' name=\"reponse".$n."\" value='2'/> ".$row[5]." 
                        <br/>
                        <input type='radio' name=\"reponse".$n."\" value='3'/> ".$row[6]." 
                        <br/>
                        </label>
                        </div>";
                    break;
                case 2:
                    echo"
                        <input type='radio' name=\"reponse".$n."\" value='1'/> ".$row[4]."
                        <br/>
                        <input type='radio' checked name=\"reponse".$n."\" value='2'/> ".$row[5]." 
                        <br/>
                        <input type='radio' name=\"reponse".$n."\" value='3'/> ".$row[6]." 
                        <br/>
                        </label>
                        </div>";
                    break;
                case 3:
                    echo"
                        <input type='radio' name=\"reponse".$n."\" value='1'/> ".$row[4]."
                        <br/>
                        <input type='radio' name=\"reponse".$n."\" value='2'/> ".$row[5]." 
                        <br/>
                        <input type='radio' checked name=\"reponse".$n."\" value='3'/> ".$row[6]." 
                        <br/>
                        </label>
                        </div>";
                    break;
            }
        }
        else {
            echo"
                <input type='radio' name=\"reponse".$n."\" value='1'/> ".$row[4]."
                <br/>
                <input type='radio' name=\"reponse".$n."\" value='2'/> ".$row[5]." 
                <br/>
                <input type='radio' name=\"reponse".$n."\" value='3'/> ".$row[6]." 
                <br/>
                </label>
                </div>";
        }

        $n++;
    }

    echo "
        <button type='submit' id='valider'>
            Valider
        </button>
        </form>
    </div>
    <br/>
    <br/>";
?>