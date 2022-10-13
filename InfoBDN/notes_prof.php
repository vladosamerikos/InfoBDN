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
    $fechaActual = date('Y-m-d');
    // Comprobamos que hemos iniciado la session
    if (isset($_SESSION["email"]) && $_SESSION["role"] == "prof") {
        $dni = $_SESSION['dni'];
        $bddcon = getBddConn();
        if ($_POST) {
            displayMenuProf();
            echo "<h1 class='pageTitles'>Notes</h1>";
            displaySearchBarProfNotes();
            $nom = $_POST['search'];
            // Creamos la sentencia sql
            $sql = "SELECT * FROM cursos WHERE Actiu like 'si' and '$fechaActual'>Data_final and DNI_prof like '$dni' and Nom LIKE '%$nom%'";
            // Ejecutamos la sentencia
            $consulta = mysqli_query($bddcon, $sql);
            // Generamos la lista con en resultado de la consulta
            $numlines = mysqli_num_rows($consulta);
            if ($numlines < 1) {
                echo "<div class='noCursFinalMsg'> Encara no tens cursos que han finalitzat</div>";
            } else {
                for ($i = 0; $i < $numlines; $i++) {
                    echo "<table class='cursTable'>";
                    $curs = mysqli_fetch_assoc($consulta);
                    $codiCurs = $curs['Codi'];
                    $nomCurs = $curs['Nom'];
                    $sql2 = "SELECT * FROM matricula WHERE Codi_curs like '$codiCurs'";
                    $consulta2 = mysqli_query($bddcon, $sql2);
                    $numlines2 = mysqli_num_rows($consulta2);
                    echo "<tr><th class='cursTitle' colspan='5'>Curs: " . $nomCurs . "</th></tr>";
                    echo "<tr>
                            <th>Nom</th>
                            <th>Cognom</th>
                            <th>Foto</th>
                            <th>Nota</th>
                            <th></th>
                            </tr>";
                    for ($a = 0; $a < $numlines2; $a++) {
                        $matricula = mysqli_fetch_assoc($consulta2);
                        $dniAlu = $matricula['DNI_alum'];
                        $sql3 = "SELECT * FROM alumnes WHERE dni like '$dniAlu'";
                        $consulta3 = mysqli_query($bddcon, $sql3);
                        $alumne = mysqli_fetch_assoc($consulta3);
                        $sql4 = "SELECT * FROM matricula WHERE DNI_alum like '$dniAlu' and Codi_curs like '$codiCurs'";
                        $consulta4 = mysqli_query($bddcon, $sql4);
                        $alumneConNota = mysqli_fetch_assoc($consulta4);
                        echo "<tr>
                                <td>" . $alumne['Nom'] . "</td>
                                <td>" . $alumne['Cognoms'] . "</td>
                                <td><img class='profile_foto' src='" . $alumne['Foto'] . "'></td>
                                <td>" . $alumneConNota['nota'] . "</td>
                                <td><a href='editnota_prof.php?dni=" . $alumne['DNI'] . "&codi=" . $codiCurs . "'><img src='./img/editnota.svg'></a></td>
                            </tr>";
                    }
                    echo "</table>";
                }
            }
        } else {
            displayMenuProf();
            echo "<h1 class='pageTitles'>Notes</h1>";
            displaySearchBarProfNotes();
            // Creamos la sentencia sql
            $sql = "SELECT * FROM cursos WHERE Actiu like 'si' and Data_final<'$fechaActual' and DNI_prof like '$dni'";
            // Ejecutamos la sentencia
            $consulta = mysqli_query($bddcon, $sql);
            // Generamos la lista con en resultado de la consulta
            $numlines = mysqli_num_rows($consulta);
            if ($numlines < 1) {
                echo "<div class='noCursFinalMsg'> Encara no tens cursos que han finalitzat</div>";
            } else {
                for ($i = 0; $i < $numlines; $i++) {
                    echo "<table class='cursTable'>";
                    $curs = mysqli_fetch_assoc($consulta);
                    $codiCurs = $curs['Codi'];
                    $nomCurs = $curs['Nom'];
                    $sql2 = "SELECT * FROM matricula WHERE Codi_curs like '$codiCurs'";
                    $consulta2 = mysqli_query($bddcon, $sql2);
                    $numlines2 = mysqli_num_rows($consulta2);
                    echo "<tr><th class='cursTitle' colspan='5'>Curs: " . $nomCurs . "</th></tr>";
                    echo "<tr>
                            <th>Nom</th>
                            <th>Cognom</th>
                            <th>Foto</th>
                            <th>Nota</th>
                            <th></th>
                            </tr>";
                    for ($a = 0; $a < $numlines2; $a++) {
                        $matricula = mysqli_fetch_assoc($consulta2);
                        $dniAlu = $matricula['DNI_alum'];
                        $sql3 = "SELECT * FROM alumnes WHERE dni like '$dniAlu'";
                        $consulta3 = mysqli_query($bddcon, $sql3);
                        $alumne = mysqli_fetch_assoc($consulta3);
                        $sql4 = "SELECT * FROM matricula WHERE DNI_alum like '$dniAlu' and Codi_curs like '$codiCurs'";
                        $consulta4 = mysqli_query($bddcon, $sql4);
                        $alumneConNota = mysqli_fetch_assoc($consulta4);
                        echo "<tr>
                                <td>" . $alumne['Nom'] . "</td>
                                <td>" . $alumne['Cognoms'] . "</td>
                                <td><img class='profile_foto' src='" . $alumne['Foto'] . "'></td>
                                <td>" . $alumneConNota['nota'] . "</td>
                                <td><a href='editnota_prof.php?dni=" . $alumne['DNI'] . "&codi=" . $codiCurs . "'><img src='./img/editnota.svg'></a></td>
                            </tr>";
                    }
                    echo "</table>";
                }
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