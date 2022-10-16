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
    // Comprobamos que hemos iniciado la session
    if (isset($_SESSION["email"]) && $_SESSION["role"] == "alum") {
        $bddcon = getBddConn();
        $fechaActual = date('Y-m-d');
        $dni = $_SESSION['dni'];
        // Creamos la sentencia sql
        $sql = "SELECT * FROM cursos WHERE Data_inici>'$fechaActual' and Actiu like 'si' and Codi NOT IN ( SELECT Codi_curs FROM matricula WHERE DNI_alum like '$dni') ORDER BY Data_inici ASC LIMIT 4";
        // Ejecutamos la sentencia
        $consulta = mysqli_query($bddcon, $sql);
        $numlines = mysqli_num_rows($consulta);
        // Generamos el contenido de la pagina
        displayMenuAlumn();
        echo "<h1 class='pageTitles'>Curosos recents</h1>";
        echo "<div class='cursos_panel'>";
        for ($i = 0; $i < $numlines; $i++) {
            $curs = mysqli_fetch_array($consulta);
            echo "<div class='curs'>
                    <div class='leftcolumn'>
                        <img class='cursLogo' src='" . $curs['Foto'] . "'>
                    </div>
                    <div class='rightcolumn'>
                        <h4 class='cursTitle'>" . $curs['Nom'] . "</h4>
                        <p class='cursDescription'>" . $curs['Descripcio'] . "</p>
                        <div class='cursbottomline'><img class='timeIcon' src='./img/time.svg'><p>" . $curs['Horres_durara'] . "h</p><a class='altaButton' href='matricular.php?codi=" . $curs['Codi'] . "'>Inscriure</a></div>
                    </div>
                </div>";
        }
        echo "</div>";
    } else {
        // Mostramos mensaje y redirigimos a la pagina de login en el caso de session no iniciada
        echo "<p>Has d'estar valiat per veure aquesta pàgina</p>";
        echo "<META HTTP-EQUIV='REFRESH' CONTENT='3;URL=index.php'>";
    }
    ?>
</body>

</html>