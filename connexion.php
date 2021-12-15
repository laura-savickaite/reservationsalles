<?php

session_start();

// $connect=mysqli_connect('localhost', 'root', '', 'reservationsalles');
$connect = mysqli_connect('localhost', 'laura_savickaite', 'heliosmapuce1997', 'laura-savickaite_reservationsalles');

if (isset($_POST['connexion'])){

    $login=$_POST['login'];
    $mdp=$_POST['mdp'];
  
    $login=htmlentities(trim($login));
    $mdp=htmlentities(trim($mdp));

    $requestLogin = mysqli_query($connect, "SELECT `login` FROM `utilisateurs` WHERE `login`= '".$login. "'"); 

        //ces informations récoltées sont utilisées dans profil.php
        $repTest = mysqli_query($connect, "SELECT * FROM `utilisateurs` WHERE `login`= '".$login."'");
        $rTest = mysqli_fetch_all($repTest,MYSQLI_ASSOC);
        foreach ($rTest as $value){    
        $_SESSION['imgprofil']=$value ['imgprofil'];
        }

    if(mysqli_num_rows($requestLogin)){
    $requestPassword = mysqli_query($connect, "SELECT `password` FROM `utilisateurs` WHERE `password`= '".$mdp. "'"); 

        if(mysqli_num_rows($requestPassword)){
            $_SESSION['login']=$login;
            header('Location:index.php');
    }else {
        $logErr="Le mot de passe ou le login ne correspondent pas.";
    }
  } 
}

    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet">
    <title>Connexion || BookWithMe</title>
    <link rel="shortcut icon" type="image/jpg" href="Images/planner.png"/>
</head>
<body>
    <header>
        <section class="navbar">
            <a href="inscription.php"><p>Sign in</p></a>
            <a href="connexion.php"><p>Log in</p></a>
            <a href="planning.php"><p>Planning</p></a>
        </section>
    </header>
    <main>
        <div class="form">
            
            <form action="connexion.php" method="post">
                <div class="login">
                    <label for="name">Login: </label>
                    <div class="inputlog"><input type="text" name="login" id="loginn"></div>
                </div>
                
               <div class="login">
                    <label for="name">Mot de passe: </label>
                    <div class="inputlog"><input type="password" name="mdp" id="mdp"></div>    
                </div>
        </div>

            <div id="connexion"><button type="submit" name="connexion">Log in</button></div>

        </form>
    </main>
</body>
</html>