<?php
    session_start();
    if(!isset($_SESSION['id_admin'])){
      header('location: ./index.php');
    }
?>
<?php 
  include('./base.php');
    include('./connexionData.php');
  function getNombre($option, $valeur){
    global $pdo;
    $req = $pdo->query("SELECT COUNT(id_arbitre) as nbre FROM arbitres WHERE `$option` = '$valeur'");
    //$req = $pdo->prepare("SELECT COUNT(id_arbitre) as nbre FROM arbitres WHERE `?` = '?'");
    //$req->execute(array($option, $valeur));
    $nbreTable = $req->fetchAll();
    $nbre = $nbreTable[0]['nbre'];
    return $nbre;
  }
?>

<div class='content'>
    <div>
      <p>
        Nombre de Gracon : <?=  getNombre('sexe', 'm') ?>
      </p>
    </div>
    <div>
      <p>
        Nombre de Fille : <?=  getNombre('sexe', 'f') ?>
      </p>
    </div>
    <div>
      <p>
        Nombre par Region :
      </p>
      <p>
        Region Maritime : <?=  getNombre('region', 'maritime') ?>
      </p>
      <p>
        Region Central : <?=  getNombre('region', 'central') ?>
      </p>
      <p>
        Region Plateau : <?=  getNombre('region', 'plateau') ?>
      </p>
      <p>
        Region Kara : <?=  getNombre('region', 'kara') ?>
      </p>
      <p>
        Region Savane : <?=  getNombre('region', 'savane') ?>
      </p>

    </div>
    <div>
      <p>
        Nombre par Grade : 
      </p>
      <p>
        Eleve : <?=  getNombre('grade', 'eleve') ?>
      </p>
      <p>
        District : <?=  getNombre('grade', 'district') ?>
      </p>
      <p>
        Ligue : <?=  getNombre('grade', 'ligue') ?>
      </p>
      <p>
        Federal : <?=  getNombre('grade', 'federal') ?>
      </p>
      <p>
        FIFA : <?=  getNombre('grade', 'fifa') ?>
      </p>
    </div>
</div>