<?php

session_start();

require('bdd_connect.php');

@$login = $_SESSION['login'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet">
    <title>Index || BookWithMe</title>
    <link rel="shortcut icon" type="image/jpg" href="Images/planner.png"/>
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
        <span class = "titre"><h1 class="slideInLeft">BOOK</h1><p class="point">.</p><h1 class="fadeInDown">WITH</h1><p class="point1">.</p><h1 class ="fadeInRight">ME</h1></span>
        <p id = "txtdescri">An experimental little planner where everyone can plan their events. Book a room in order to arrange something and explore your potential. Check the schedule first, choose your ideal slot and book away! The others will be able to look into your event and maybe add themselves to it.</p>
    </main>
    <footer>
        <a href="https://github.com/laura-savickaite/reservationsalles"><img src="Images/github.png" alt="Profile picture" class='profil' width="30px">  </a>
    </footer>
</body>
</html>