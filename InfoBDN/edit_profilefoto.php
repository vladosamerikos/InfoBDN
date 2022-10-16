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
    if (isset($_SESSION["email"]) && ($_SESSION["role"] == "prof" || $_SESSION["role"] == "alum")) {
        // En el caso de que la pagina ha recivido datos POST genera sentencia sql que compruba si los datos coinciden con algun registro en la BD.
        if ($_POST) {
            // Recogemos pos datos enviados des del formulario y los guardamos en variables locales

            $dni = $_SESSION['dni'];
            $oldfoto = $_POST['oldfoto'];
            if ($_SESSION['role'] == 'alum') {
                $table = 'alumnes';
            } elseif ($_SESSION['role'] == 'prof') {
                $table = 'professor';
            }

            if ($oldfoto != '') {
                if (unlink($oldfoto)) {
                    echo "<p>Foto anterior eliminada exitosamente</p>";
                } else {
                    echo "<p>Error a la hora de eliminar la foto</p>";
                }
            } else {
                echo "<p>El usuario no tenia foto</p>";
            }

            if (is_uploaded_file($_FILES['foto']['tmp_name'])) {
                $nombreDirectorio = "img/";
                $idUnico = $dni;
                $nomorig = $_FILES['foto']['name'];
                $cont = explode(".", $nomorig);
                $ext = $cont[1];
                $nombreFichero = $idUnico . "." . $ext;
                move_uploaded_file(
                    $_FILES['foto']['tmp_name'],
                    $nombreDirectorio . $nombreFichero
                );
                $sql = "UPDATE $table SET Foto='img/$nombreFichero' WHERE DNI LIKE '$dni'";
            } else {
                print("<p>No has subido foto nueva</p>");
                $sql = "UPDATE $table SET Foto='' WHERE DNI LIKE '$dni'";
            }
            // Ejecutamos la sentencia
            $consulta = mysqli_query($bddcon, $sql);
            // Controlamos posibles errores
            if (!$consulta) {
                echo mysqli_error($bddcon) . "<br>";
                echo "Error querry no valida " . $sql;
                echo "Redirigint..";
                echo "<META HTTP-EQUIV='REFRESH' CONTENT='3;URL=meu_pefil.php'>";
            } else {
                echo "Foto modificada exitosament!!!";
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
                    <form class='profilePhoto' action='edit_profilefoto.php' ENCTYPE='multipart/form-data' method='post'>
                        <img class='roundProfilePhoto' src='$foto'>
                        <p class='profileName'>" . $perfil['Nom'] . " " . $perfil['Cognoms'] . "</p>
                        <input readonly class='ocult' type='text' name='oldfoto' id='oldfoto' value='$foto'>
                        <input required type='file' name='foto' id='foto' accept='image/*'>
                        <label for='foto' class='labelFoto'>Selecionar foto</label>
                        <button class='bntEditProfile' type='submit'>Putjar Foto</button>
                    </form>
                    <div class='profileInfo'>
                        <div class='profileRow'>
                            <div class='rowTitle'>Nom Complet</div><div class='rowContent'>" . $perfil['Nom'] . " " . $perfil['Cognoms'] . "</div>
                        </div>
                        <hr>
                        <div class='profileRow'>
                            <div class='rowTitle'>Correu Electronic</div><div class='rowContent'>" . $perfil['Mail'] . "</div>
                        </div>
                        <hr>
                        <div class='profileRow'>
                            <div class='rowTitle'>DNI</div><div class='rowContent'>" . $perfil['DNI'] . "</div>
                        </div>
                        <hr>
                        <div class='profileRow'>
                            <div class='rowTitle'>Edat</div><div class='rowContent'>" . $perfil['Edat'] . "</div>
                        </div>
                        <hr>
                        <div class='profileRow'>
                        <a class='bntEditProfile' href='edit_profileinfo.php?mail=" . $perfil['Mail'] . "'>Editar</a>
                        </div>
                    <div>
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