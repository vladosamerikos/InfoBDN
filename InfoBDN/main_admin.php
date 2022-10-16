<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Menu</title>
</head>

<body>
    <?php
    include "functions.php";
    $bddcon = getBddConn();
    // Comprobamos que hemos iniciado la session
    if (isset($_SESSION["email"]) && $_SESSION["role"] == "admin") {
        // Generamos el contenido de la pagina
        displayMenuAdmin();
    ?>
        <h2>Benvingut <?php echo $_SESSION["email"] ?></h2>
        <div class="custom_menu">
            <a class="custom_button" href="./cursos_admin.php">Administra cursos</a>
            <a class="custom_button" href="./profs_admin.php">Administra professors</a>
        </div>
    <?php
    } else {
        // Mostramos mensaje y redirigimos a la pagina de login en el caso de session no iniciada
        echo "<p>Has d'estar valiat per veure aquesta pàgina</p>";
        echo "<META HTTP-EQUIV='REFRESH' CONTENT='2;URL=index.php'>";
    }
    ?>


</body>

</html>