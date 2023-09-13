<?php 
    session_start();
    if(!isset($_SESSION['id_admin'])){
        header('location: ./index.php');
    }
?>

<?php
    include('./connexionData.php');
    if(!isset($_GET['id'])){
        header('location: ./listeArbitres.php');
    }

    $req = $pdo->query("SELECT * FROM arbitres WHERE id_arbitre = ".$_GET['id']);

    $arbitre = $req->fetchAll();
    if(isset($_POST['submit'])){

        foreach($_POST as $key => $val){
            ${$key} = $val;
        }

        if(isset($_GET['nom_prenoms'])){
            $sql = "UPDATE arbitres SET nom_prenoms = ? WHERE id_arbitre = ?";
            $req = $pdo->prepare($sql);
            $req->execute(array($nom_prenoms, $_GET['id']));
        }
        if(isset($_GET['sexe'])){
            $sql = "UPDATE arbitres SET sexe = ? WHERE id_arbitre =?";
            $req = $pdo->prepare($sql);
            $req->execute(array($sexe, $_GET['id']));
        }
        if(isset($_GET['date_naissance'])){
            $sql = "UPDATE arbitres SET date_naissance = ? WHERE id_arbitre =?";
            $req = $pdo->prepare($sql);
            $req->execute(array($date_naissance, $_GET['id']));
        }
        if(isset($_GET['anne_grade'])){
            $sql = "UPDATE arbitres SET anne_grade = ? WHERE id_arbitre =?";
            $req = $pdo->prepare($sql);
            $req->execute(array($anne_grade, $_GET['id']));
        }
        if(isset($_GET['contact'])){
            $sql = "UPDATE arbitres SET contact = ? WHERE id_arbitre =?";
            $req = $pdo->prepare($sql);
            $req->execute(array($contact, $_GET['id']));
        }
        if(isset($_GET['email'])){
            $sql = "UPDATE arbitres SET email = ? WHERE id_arbitre =?";
            $req = $pdo->prepare($sql);
            $req->execute(array($email, $_GET['id']));
        }
        if(isset($_GET['region'])){
            $sql = "UPDATE arbitres SET region = ? WHERE id_arbitre =?";
            $req = $pdo->prepare($sql);
            $req->execute(array($region, $_GET['id']));
        }
        if(isset($_GET['grade'])){
            $sql = "UPDATE arbitres SET grade = ? WHERE id_arbitre =?";
            $req = $pdo->prepare($sql);
            $req->execute(array($grade, $_GET['id']));                
        }   
        
        header('location: ./infoArbitres.php?id='.$_GET['id']);
    }

?>

<?php
    include('./base.php');
?>

<div class="container ">
        <h1>Modifier les informations Arbitres</h1>
        <form action="" method="post" id="form" class="form">
            <?php 
                if(isset($_GET['nom_prenoms'])) : ?>
                    <div class="row ">
                        <label class="label" for="">Nom Prenoms</label>
                        <input class="form-control" type="text" id="nom_prenoms" name="nom_prenoms" value=<?= $arbitre[0]['nom_prenoms']?>> 
                    </div>
            <?php
                 endif
            ?>


            <?php
                if(isset($_GET['sexe'])) : ?>
                    <div class="row ">
                        <label class="label" for="">Sexe</label>
                        <select name="sexe" id="sexe" class="form-select" aria-label="Default select example">
                            <option value="M">M</option>
                            <option value="F">F</option>
                        </select>
                    </div>
            <?php endif ?>

            <?php
                if(isset($_GET['date_naissance'])) : ?>
                    <div class="row ">
                        <label class="label" for="">Date de naissaince</label>
                        <input class="form-control" type="date" id="date_naissance" name="date_naissance" value=<?= $arbitre[0]['date_naissance']?>>
                    </div>                
            <?php endif ?>

            <?php
                if(isset($_GET['anne_grade'])) : ?>
                    <div class="row ">
                        <label class="label" for="">Annee de grade </label>
                        <input class="form-control" type="number" name="anne_grade" id="anne_grade" value=<?= $arbitre[0]['anne_grade']?>>
                    </div>                
            <?php endif ?>

            <?php
                if(isset($_GET['contact'])) : ?>
                    <div class="row ">
                        <label class="label" for="">Contact</label>
                        <input class="form-control" type="text" name="contact" id="contact" value=<?= $arbitre[0]['contact']?>>
                    </div>                
            <?php endif ?>

            <?php
                if(isset($_GET['email'])) : ?>
                    <div class="row ">
                        <label class="label" for="">Email</label>
                        <input class="form-control" type="email" name="email" id="email" value=<?= $arbitre[0]['email']?>>
                    </div>                
            <?php endif ?>

            <?php
                if(isset($_GET['grade'])) : ?>
                    <div class="row ">
                        <label class="label" for="">Grade</label>
                        <select name="grade" id="grade" class="form-select" aria-label="Default select example">
                            <option value="eleve">Eleve</option>
                            <option value="district">District</option>
                            <option value="ligue">Ligue</option>
                            <option value="federal">Federal</option>
                            <option value="fifa">FIFA</option>
                        </select>
                    </div>                
            <?php endif ?>

            <?php
                if(isset($_GET['region'])) : ?>
                    <div class="row ">
                        <label class="label" for="">Regions</label>
                        <select name="region" id="region" class="form-select" aria-label="Default select example">
                            <option value="maritime">Martime</option>
                            <option value="central">Central</option>
                            <option value="plateau">Plateau</option>
                            <option value="kara">Kara</option>
                            <option value="savane">Savane</option>
                        </select>
                    </div>                
            <?php endif ?>


            <div class="row ">
                <button class="form-control btn" type="submit" name='submit'> SUBMIT </button>
            </div>
        </form>
</div>