<?php
        include('./connexionData.php');
   
        $req = $pdo->query("SELECT id_arbitre, nom_prenoms FROM `arbitres` ORDER BY nom_prenoms");

        $arbitres = $req->fetchAll();
?>
