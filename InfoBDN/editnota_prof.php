<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar professor</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    include "functions.php";
    // Comprobamos que hemos iniciado la session
    if (isset($_SESSION["email"]) && $_SESSION["role"] == "prof") {
        $bddcon = getBddConn();
        // En el caso de que la pagina ha recivido datos POST genera sentencia sql que compruba si los datos coinciden con algun registro en la BD.
        if ($_POST) {
            // Recogemos pos datos enviados des del formulario y los guardamos en variables locales
            $dni = $_POST['dni'];
            $codi = $_POST['codi'];
            $nota = $_POST['nota'];

            $sql = "UPDATE matricula SET nota='$nota' WHERE DNI_alum LIKE '$dni' and Codi_curs like '$codi'";
            // Ejecutamos la sentencia
            $consulta = mysqli_query($bddcon, $sql);
            // Controlamos posibles errores
            if (!$consulta) {
                echo mysqli_error($bddcon) . "<br>";
                echo "Error querry no valida " . $sql;
                echo "Redirigint..";
                echo "<META HTTP-EQUIV='REFRESH' CONTENT='1.5;URL=notes_prof.php'>";
            } else {
                echo "Nota modificada exitosament!!!";
                echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=notes_prof.php'>";
            }
        } else {
            // Comprobamos si nos han pasado dotos por request
            if ($_REQUEST['dni']) {
                // Recogemos pos datos enviados des del formulario y los guardamos en variables locales
                $dni = $_REQUEST['dni'];
                $codi = $_REQUEST['codi'];
                // Creamos la sentencia sql
                $sql = "SELECT * FROM matricula WHERE DNI_alum LIKE '$dni' and Codi_curs like '$codi'";
                $sql2 = "SELECT * FROM alumnes WHERE DNI LIKE '$dni'";
                $sql3 = "SELECT * FROM cursos WHERE codi LIKE '$codi'";
                // Ejecutamos la sentencia
                $consulta = mysqli_query($bddcon, $sql);
                $consulta2 = mysqli_query($bddcon, $sql2);
                $consulta3 = mysqli_query($bddcon, $sql3);

                $curs = mysqli_fetch_array($consulta3);
                $matricula = mysqli_fetch_assoc($consulta);
                $alumne = mysqli_fetch_assoc($consulta2);
                displayMenuProf();
                echo "<form class='form'  action='editnota_prof.php' method='post'>
                    <h1>Modificar nota alumne </h1>
                    <p><img class='profile_foto' src='" . $alumne['Foto'] . "'></p>
                    <p>" . $alumne['Nom'] . " " . $alumne['Cognoms'] . "</p>
                    <input readonly class='ocult' type='text' name='dni' id='dni' value='" . $dni . "'>
                    <input readonly class='ocult' type='text' name='codi' id='codi' value='" . $codi . "'>
                    <p>Curs: <input readonly type='text' name='curs' id='curs' value='" . $curs['Nom'] . "'></p>
                    <p>Nota: <input min='0' max='10' type='number' name='nota' id='nota' value='" . $matricula['nota'] . "'></p>
                    <p><button class='submit_button' type='submit'>Modificar</button></p>     
                    </form>";
            } else {
                echo "No hem pogut obtenir el DNI del alumne";
                echo "<META HTTP-EQUIV='REFRESH' CONTENT='1.5;URL=notes_prof.php'>";
            }
        }
    } else {
        // Mostramos mensaje y redirigimos a la pagina de login en el caso de session no iniciada
        echo "<p>Has d'estar valiat per veure aquesta pàgina</p>";
        echo "<META HTTP-EQUIV='REFRESH' CONTENT='1.5;URL=index.php'>";
    }

    ?>

</body>

</html>