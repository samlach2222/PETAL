<?php 
	$num = $_SESSION['num'];

	$req = $pdo->prepare('SELECT nomMatiere FROM EtuMatiere WHERE num = :num');
    $req->execute(array('num' => $num));
    $matiere = $req->fetchAll();
    
    $req2 = $pdo->prepare('SELECT nomMatiere, moyenne FROM moyenneEtuMatiere WHERE num = :num');
    $req2->execute(array('num' => $num));
    $notes = $req2->fetchAll();


    //fonction permettant de dire si la matière a été validé selon la moyenne
    function mention($note){
        if($note < 10)
            return "non validé";
        else
            return "validé";
    }

    echo"
	    <div id='tabNote'>
	        <ul> <li>Detail des Cours :</li></ul>
	            <table id='tableau'>
	                <tr id='en-tete'>
	                    <td>
	                        <p> Cours </p>
	                    </td>
	                    <td>
	                        <p>  Note </p>
	                    </td>
	                    <td>
	                        <p>  Mention </p>
	                    </td>
	                </tr>          
    ";

	for($i=0; $i<count($matiere); $i++){
		for($j=0; $j<count($notes); $j++){
			if($matiere[$i][0] == $notes[$j][0]){
				$moyenne[$i] = str_replace('.',',',$notes[$j][1]).'/20,00';
				$mention[$i] = mention($notes[$j][1]);
			}
			else{
				$moyenne[$i] = "/";
				$mention[$i] = "/";
			}
		
		}
		echo"
			<tr>
                <td>
                    <output id='nameCours'> ".$matiere[$i][0]." </output>
                </td>
                <td>
                    <output id='note'> ".$moyenne[$i]."</output>
                </td>
                <td>
                    <output id='mention'> ".$mention[$i]." </output>
                </td>
            </tr>
		";
	}

	echo"
			</table>

        </div>
	";
        
?>