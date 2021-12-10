<?php

session_start();

$connect=mysqli_connect('localhost', 'root', '', 'reservationsalles');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil || UC</title>
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
            <a id="rose" href="index.php"><p>Index</p></a>
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

    </main>
    <footer>
        
    </footer>
</body>
</html>