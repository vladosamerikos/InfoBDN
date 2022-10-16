<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cursos</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    include "functions.php";
    $bddcon = getBddConn();
    // Comprobamos que hemos iniciado la session
    if (isset($_SESSION["email"]) && $_SESSION["role"] == "admin") {
        if ($_POST) {
            displayMenuAdmin();
            $nom = $_POST['search'];
            // Creamos la sentencia sql
            $sql = "SELECT * FROM cursos WHERE Nom LIKE '%$nom%' ";
            // Ejecutamos la sentencia
            $consulta = mysqli_query($bddcon, $sql);
            if (!$consulta) {
                echo mysqli_error($bddcon) . "<br>";
                echo "Error querry no valida " . $sql;
                echo "Redirigint..";
                echo "<META HTTP-EQUIV='REFRESH' CONTENT='33333333333333;URL=profs_admin.php'>";
            } else {
                // Generamos la lista con en resultado de la consulta
                $numlines = mysqli_num_rows($consulta);
                echo "<a class='createnew_link' href='crear_curs.php'>Donar d'alta curs nou</a>";
                displaySearchBarAdminCursos();
                echo "<table>
                    <tr>
                        <th>Codi</th>
                        <th>Nom</th>
                        <th>Descripció</th>
                        <th>Hores durara</th>
                        <th>Data inici</th>
                        <th>Data final</th>
                        <th>DNI professor</th>
                        <th>Actiu</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>";
                for ($i = 0; $i < $numlines; $i++) {
                    $curs = mysqli_fetch_assoc($consulta);
                    echo "<tr>
                        <td>" . $curs['Codi'] . "</td>
                        <td>" . $curs['Nom'] . "</td>
                        <td>" . $curs['Descripcio'] . "</td>
                        <td>" . $curs['Horres_durara'] . "</td>
                        <td>" . $curs['Data_inici'] . "</td>
                        <td>" . $curs['Data_final'] . "</td>
                        <td>" . $curs['DNI_prof'] . "</td>
                        <td>" . $curs['Actiu'] . "</td>
                        <td><a href='edit_curs.php?codi=" . $curs['Codi'] . "'><img class='link_img' src='img/edit.svg' alt='editar'></a></td>
                        <td><a href='del_curs.php?codi=" . $curs['Codi'] . "'><img class='link_img' src='img/delete.svg' alt='eliminar'></a></td>";
                    if ($curs['Actiu'] != "si") {
                        echo "<td><a href='cursos_status.php?codi=" . $curs['Codi'] . "&opc=act'><img class='link_img' src='img/act.svg' alt='activar'></a></td>";
                    } else {
                        echo "<td><a href='cursos_status.php?codi=" . $curs['Codi'] . "&opc=desact'><img class='link_img' src='img/desact.svg' alt='desactivar'></a></td>";
                    }
                    echo "</tr>";
                }
                echo "</table>";
            }
        } else {
            displayMenuAdmin();
            // Creamos la sentencia sql
            $sql = "SELECT * FROM cursos";
            // Ejecutamos la sentencia
            $consulta = mysqli_query($bddcon, $sql);
            // Generamos la lista con en resultado de la consulta
            $numlines = mysqli_num_rows($consulta);
            echo "<a class='createnew_link' href='crear_curs.php'>Donar d'alta curs nou</a>";
            displaySearchBarAdminCursos();

            echo "<table>
                <tr>
                    <th>Codi</th>
                    <th>Foto</th>
                    <th>Nom</th>
                    <th>Descripció</th>
                    <th>Hores durara</th>
                    <th>Data inici</th>
                    <th>Data final</th>
                    <th>DNI professor</th>
                    <th>Actiu</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>";
            for ($i = 0; $i < $numlines; $i++) {
                $curs = mysqli_fetch_assoc($consulta);
                echo "<tr>
                    <td>" . $curs['Codi'] . "</td>
                    <td><img class='profile_foto' src='" . $curs['Foto'] . "'></td>
                    <td>" . $curs['Nom'] . "</td>
                    <td>" . $curs['Descripcio'] . "</td>
                    <td>" . $curs['Horres_durara'] . "</td>
                    <td>" . $curs['Data_inici'] . "</td>
                    <td>" . $curs['Data_final'] . "</td>
                    <td>" . $curs['DNI_prof'] . "</td>
                    <td>" . $curs['Actiu'] . "</td>
                    <td><a href='edit_curs.php?codi=" . $curs['Codi'] . "'><img class='link_img' src='img/edit.svg' alt='editar'></a></td>
                    <td><a href='del_curs.php?codi=" . $curs['Codi'] . "'><img class='link_img' src='img/delete.svg' alt='eliminar'></a></td>";
                if ($curs['Actiu'] != "si") {
                    echo "<td><a href='cursos_status.php?codi=" . $curs['Codi'] . "&opc=act'><img class='link_img' src='img/act.svg' alt='activar'></a></td>";
                } else {
                    echo "<td><a href='cursos_status.php?codi=" . $curs['Codi'] . "&opc=desact'><img class='link_img' src='img/desact.svg' alt='desactivar'></a></td>";
                }
                echo "<td><a href='edit_cursfoto.php?codi=" . $curs['Codi'] . "&foto=" . $curs['Foto'] . "'><img class='link_img' src='img/editphoto.svg' alt='editar foto'></a></td>";
                echo "</tr>";
            }
            echo "</table>";
        }
    } else {
        // Mostramos mensaje y redirigimos a la pagina de login en el caso de session no iniciada
        echo "<p>Has d'estar valiat per veure aquesta pàgina</p>";
        echo "<META HTTP-EQUIV='REFRESH' CONTENT='3;URL=index.php'>";
    }

    ?>

</body>

</html>