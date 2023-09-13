<?php
    include('./connexionData.php');

    $req = $pdo->query('SELECT COUNT(id_arbitre) as nbre FROM missions');

    $totalElments = $req->fetchAll();
    $totalElmentsParPage = 50;
    $nbrePage = ceil($totalElments[0]['nbre'] / $totalElmentsParPage);

    if(isset($_GET['page'])){
        $page_now = $_GET['page'];
        $debut = ($page_now - 1 ) * $totalElmentsParPage;
        $req = $pdo->query("SELECT id_mission, date_mission, team1, team2  FROM missions ORDER BY id_mission DESC LIMIT $debut , $totalElmentsParPage");
        if($req->rowCount() == 0){
            $_GET['page'] = '1';
            $page_now = $_GET['page'];
            $debut = ($page_now - 1 ) * $totalElmentsParPage;
            $req = $pdo->query("SELECT id_mission, date_mission, team1, team2  FROM missions ORDER BY id_mission DESC LIMIT $debut , $totalElmentsParPage");
        }
    }
    else{
        $_GET['page'] = '1';
        $page_now = $_GET['page'];
        $debut = ($page_now - 1 ) * $totalElmentsParPage;
        $req = $pdo->query("SELECT id_mission, date_mission, team1, team2  FROM missions ORDER BY id_mission DESC LIMIT $debut , $totalElmentsParPage");
    }




    $liste_missions = $req->fetchAll();
    
    //var_dump($liste_arbitres);
    
?>

<?php include('./base.php'); ?>
    <div class="content">
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

        <div>
            <?php 
                for($i=1; $i<=$nbrePage; $i++){ 
                    if($page_now == $i){
                        
                    ?>
                    <a > <button> <?= $i ?> </button> </a>
            <?php    
                }

                else{ ?>
                <a href="?page= <?= $i ?> "> <button> <?= $i ?> </button> </a>
            <?php   }
            }
            ?>
        </div>
    </div>

