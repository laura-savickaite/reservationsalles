<!-- Cette page affiche le nom du créateur, le titre de l’événement, la
description, l’heure de début et de fin. Pour savoir quel évènement afficher,
vous devez récupérer l’id de l’événement en utilisant la méthode get. (ex :
http://localhost/reservationsalles/evenement/?id=1) Seuls les personnes
connectées peuvent accéder aux événements. -->

<?php
session_start();

$connect = mysqli_connect('localhost', 'root', '', 'reservationsalles');
mysqli_set_charset($connect,"utf8");

if(!isset($_SESSION['login'])){
    header('Location:index.php');
}else {

    $queryReservation = mysqli_query($connect, "SELECT utilisateurs.login, utilisateurs.imgprofil, reservations.id, reservations.titre, reservations.debut, reservations.fin, reservations.type_activité, reservations.description, reservations.participants  FROM `utilisateurs` INNER JOIN reservations ON id_utilisateur=utilisateurs.id WHERE reservations.id = '".$_GET['val']."'");
    $fetchReservation = mysqli_fetch_assoc($queryReservation);
    var_dump($fetchReservation);
}


// S'ajouter à la liste des participants
if (isset($_POST['addurself'])){

    if($_SESSION['login']=$fetchReservation['login']) {
        @$loginEx = "Eh mais vous êtes le créateur, non ?";
        $queryLogin = mysqli_query($connect, "SELECT `participants` FROM `utilisateurs` WHERE `participants`= '".$fetchReservation['login']. "'"); 
        if(mysqli_num_rows($queryLogin)){
          @$partPre .= "Mais, il semblerait que vous participiez déjà.";
        }else {
              $queryAdd = mysqli_query($connect, "UPDATE `utilisateurs` SET `participants`='".$_SESSION['login']."' WHERE `id`= '".$fetchReservation['id']."'");  
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
    <title>Réservation || BookWithMe</title>
</head>
<body>
    <header>
        <section class="navbar">
            <a id="rose" href="index.php"><p>Index</p></a>
            <a id="bleu" href="profil.php"><p>Mon profil</p></a> 
            <a id="violet" href="planning.php"><p>Planning</p></a>
            <a id="jaune" href="reservation-form.php"><p>Add an event</p></a> 
            <form action="deconnexion.php" method="post">
                <button class="boutondeco" type="submit" name="deco">Deconnexion</button>
            </form>
        </section>
    </header>
    <main>
    <article id="bgbooks">
    <!-- HOVER EN COULEUR ADEQUATE -->
        <?php
        if ($fetchReservation['type_activité'] == "social"){?> 
            <style>.social  {background-color: #FFD3B4;
            }
            .social .tooltiptext {
                        visibility: hidden;
                        width: 120px;
                        background-color: #5D534A;
                        color: #FDFAF6;
                        text-align: center;
                        padding: 5px 0;
                        border-radius: 3px;
                        position: absolute;
                        z-index: 1;
                        }
    
            .social:hover .tooltiptext {
                visibility: visible;
                    }
            </style><?php;
        }elseif ($value['type_activité'] == "loisirs"){ ?>
            <style>.loisirs  {background-color: #FFAAA7;
                            }
                    .loisirs .tooltiptext {
                        visibility: hidden;
                        width: 120px;
                        background-color: #5D534A;
                        color: #FDFAF6;
                        text-align: center;
                        padding: 5px 0;
                        border-radius: 3px;
                        position: absolute;
                        z-index: 1;
                        }
    
                    .loisirs:hover .tooltiptext {
                        visibility: visible;
                            }</style><?php ;
        }elseif ($fetchReservation['type_activité'] == "scolaire"){ ?>
            <style>.scolaire  {background-color: #98DDCA;
            }
            .scolaire .tooltiptext {
                        visibility: hidden;
                        width: 120px;
                        background-color: #5D534A;
                        color: #FDFAF6;
                        text-align: center;
                        padding: 5px 0;
                        border-radius: 3px;
                        position: absolute;
                        z-index: 1;
                        }
    
            .scolaire:hover .tooltiptext {
                visibility: visible;
                    }
            </style><?php ;
        }elseif ($fetchReservation['type_activité'] == "sport"){ ?>
            <style>.sport  {background-color: #D5ECC2;
            }
            .sport .tooltiptext {
                        visibility: hidden;
                        width: 120px;
                        background-color: #5D534A;
                        color: #FDFAF6;
                        text-align: center;
                        padding: 5px 0;
                        border-radius: 3px;
                        position: absolute;
                        z-index: 1;
                        }
    
            .sport:hover .tooltiptext {
                visibility: visible;
                    }
            </style><?php;
        }elseif ($fetchReservation['type_activité'] == "festivites"){ ?>
            <style>.festivites  {background-color: #F6DFEB;
                }
            .festivites .tooltiptext {
                    visibility: hidden;
                    width: 100px;
                    background-color: #5D534A;
                    color: #FDFAF6;
                    text-align: center;
                    padding: 5px 0;
                    border-radius: 3px;
                    position: absolute;
                    z-index: 1;
                    }
    
            .festivites:hover .tooltiptext {
                visibility: visible;
                    }  
                </style><?php ;
                }
            ?>

        







        <section id="booksinfo">
            <h2><div class = <?php echo $value['type_activité']?>><?php echo $fetchReservation['titre']; ?></div></h2>
            <span>inscrit par <?php echo $fetchReservation['login']; ?> <img class="imgprofil" src="Uploads/<?php echo $fetchReservation['imgprofil']; ?>" alt="Profile picture" class='profil' width="50px" height="50px"></span>

            <div>
                <h3>Description de l'event</h3>
                <?php echo $fetchReservation['description']; ?>
            </div>

            <div>
                <div>
                    <p>Du</p>
                    <?php echo $fetchReservation['debut']; ?>
                </div>
                <div>
                    <p>Au</p>
                    <?php echo $fetchReservation['fin']; ?>
                </div>
            </div>

        </section>
        <section id="participants">
    
            <div id="cadre">
                <?php echo $fetchReservation['participants']; ?>
            </div>
                <span><p>Rejoignez <?php echo $fetchReservation['login']; ?> et 'add'ez-vous !</p></span>
            <form action="reservation.php" method="post">
                <button class="addurself" type="submit" name="addurself">Add yourself</button>
            </form>

        </section>

    </article>
    </main>
    <footer>
        
    </footer>
</body>
</html>