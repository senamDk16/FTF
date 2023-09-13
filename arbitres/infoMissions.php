<?php
    if( !isset ($_GET['id'])){
        header('location:./listemissions.php');
    }

    include('./connexionData.php');
    $req = $pdo->prepare('SELECT * from missions where id_mission = ?');
    $req->execute(array($_GET['id']));
    $mission = $req->fetchAll();    


    $req1 = $pdo->prepare('SELECT id_arbitre, nom_prenoms FROM arbitres where id_arbitre = ?');
    $req1->execute(array($mission[0]['id_arbitre']));
    $arbitre = $req1->fetchAll();
?>

<?php include('./base.php'); ?>
    <div class="container">
        
        <div>

            <table> 
                <thead> 
                    <tr>  
                        <td>Date mission</td>  
                        <td>Team 1</td>  
                        <td>Team 2</td>  
                        <td>Commissaire</td>  
                        <td>Note</td>  
                        <td>Arbitre</td>   
                    </tr>
                </thead>
                <tbody> 
                    <tr>
                        <td><?= $mission[0]['date_mission'] ?></td>
                        <td><?= $mission[0]['team1'] ?></td>
                        <td><?= $mission[0]['team2'] ?></td>
                        <td><?= $mission[0]['commissaire'] ?></td>
                        <td><?= $mission[0]['note'] ?></td>
                        <td>  <a href="./infoArbitres.php?id=<?= $arbitre[0]['id_arbitre'] ?>"><?= $arbitre[0]['nom_prenoms'] ?></a>  </td>
                    </tr>
                </tbody>
            </table>

            <div >
              <h2>Commentaire</h2>
              <div>
                <p>
                  <?= $mission[0]['commentaire'] ?>
                </p>
              </div>
            </div>
        </div>
    </div>
</body>
</html>