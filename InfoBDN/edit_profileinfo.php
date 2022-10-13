<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar perfil</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    include "functions.php";
    $bddcon = getBddConn();
    // Comprobamos que hemos iniciado la session
    if (isset($_SESSION["email"])  && ($_SESSION["role"]=="prof" || $_SESSION["role"]=="alum")) {
        // En el caso de que la pagina ha recivido datos POST genera sentencia sql que compruba si los datos coinciden con algun registro en la BD.
        if ($_POST) {
            // Recogemos pos datos enviados des del formulario y los guardamos en variables locales
            $nom = $_POST['nom'];
            $cognoms = $_POST['cognom'];
            $email = $_POST['email'];
            $dni = $_POST['dni'];
            $edat= $_POST['edat'];

            if ($_SESSION['role'] == 'alum') {
                $table = 'alumnes';
            } elseif ($_SESSION['role'] == 'prof') {
                $table = 'professor';
            }

            $sql = "UPDATE $table SET Nom='$nom', Cognoms='$cognoms', Mail='$email', Edat='$edat' WHERE DNI LIKE '$dni'";
            // Ejecutamos la sentencia
            $consulta = mysqli_query($bddcon, $sql);
            // Controlamos posibles errores
            if (!$consulta) {
                echo mysqli_error($bddcon) . "<br>";
                echo "Error querry no valida " . $sql;
                echo "Redirigint..";
                echo "<META HTTP-EQUIV='REFRESH' CONTENT='3333333333;URL=meu_perfil.php'>";
            } else {
                echo "Perfil modificat exitosament!!!";
                echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=meu_perfil.php'>";
            }
        } else {
            // Comprobamos si nos han pasado dotos por request
            if ($_REQUEST['mail']) {
                $email = $_REQUEST['mail'];
                if ($_SESSION['role'] == 'alum') {
                    $table = 'alumnes';
                } elseif ($_SESSION['role'] == 'prof') {
                    $table = 'professor';
                }
                // Creamos la sentencia sql
                $sql = "SELECT * FROM $table WHERE Mail like '$email'";
                // Ejecutamos la sentencia
                $consulta = mysqli_query($bddcon, $sql);
                $perfil = mysqli_fetch_assoc($consulta);
                // Generamos el contenido de la pagina
                if ($_SESSION['role'] == 'alum') {
                    displayMenuAlumn();
                } elseif ($_SESSION['role'] == 'prof') {
                    displayMenuProf();
                }
                $foto = $perfil['Foto'];

                echo "<h1 class='pageTitles'>Meu Perfil</h1>
                <div class='profileContent'>
                    <div class='profilePhoto profilePhotoForm'>
                        <img class='roundProfilePhoto' src='$foto'>
                        <p class='profileName'>" . $perfil['Nom'] . " " . $perfil['Cognoms'] . "</p>
                        <a class='bntEditProfile' href='edit_profilefoto.php?mail=".$perfil['Mail']."'>Editar Foto</a>
                    </div>
                    <form class='profileInfo profileInfoForm' action='edit_profileinfo.php'  method='post'>
                        <div class='profileRow'>
                            <div class='rowTitle'>Nom </div><input class='rowContent' type='text' name='nom' id='nom' value='".$perfil['Nom']."'>
                        </div>
                        <div class='profileRow'>
                            <div class='rowTitle'>Cognoms</div><input class='rowContent' type='text' name='cognom' id='cognom' value='".$perfil['Cognoms']."'>
                        </div>
                        <div class='profileRow'>
                            <div class='rowTitle'>Correu Electronic</div><input class='rowContent' type='text' name='email' id='email' value='".$perfil['Mail']."'>
                        </div>
                        <div class='profileRow'>
                            <div class='rowTitle'>DNI</div><input class='rowContent' type='text' name='dni' id='dni' value='".$perfil['DNI']."' readonly>
                        </div>
                        <div class='profileRow'>
                            <div class='rowTitle'>Edat</div><input class='rowContent' type='number' name='edat' id='edat' value='".$perfil['Edat']."'>
                        </div>
                            <button class='bntEditProfile' type='submit'>Guardar Canvis</button>
                    </form>
                </div>";
            } else {
                echo "No hem pogut obtenir el DNI del professor";
                echo "<META HTTP-EQUIV='REFRESH' CONTENT='1.5;URL=meu_perfil.php'>";
            }
        }
    } else {
        // Mostramos mensaje y redirigimos a la pagina de login en el caso de session no iniciada
        echo "<p>Has d'estar valiat per veure aquesta pàgina</p>";
        echo "<META HTTP-EQUIV='REFRESH' CONTENT='3;URL=index.php'>";
    }

    ?>

</body>

</html>