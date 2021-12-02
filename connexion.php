<?php

session_start();

$connect=mysqli_connect('localhost', 'root', '', 'reservationsalles');

if(isset($_POST['connexion'])){

    $login=$_POST['login'];
    $mdp=$_POST['mdp'];

    $login=htmlentities(trim($login));
    $password=htmlentities(trim($password));


    $reqCoLogin=mysqli_query($connect, "SELECT `login` FROM `utilisateurs` WHERE `login` = '".$login."')");
    
        if(mysqli_num_rows($reqCoLogin)){
        $reqPassword = mysqli_query($connect, "SELECT `password` FROM `utilisateurs` WHERE `password`= '".$mdp. "'"); 
    
            if(mysqli_num_rows($reqPassword)){
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
    <title>Connexion || UC</title>
</head>
<body>
    <form action="inscription.php" method="post">

        <label for="name">Login: </label>
        <input type="text" name="login" id="login">

        <label for="name">Mot de passe: </label>
        <input type="password" name="mdp" id="mdp">



        <button type="submit" name="connexion">Log in</button>

    </form>
</body>
</html>