<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus alumnes</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <?php
    include "functions.php";
    // Comprobamos que hemos iniciado la session
    if (isset($_SESSION["email"]) && $_SESSION["role"] == "prof") {
        $dni = $_SESSION['dni'];
        $bddcon = getBddConn();
        if ($_REQUEST['codi']) {
            $nomcurs = $_REQUEST['nomcurs'];
            $codi = $_REQUEST['codi'];
            displayMenuProf();
            echo "<h1 class='pageTitles'>Alumnes Curs " . $_REQUEST['nomcurs'] . "</h1><br><br>";
            // Creamos la sentencia sql
            $sql = "SELECT * FROM matricula WHERE Codi_curs like '$codi'";
            // Ejecutamos la sentencia
            $consulta = mysqli_query($bddcon, $sql);
            // Generamos la lista con en resultado de la consulta
            $numlines = mysqli_num_rows($consulta);
            if ($numlines == 0) {
                echo "<div class='noMatriculatsMsg' >Encara no tens alumnes matriculats</div>";
            }
            for ($i = 0; $i < $numlines; $i++) {
                $matricula = mysqli_fetch_assoc($consulta);
                $dnialum = $matricula['DNI_alum'];
                $nota = $matricula['nota'];
                $sql2 = "SELECT * FROM alumnes WHERE DNI like '$dnialum'";
                $consulta2 = mysqli_query($bddcon, $sql2);
                $alumne = mysqli_fetch_assoc($consulta2);
                echo "<div class='cursDisponible'>
                    <div class='leftContent'>
                        <img src='" . $alumne['Foto'] . "'>
                    </div>
                    <div class='rightContent'>
                        <div class='cursDispTitle'>" . $alumne['Nom'] . " " . $alumne['Cognoms'] . "</div>
                        <div class='cursDispRow'><img class='cursIcon' src='img/age.png'> &nbsp" . $alumne['Edat'] . "  </div>
                        <div class='cursDispRow'><img class='cursIcon' src='img/email.svg'> &nbsp" . $alumne['Mail'] . "  </div>
                        <div class='cursDispRow'><img class='cursIcon' src='img/dni.png'> &nbsp" . $alumne['DNI'] . "  </div>
                        <div class='cursDispRow'></div>
                    </div>
                </div>";
            }
        } else {
            echo "<p>no hem pogut obtenir el codi del curs.</p>";
            echo "<META HTTP-EQUIV='REFRESH' CONTENT='1.5;URL=cursos_prof.php'>";
        }
    } else {
        // Mostramos mensaje y redirigimos a la pagina de login en el caso de session no iniciada
        echo "<p>Has d'estar valiat per veure aquesta pàgina</p>";
        echo "<META HTTP-EQUIV='REFRESH' CONTENT='1.5;URL=index.php'>";
    }

    ?>

</body>

</html>