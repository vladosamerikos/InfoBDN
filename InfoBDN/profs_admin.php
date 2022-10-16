<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professors</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    include "functions.php";
    $bddcon = getBddConn();
    // Comprobamos que hemos iniciado la session
    if (isset($_SESSION["email"]) && $_SESSION["role"] == "admin") {
        if ($_POST) {
            // Recogemos pos datos enviados des del formulario y los guardamos en variables locales
            $nom = $_POST['search'];
            $sql = "SELECT * FROM professor WHERE Nom LIKE '%$nom%'";
            // Ejecutamos la sentencia
            $consulta = mysqli_query($bddcon, $sql);
            if (!$consulta) {
                echo mysqli_error($bddcon) . "<br>";
                echo "Error querry no valida " . $sql;
                echo "Redirigint..";
                echo "<META HTTP-EQUIV='REFRESH' CONTENT='33333333333333;URL=profs_admin.php'>";
            } else {
                $numlines = mysqli_num_rows($consulta);
                displayMenuAdmin();
                echo "<a class='createnew_link' href='crear_prof.php'>Donar d'alta professor nou</a>";
                displaySearchBarAdminProfs();
                echo "<table>
                    <tr>
                        <th>DNI</th>
                        <th>Nom</th>
                        <th>Cognoms</th>
                        <th>Edat</th>
                        <th>Titol acadèmic</th>
                        <th>Foto</th>
                        <th>Correu electronic</th>
                        <th>Actiu</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>";
                for ($i = 0; $i < $numlines; $i++) {
                    $prof = mysqli_fetch_assoc($consulta);
                    echo "<tr>
                            <td>" . $prof['DNI'] . "</td>
                            <td>" . $prof['Nom'] . "</td>
                            <td>" . $prof['Cognoms'] . "</td>
                            <td>" . $prof['Edat'] . "</td>
                            <td>" . $prof['Titol_academic'] . "</td>
                            <td><img class='profile_foto' src='" . $prof['Foto'] . "'alt='foto'></td>
                            <td>" . $prof['Mail'] . "</td>
                            <td>" . $prof['Actiu'] . "</td>
                            <td><a href='edit_prof.php?dni=" . $prof['DNI'] . "'><img class='link_img' src='img/edit.svg' alt='editar'></a></td>
                            <td><a href='edit_proffoto.php?dni=" . $prof['DNI'] . "&foto=" . $prof['Foto'] . "'><img class='link_img' src='img/editphoto.svg' alt='editar foto'></a></td>
                            <td><a href='del_prof.php?dni=" . $prof['DNI'] . "&foto=" . $prof['Foto'] . "'><img class='link_img' src='img/delete.svg' alt='eliminar'></a></td>";
                    if ($prof['Actiu'] != "si") {
                        echo "<td><a href='prof_status.php?dni=" . $prof['DNI'] . "&opc=act'><img class='link_img' src='img/act.svg' alt='activar'></a></td>";
                    } else {
                        echo "<td><a href='prof_status.php?dni=" . $prof['DNI'] . "&opc=desact'><img class='link_img' src='img/desact.svg' alt='desactivar'></a></td>";
                    }
                    echo "</tr>";
                }
                echo "</table>";
            }
        } else {
            displayMenuAdmin();
            // Creamos la sentencia sql
            $sql = "SELECT * FROM professor";
            // Ejecutamos la sentencia
            $consulta = mysqli_query($bddcon, $sql);
            // Generamos la lista con en resultado de la consulta
            $numlines = mysqli_num_rows($consulta);
            echo "<a class='createnew_link' href='crear_prof.php'>Donar d'alta professor nou</a>";
            displaySearchBarAdminProfs();
            echo "<table>
                <tr>
                    <th>DNI</th>
                    <th>Nom</th>
                    <th>Cognoms</th>
                    <th>Edat</th>
                    <th>Titol acadèmic</th>
                    <th>Foto</th>
                    <th>Correu electronic</th>
                    <th>Actiu</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>";
            for ($i = 0; $i < $numlines; $i++) {
                $prof = mysqli_fetch_assoc($consulta);
                echo "<tr>
                    <td>" . $prof['DNI'] . "</td>
                    <td>" . $prof['Nom'] . "</td>
                    <td>" . $prof['Cognoms'] . "</td>
                    <td>" . $prof['Edat'] . "</td>
                    <td>" . $prof['Titol_academic'] . "</td>
                    <td><img class='profile_foto' src='" . $prof['Foto'] . "'alt='foto'></td>
                    <td>" . $prof['Mail'] . "</td>
                    <td>" . $prof['Actiu'] . "</td>
                    <td><a href='edit_prof.php?dni=" . $prof['DNI'] . "'><img class='link_img' src='img/edit.svg' alt='editar'></a></td>
                    <td><a href='edit_proffoto.php?dni=" . $prof['DNI'] . "&foto=" . $prof['Foto'] . "'><img class='link_img' src='img/editphoto.svg' alt='editar foto'></a></td>
                    <td><a href='del_prof.php?dni=" . $prof['DNI'] . "&foto=" . $prof['Foto'] . "'><img class='link_img' src='img/delete.svg' alt='eliminar'></a></td>";
                if ($prof['Actiu'] != "si") {
                    echo "<td><a href='prof_status.php?dni=" . $prof['DNI'] . "&opc=act'><img class='link_img' src='img/act.svg' alt='activar'></a></td>";
                } else {
                    echo "<td><a href='prof_status.php?dni=" . $prof['DNI'] . "&opc=desact'><img class='link_img' src='img/desact.svg' alt='desactivar'></a></td>";
                }
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