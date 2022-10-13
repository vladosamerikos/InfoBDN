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
        if ($_POST) {
            displayMenuProf();
            echo "<h1 class='pageTitles'>Alumnes</h1>";
            displaySearchBarProfAlumnes();
            $nom = $_POST['search'];
            // Creamos la sentencia sql
            $sql = "SELECT * FROM cursos WHERE Actiu like 'si' and DNI_prof like '$dni' and Nom LIKE '%$nom%'";
            // Ejecutamos la sentencia
            $consulta = mysqli_query($bddcon, $sql);
            // Generamos la lista con en resultado de la consulta
            $numlines = mysqli_num_rows($consulta);
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
                    <th>Edat</th>
                    <th>Foto</th>
                    <th>Email</th>
                    </tr>";
                if ($numlines2 < 1) {
                    echo "<tr><td class='noMatriculatsMsg' colspan='5'>Encara no tens alumnes matriculats</td></tr>";
                } else {
                    for ($a = 0; $a < $numlines2; $a++) {
                        $matricula = mysqli_fetch_assoc($consulta2);
                        $dniAlu = $matricula['DNI_alum'];
                        $sql3 = "SELECT * FROM alumnes WHERE dni like '$dniAlu'";
                        $consulta3 = mysqli_query($bddcon, $sql3);
                        $alumne = mysqli_fetch_assoc($consulta3);
                        echo "<tr>
                                <td>" . $alumne['Nom'] . "</td>
                                <td>" . $alumne['Cognoms'] . "</td>
                                <td>" . $alumne['Edat'] . "</td>
                                <td><img class='profile_foto' src='" . $alumne['Foto'] . "'></td>
                                <td>" . $alumne['Mail'] . "</td>
                            </tr>";
                    }
                }
                echo "</table>";
            }
        } else {
            displayMenuProf();
            echo "<h1 class='pageTitles'>Alumnes</h1>";
            displaySearchBarProfAlumnes();
            // Creamos la sentencia sql
            $sql = "SELECT * FROM cursos WHERE Actiu like 'si' and DNI_prof like '$dni'";
            // Ejecutamos la sentencia
            $consulta = mysqli_query($bddcon, $sql);
            // Generamos la lista con en resultado de la consulta
            $numlines = mysqli_num_rows($consulta);
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
                        <th>Edat</th>
                        <th>Foto</th>
                        <th>Email</th>
                        </tr>";
                if ($numlines2 < 1) {
                    echo "<tr><td class='noMatriculatsMsg' colspan='5'>Encara no tens alumnes matriculats</td></tr>";
                } else {
                    for ($a = 0; $a < $numlines2; $a++) {
                        $matricula = mysqli_fetch_assoc($consulta2);
                        $dniAlu = $matricula['DNI_alum'];
                        $sql3 = "SELECT * FROM alumnes WHERE dni like '$dniAlu'";
                        $consulta3 = mysqli_query($bddcon, $sql3);
                        $alumne = mysqli_fetch_assoc($consulta3);
                        echo "<tr>
                                <td>" . $alumne['Nom'] . "</td>
                                <td>" . $alumne['Cognoms'] . "</td>
                                <td>" . $alumne['Edat'] . "</td>
                                <td><img class='profile_foto' src='" . $alumne['Foto'] . "'></td>
                                <td>" . $alumne['Mail'] . "</td>
                            </tr>";
                    }
                }
                echo "</table>";
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