<?php
    include('./connexionData.php');

    $message = '';
    $req = $pdo->query('SELECT DISTINCT nom_prenoms, COUNT(id_arbitre) as nbre FROM arbitres');

    $totalElments = $req->fetchAll();
    $totalElmentsParPage = 100;
    $nbrePage = ceil($totalElments[0]['nbre'] / $totalElmentsParPage);

    if(isset($_GET['send1']) && isset($_GET['search'])){
        $search = $_GET['search'];  
        $req = $pdo->query("SELECT DISTINCT nom_prenoms, COUNT(id_arbitre) as nbre FROM arbitres WHERE nom_prenoms LIKE '%$search%' ");

        $totalElments = $req->fetchAll();
        $totalElmentsParPage = 100;
        $nbrePage = ceil($totalElments[0]['nbre'] / $totalElmentsParPage);

        if($req->rowCount() == 0){
            $message = "pas de resultat";
        }
        else{


            if(!isset($_GET['page'])){
                $_GET['page'] = '1';
                $page_now = $_GET['page'];
                $debut = ($page_now - 1 ) * $totalElmentsParPage;
                $req= $pdo->query(" SELECT DISTINCT nom_prenoms, id_arbitre, nom_prenoms, sexe, date_naissance FROM arbitres WHERE nom_prenoms LIKE '%$search%'  ORDER BY nom_prenoms LIMIT $debut , $totalElmentsParPage  ");
            }
            else{
                $page_now = $_GET['page'];
                $debut = ($page_now - 1 ) * $totalElmentsParPage;
                $req= $pdo->query("SELECT DISTINCT nom_prenoms, id_arbitre, nom_prenoms, sexe, date_naissance FROM arbitres WHERE nom_prenoms LIKE '%$search%'  ORDER BY nom_prenoms LIMIT $debut , $totalElmentsParPage  ");
            }
        }

    }
    else if(isset($_GET['page'])){
        $page_now = $_GET['page'];
        $debut = ($page_now - 1 ) * $totalElmentsParPage;
        $req = $pdo->query("SELECT DISTINCT nom_prenoms, id_arbitre, nom_prenoms, sexe, date_naissance FROM arbitres ORDER BY nom_prenoms LIMIT $debut , $totalElmentsParPage  ");

        if($req->rowCount() == 0){
            $_GET['page'] = '1';
            $page_now = $_GET['page'];
            $debut = ($page_now - 1 ) * $totalElmentsParPage;
            $req = $pdo->query("SELECT DISTINCT nom_prenoms, id_arbitre, nom_prenoms, sexe, date_naissance FROM arbitres ORDER BY nom_prenoms LIMIT $debut , $totalElmentsParPage  ");
        }
        
    }
    else{
        $_GET['page'] = '1';
        $page_now = $_GET['page'];
        $debut = ($page_now - 1 ) * $totalElmentsParPage;
        $req = $pdo->query("SELECT DISTINCT nom_prenoms, id_arbitre, nom_prenoms, sexe, date_naissance FROM arbitres ORDER BY nom_prenoms LIMIT $debut , $totalElmentsParPage  ");
    }




    $liste_arbitres = $req->fetchAll();
    
    //var_dump($liste_arbitres);
    
?>


<?php include('./base.php'); ?>

    <div class="content">

        <form action="" id='form-search'class='form-search'>
            <input type="search" name="search" id="search" class='search' placeholder='recherche' value= <?= @$_GET['search']?>>
            <button type="submit" name='send1'>Recherche</button>
            <?php
                if(isset($_GET['send1']) && isset($_GET['search'])){ ?>
                    <a href="?page=1"> <button>Retour</button> </a>
            <?php   
                 }
            ?>
        </form>
        <?php
            if($message === ''){ ?>
                <table>
                    <thead>
                        <tr>
                            <td>N</td>
                            <td>Nom Prenoms</td>
                            <td>Sexe</td>
                            <td>Date de naissance</td>
                            <td>Plus</td>
                        </tr>
                    </thead>
                    <tbody id='table'>
                        <?php
                            $num = 0;
                            foreach($liste_arbitres as $ab) : 
                                $num++?>
                                    <tr>
                                        <td> <?= $num ?> </td>
                                        <td><?= $ab['nom_prenoms'] ?></td>
                                        <td><?= $ab['sexe'] ?></td>
                                        <td><?= $ab['date_naissance'] ?></td>
                                        <td> <a href="./infoArbitres.php?id=<?= $ab['id_arbitre'] ?>">+</a></td>
                                    </tr>
                        <?php   
                            endforeach
                        ?>
                    </tbody>
                </table>
        <?php    }
            else{
                var_dump($message);
            }
        ?>
        

        <div>
            <?php 
                if(!isset($_GET['send1']) && isset($_GET['search'])){

                
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
        }
            else{
                for($i=1; $i<=$nbrePage; $i++){
                    if($page_now == $i){ ?>
                        <a> <button> <?= $i ?> </button> </a>
                    <?php
                    }

                    else{ ?>
                        <a href="?page=<?= $i ?>&search=<?= @$_GET['search'] ?>&send1="> <button><?= $i ?> </button> </a>
                <?php   }
                }
            }
            ?>
        </div>
    </div>