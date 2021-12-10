<?php

session_start();

$connect=mysqli_connect('localhost', 'root', '', 'reservationsalles');

if (isset($_POST['connexion'])){

    $login=$_POST['login'];
    $mdp=$_POST['mdp'];
  
    $login=htmlentities(trim($login));
    $mdp=htmlentities(trim($mdp));

    $requestLogin = mysqli_query($connect, "SELECT `login` FROM `utilisateurs` WHERE `login`= '".$login. "'"); 

    if(mysqli_num_rows($requestLogin)){
    $requestPassword = mysqli_query($connect, "SELECT `password` FROM `utilisateurs` WHERE `password`= '".$mdp. "'"); 

        if(mysqli_num_rows($requestPassword)){
            $_SESSION['login']=$login;
            // header('Location:index.php');
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
    <title>Connexion || UC</title>
</head>
<body>
    <header>
        <?php 
        if(!isset($login)){ ?>

        <section class="navbar">
            <a href="inscription.php"><p>Sign in</p></a>
            <a href="connexion.php"><p>Log in</p></a>
            <a href="planning.php"><p>Planning</p></a>
        </section>
        <?php
        }else { ?>
        <section class="navbar">
            <a id="rose" href="profil.php"><p>Mon profil</p></a>
            <a id="bleu" href="planning.php"><p>Planning</p></a> 
            <a id="jaune" href="reservation-form.php"><p>Add an event</p></a> 
            <form action="deconnexion.php" method="post">
                <button class="boutondeco" type="submit" name="deco">Deconnexion</button>
            </form>
        </section>
        <?php
        }
        
        ?>
    </header>
    <main>
        <form action="connexion.php" method="post">

            <label for="name">Login: </label>
            <input type="text" name="login" id="loginn">

            <label for="name">Mot de passe: </label>
            <input type="password" name="mdp" id="mdp">



            <button type="submit" name="connexion">Log in</button>

        </form>
    </main>
</body>
</html>