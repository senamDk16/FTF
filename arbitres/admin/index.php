<?php
    session_start();
    include('./connexionData.php');

    if(isset($_POST['send'])){
        foreach($_POST as $key => $val){
            ${$key} = nl2br(htmlspecialchars($val));
        }

        $req = $pdo->prepare("SELECT * FROM admin WHERE username = ? and password = ?");
        $req->execute(array($username, $password));

        if($req->rowCount() == 0){
            $message =  'IDENTIFIANT INCORRECT';
        }
        else{
            $admin = $req->fetchAll();

            $_SESSION = [
                'id_admin' => $admin[0]['id_admin'],
                'username' => $admin[0]['username'],
                'password' => $admin[0]['password']
            ];

            header('location: ./homeAdmin.php');
        }
    }
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="./style/styleConnexion.css">
</head>
<body>
    <div class='container'>
        <div>
            <p class="error"><?= @$message ?></p>
        </div>
        <div class="container-fluid">
            <form action="" method="post">
                <div>
                    <label for="">Username</label>
                    <input type="text" name="username">
                </div>
                <div>
                    <label for="">Password</label>
                    <input type="password" name="password" >
                </div>
                <div>
                    <button type="submit" name="send">Connexion</button>
                </div>
            </form> 
        </div>
    </div>
</body>
</html>