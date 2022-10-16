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
        $fechaActual = date('Y-m-d');
        if ($_POST) {
            displayMenuProf();
            echo "<h1 class='pageTitles'>Cursos Actius</h1>";
            displaySearchBarProfCursos();
            $nom = $_POST['search'];
            // Creamos la sentencia sql
            $sql = "SELECT * FROM cursos WHERE Actiu like 'si' and Data_final>'$fechaActual' and DNI_prof like '$dni' and Nom LIKE '%$nom%'";
            // Ejecutamos la sentencia
            $consulta = mysqli_query($bddcon, $sql);
            // Generamos la lista con en resultado de la consulta
            $numlines = mysqli_num_rows($consulta);
            for ($i = 0; $i < $numlines; $i++) {
                $curs = mysqli_fetch_assoc($consulta);
                $dniprof = $curs['DNI_prof'];
                $codi = $curs['Codi'];
                $sql2 = "SELECT * FROM matricula WHERE  Codi_curs like '$codi'";
                $consulta2 = mysqli_query($bddcon, $sql2);
                $numalumnes = mysqli_num_rows($consulta2);
                echo "<div class='cursDisponible'>
                    <div class='leftContent'>
                        <img src='" . $curs['Foto'] . "'>
                    </div>
                    <div class='rightContent'>
                        <div class=' cursDispTitle'>" . $curs['Nom'] . "</div>
                        <div class='cursDispRow cursDispDescrip'>" . $curs['Descripcio'] . "</div>
                        <div class='cursDispRow'><img class='cursIcon' src='img/alumne.svg'> " . $numalumnes . "</div>
                        <div class='cursDispRow'><div class='cursDispData'><img class='cursIcon dateIcon' src='img/data.svg'>" . $curs['Data_inici'] . "&nbsp<img class='cursIcon dateIcon' src='img/enddate.svg'>" . $curs['Data_final'] . "</div><div class='cursDispTime'> <img class='cursIcon' src='./img/time.svg'>" . $curs['Horres_durara'] . "</div></div>
                        <div class='cursDispRow buttonContainer'><a class='matricularButon' href='llistatalumnescurs_prof.php?codi=" . $curs['Codi'] . "&nomcurs=" . $curs['Nom'] . "'>Llistar alumnes</a></div>
                    </div>
                </div>";
            }
        } else {
            displayMenuProf();
            echo "<h1 class='pageTitles'>Cursos Actius</h1>";
            displaySearchBarProfCursos();
            // Creamos la sentencia sql 
            $sql = "SELECT * FROM cursos WHERE Actiu like 'si' and Data_final>'$fechaActual' and DNI_prof like '$dni'";
            // Ejecutamos la sentencia
            $consulta = mysqli_query($bddcon, $sql);
            // Generamos la lista con en resultado de la consulta
            $numlines = mysqli_num_rows($consulta);
            for ($i = 0; $i < $numlines; $i++) {
                $curs = mysqli_fetch_assoc($consulta);
                $dniprof = $curs['DNI_prof'];
                $codi = $curs['Codi'];
                $sql2 = "SELECT * FROM matricula WHERE  Codi_curs like '$codi'";
                $consulta2 = mysqli_query($bddcon, $sql2);
                $numalumnes = mysqli_num_rows($consulta2);
                echo "<div class='cursDisponible'>
                    <div class='leftContent'>
                        <img src='" . $curs['Foto'] . "'>
                    </div>
                    <div class='rightContent'>
                        <div class=' cursDispTitle'>" . $curs['Nom'] . "</div>
                        <div class='cursDispRow cursDispDescrip'>" . $curs['Descripcio'] . "</div>
                        <div class='cursDispRow'><img class='cursIcon' src='img/alumne.svg'> " . $numalumnes . "</div>
                        <div class='cursDispRow'><div class='cursDispData'><img class='cursIcon dateIcon' src='img/data.svg'>" . $curs['Data_inici'] . "&nbsp<img class='cursIcon dateIcon' src='img/enddate.svg'>" . $curs['Data_final'] . "</div><div class='cursDispTime'> <img class='cursIcon' src='./img/time.svg'>" . $curs['Horres_durara'] . "</div></div>
                        <div class='cursDispRow buttonContainer'><a class='matricularButon' href='llistatalumnescurs_prof.php?codi=" . $curs['Codi'] . "&nomcurs=" . $curs['Nom'] . "'>Llistar alumnes</a></div>
                    </div>
                </div>";
            }
        }
    } else {
        // Mostramos mensaje y redirigimos a la pagina de login en el caso de session no iniciada
        echo "<p>Has d'estar valiat per veure aquesta pàgina</p>";
        echo "<META HTTP-EQUIV='REFRESH' CONTENT='3;URL=login_admin.php'>";
    }

    ?>

</body>

</html>