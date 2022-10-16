<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar foto curs</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    include "functions.php";
    $bddcon = getBddConn();
    // Comprobamos que hemos iniciado la session
    if (isset($_SESSION["email"]) && $_SESSION["role"] == "admin") {
        // En el caso de que la pagina ha recivido datos POST genera sentencia sql que compruba si los datos coinciden con algun registro en la BD.
        if ($_POST) {
            // Recogemos pos datos enviados des del formulario y los guardamos en variables locales
            $codi = $_POST['codi'];
            $oldfoto = $_POST['oldfoto'];
            // Eliminamos el arxivo de la foto aterior
            if ($oldfoto != '') {
                if (unlink($oldfoto)) {
                    echo "<p>Foto anterior eliminada exitosamente</p>";
                } else {
                    echo "<p>Error a la hora de eliminar la foto</p>";
                }
            } else {
                echo "<p>El curs no tenia foto</p>";
            }
            if (is_uploaded_file($_FILES['foto']['tmp_name'])) {
                $nombreDirectorio = "img/";
                $idUnico = $codi;
                $nomorig = $_FILES['foto']['name'];
                $cont = explode(".", $nomorig);
                $ext = $cont[1];
                $nombreFichero = $idUnico . "." . $ext;
                move_uploaded_file(
                    $_FILES['foto']['tmp_name'],
                    $nombreDirectorio . $nombreFichero
                );
                $sql = "UPDATE cursos SET Foto='img/$nombreFichero' WHERE codi LIKE '$codi'";
            } else {
                print("<p>No has subido foto nueva</p>");
                $sql = "UPDATE cursos SET Foto='' WHERE codi LIKE '$codi'";
            }
            // Ejecutamos la sentencia
            $consulta = mysqli_query($bddcon, $sql);
            // Controlamos posibles errores
            if (!$consulta) {
                echo mysqli_error($bddcon) . "<br>";
                echo "Error querry no valida " . $sql;
                echo "Redirigint..";
                echo "<META HTTP-EQUIV='REFRESH' CONTENT='2;URL=cursos_admin.php'>";
            } else {
                echo "Foto modificada exitosament!!!";
                echo "<META HTTP-EQUIV='REFRESH' CONTENT='2;URL=cursos_admin.php'>";
            }
        } else {
            // Comprobamos si nos han pasado dotos por request
            if ($_REQUEST['codi']) {
                $codi = $_REQUEST['codi'];
                $oldfoto = $_REQUEST['foto'];
                displayMenuAdmin();
                echo "<form class='form' action='edit_cursfoto.php' ENCTYPE='multipart/form-data' method='post'>
                    <h1> Modificar foto curs </h1>
                    <p><img with='150px' height='150px' src='$oldfoto' alt='No té foto'></p>
                    <input readonly class='ocult' type='text' name='codi' id='codi' value='$codi'>
                    <input readonly class='ocult' type='text' name='oldfoto' id='oldfoto' value='$oldfoto'>
                    <p><input required type='file' name='foto' id='foto' accept='image/*'></p>
                    <p><button class='submit_button' type='submit' >Modificar</button></p>  
                </form>";
            } else {
                echo "No hem pogut obtenir el codi del curs";
                echo "<META HTTP-EQUIV='REFRESH' CONTENT='3;URL=cursos_admin.php'>";
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