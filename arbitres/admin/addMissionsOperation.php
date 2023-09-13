<?php

    try{

        include('./connexionData.php');
        // if(!array_key_exists('nom_prenoms', $_POST)){
        //     header('location:./addArbitres.html');
        // }

        foreach($_POST as $key=>$val){
            ${$key} = nl2br(htmlspecialchars($val)) ;
        }

        $req = $pdo->prepare("INSERT INTO `missions` (`id_mission`, `date_mission`, `team1`, `team2`, `commissaire`, `note`, `commentaire`, `id_arbitre`) 
                                VALUES (NULL, ?, ?, ?, ?, ?, ?, ?)");
        
        $req->execute(array($date_mission, $team1, $team2, $commissaire, $note, $commentaire, $id_arbitre));

        echo 'Enregistrement valide';

    }
    catch (Exception $e){
        echo $e->getMessage();
    }

    
?>
