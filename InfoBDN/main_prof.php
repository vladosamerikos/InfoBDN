<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Menu professor</title>
</head>
<body>
    <?php
        include "functions.php";
       // Comprobamos que hemos iniciado la session
       if (isset($_SESSION["email"]) && $_SESSION["role"]=="prof"){
        $bddcon= getBddConn();
        $fechaActual = date ( 'Y-m-d' );
        $dni = $_SESSION['dni'];
        // Generamos el contenido de la pagina
        displayMenuProf();
        ?>
        <h2>Benvingut <?php echo $_SESSION["email"]?></h2>
        <div class="custom_menu">
            <a class="custom_button" href="./alumnes_prof.php">Meus alumnes</a>
            <a class="custom_button" href="./notes_prof.php">Notes</a>
        </div>
        <?php

    }else{
        // Mostramos mensaje y redirigimos a la pagina de login en el caso de session no iniciada
        echo "<p>Has d'estar valiat per veure aquesta pàgina</p>";
        echo "<META HTTP-EQUIV='REFRESH' CONTENT='3;URL=index.php'>";
    }
    ?>    
</body>
</html>