<?php
    session_start();
    if(!isset($_SESSION['id_admin'])){
        header('location: ./index.php');
    }
?>
<?php
    if(!isset ($_GET['id'])){
        header('location:./listeArbitres.php');
    }

    include('./connexionData.php');
    $req = $pdo->prepare('SELECT * from arbitres where id_arbitre = ?');
    $req->execute(array($_GET['id']));

    $arbitre = $req->fetchAll();

    $req1 = $pdo->prepare('SELECT * FROM missions WHERE id_arbitre = ? ');
    $req1->execute(array($_GET['id']));

    $liste_missions = $req1->fetchAll();
?>
<?php include('./base.php') ?>
    <div class="container">
        <div>
            <table> 
                <thead> 
                    <tr>  
                        <td>Nom Prenoms</td>  
                        <td>Sexe</td>  
                        <td>Date de naissance</td>  
                        <td>Annee de grade</td>  
                        <td>Contact</td>  
                        <td>Email</td>  
                        <td>Grade</td>  
                        <td>Region</td>  
                    </tr>
                </thead>
                <tbody> 
                    <form action="./modifierArbitre.php">
                        <tr>
                            <input type="hidden" name='id' value=<?= $_GET['id']?> >
                            <td>
                                <?= $arbitre[0]['nom_prenoms'] ?> 
                                <input type="checkbox" name="nom_prenoms">
                            </td>
                            <td>
                                <?= $arbitre[0]['sexe'] ?>
                                <input type="checkbox" name="sexe">
                            </td>
                            <td>
                                <?= $arbitre[0]['date_naissance'] ?>
                                <input type="checkbox" name="date_naissance">
                            </td>
                            <td>
                                <?= $arbitre[0]['anne_grade'] ?>
                                <input type="checkbox" name="anne_grade">
                            </td>
                            <td>
                                <?= $arbitre[0]['contact'] ?>
                                <input type="checkbox" name="contact">
                            </td>
                            <td>
                                <?= $arbitre[0]['email'] ?>
                                <input type="checkbox" name="email">
                            </td>
                            <td>
                                <?= $arbitre[0]['grade'] ?>
                                <input type="checkbox" name="grade">
                            </td>
                            <td>
                                <?= $arbitre[0]['region'] ?>
                                <input type="checkbox" name="region">
                            </td>
                        </tr>
                        <button type="submit">Modifier</button>
                    </form>
                </tbody>
            </table>
        </div>
    </div>