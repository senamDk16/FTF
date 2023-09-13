<?php

    try{

        include('./connexionData.php');
        // if(!array_key_exists('nom_prenoms', $_POST)){
        //     header('location:./addArbitres.html');
        // }

        foreach($_POST as $key=>$val){
            ${$key} = nl2br(htmlspecialchars($val)) ;
        }

        $req = $pdo->prepare("INSERT INTO `arbitres` (`id_arbitre`, `nom_prenoms`, `sexe`, `date_naissance`, `anne_grade`, `contact`, `email`, `grade`, `region`) 
                                VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?)");
        
        $req->execute(array($nom_prenoms, $sexe, $date_naissance, $anne_grade, $contact, $email, $grade, $region));

        echo 'Enregistrement valide';

    }
    catch (Exception $e){
        echo $e->getMessage();
    }

    
?>
