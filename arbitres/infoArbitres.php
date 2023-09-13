<?php
    if( !isset ($_GET['id'])){
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
                    <tr>
                        <td><?= $arbitre[0]['nom_prenoms'] ?></td>
                        <td><?= $arbitre[0]['sexe'] ?></td>
                        <td><?= $arbitre[0]['date_naissance'] ?></td>
                        <td><?= $arbitre[0]['anne_grade'] ?></td>
                        <td><?= $arbitre[0]['contact'] ?></td>
                        <td><?= $arbitre[0]['email'] ?></td>
                        <td><?= $arbitre[0]['grade'] ?></td>
                        <td><?= $arbitre[0]['region'] ?></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div>
            <h2 class='.title_table'>
                Le missions
            </h2>
          <table>
              <thead>
                  <tr>
                      <td>N</td>
                      <td>Date de mission</td>
                      <td>Team 1</td>
                      <td>Team 2</td>
                      <td>Plus</td>
                  </tr>
              </thead>
              <tbody id='table'>
                  <?php
                      $num = 0;
                      foreach($liste_missions as $ab) : 
                          $num++?>
                              <tr>
                                  <td> <?= $num ?> </td>
                                  <td><?= $ab['date_mission'] ?></td>
                                  <td><?= $ab['team1'] ?></td>
                                  <td><?= $ab['team2'] ?></td>
                                  <td> <a href="./infoMissions.php?id=<?= $ab['id_mission'] ?>">+</a></td>
                              </tr>
                  <?php   
                      endforeach
                  ?>
              </tbody>
          </table>
        </div>
    </div>