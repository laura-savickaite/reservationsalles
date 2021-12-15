<?php
 
// $connect=mysqli_connect('localhost', 'root', '', 'reservationsalles');
$connect = mysqli_connect('localhost', 'laura_savickaite', 'heliosmapuce1997', 'laura-savickaite_reservationsalles');


if(!empty($_POST)){
    extract($_POST);
    $validation=true;
  }

  if(isset($_POST['inscription'])){
    
    $login=$_POST['login'];
    $password=$_POST['mdp'];
    $confpassword=$_POST['confmdp'];
    
    $login=htmlentities(trim($login));
    $password=htmlentities(trim($password));
    $confpassword=htmlentities(trim($confpassword));
      


    if (empty($login)) {
      $validation=false;
      @$loginErr .= "Ce champ est requis.";
    }
    else {
        
      $requestLogin = mysqli_query($connect, "SELECT `login` FROM `utilisateurs` WHERE `login`= '".$login. "'"); 
        if(mysqli_num_rows($requestLogin)){
          $validation=false;
          @$loginErr .= "Ce nom d'utilisateur est déjà pris.";
      }
    }

    
    if(empty($password)){
      $validation=false;
      @$passwordErr .= "Ce champ est requis";
    }
    elseif ($confpassword !== $password) {
      $validation=false;
      @$confpasswordErr .= "La confirmation ne correspond pas au mot de passe.";
    } 
    
  if ($validation){
  
    $requestInsert = mysqli_query($connect, "INSERT INTO `utilisateurs` (login, password) VALUES ('$login', '$password')"); 
    header('Location:connexion.php');
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
    <title>Inscription || BookWithMe</title>
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
        <form action="inscription.php" method="post">
          <div class="signin">
            <label for="name">Login: </label>
            <div class="inputsign"><input type="text" name="login" id="login"></div>
          </div>
          <div class="signin">
            <label for="name">Mot de passe: </label>
            <div class="inputsign"><input type="password" name="mdp" id="mdp"></div>
          </div>
          <div class="signin">
            <label for="name">Confirmation mot de passe: </label>
            <div class="inputsign"><input type="password" name="confmdp" id="confmdp"></div>
          </div>
      </div>
            <div id="inscrire"><button type="submit" name="inscription">Sign in</button></div>
        </form>
      
    </main>
</body>
</html>