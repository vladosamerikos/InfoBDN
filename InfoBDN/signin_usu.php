<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear compte</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    include "functions.php";
    $bddcon = getBddConn();
    // Comprobamos que hemos iniciado la session
    if ($_POST) {

        // Recogemos pos datos enviados des del formulario y los guardamos en variables locales
        $dni = $_POST['dni'];
        $nom = $_POST['nom'];
        $cognom = $_POST['cognom'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $edat = $_POST['edat'];
        $md5pass = md5($password);
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
            // Creamos la sentencia sql
            $sql = "INSERT INTO alumnes  VALUES ('$dni', '$nom', '$cognom', '$edat', '$nombreDirectorio$nombreFichero', '$email', '$md5pass' )";
        } else {
            print("No se ha podido subir el fichero\n");
            // Creamos la sentencia sql
            $sql = "INSERT INTO professor VALUES ('$dni', '$nom', '$edat', '', '$email', '$md5pass' )";
        }

        // Ejecutamos la sentencia
        $consulta = mysqli_query($bddcon, $sql);
        // Controlamos posibles errores
        if (!$consulta) {
            echo mysqli_error($bddcon) . "<br>";
            echo "Error querry no valida " . $sql;
            echo "Redirigint..";
            echo "<META HTTP-EQUIV='REFRESH' CONTENT='1.5;URL=signin_usu.php'>";
        } else {
            echo "Usuari creat exitosament!!!";
            echo "<META HTTP-EQUIV='REFRESH' CONTENT='1;URL=index.php'>";
        }
    } else {
        // Generamos el formulario de login
        echo "<form class='mig_form form' action='signin_usu.php' ENCTYPE='multipart/form-data' method='post'>
            <h1> Crear compte</h1>
            <p>Nom: <input placeholder='Nom' type='text' name='nom' id='nom' pattern='[A-Za-z]+' required></p>
            <p>Cognom: <input placeholder='Cognom' type='text' name='cognom' pattern='[A-Za-z]+' id='cognom' required></p>
            <p>Edad: <input type='number' min='0' name='edat' id='edat' required></p>
            <p>DNI: <input placeholder='DNI' type='text' name='dni' id='dni'required pattern='(([X-Z]{1})([-]?)(\d{7})([-]?)([A-Z]{1}))|((\d{8})([-]?)([A-Z]{1}))'  maxlength='9'></p>
            <p>Email: <input placeholder='Correu electronic' type='email' name='email' id='email' required></p>
            <p>Foto: <input type='file' name='foto' id='foto' accept='image/*' required></p>
            <p>Password: <input placeholder='Password' type='password' name='password' id='password'required></p>
            <p><a class='doble_button' href='index.php'>Iniciar sessió</a><button class='doble_button' type='submit'>Crear compte</button></p>   
        </form>";
    }


    ?>

</body>

</html>