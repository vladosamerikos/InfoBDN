
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
    // Comprobamos que hemos iniciado la session
    if ($_POST) {
            // Creamos la conexion a la bdd
        $bddcon = mysqli_connect("localhost","root","","infobdn");
        // Comprobamos que la conexion sea valida
        if ($bddcon == false){
            mysqli_connect_error();
        }else{
            // Recogemos pos datos enviados des del formulario y los guardamos en variables locales
            $dni = $_POST['dni'];
            $nom = $_POST['nom'];
            $cognom = $_POST['cognom'];
            $email= $_POST['email'];
            $password= $_POST['password'];
            $edat= $_POST['edat'];
            $md5pass = md5($password);
            if (is_uploaded_file ($_FILES['foto']['tmp_name'])){
                $nombreDirectorio = "img/";
                $idUnico = $dni;
                $nomorig=$_FILES['foto']['name'];
                $cont=explode(".",$nomorig);
                $ext= $cont[1];
                $nombreFichero = $idUnico.".".$ext;
                move_uploaded_file ($_FILES['foto']['tmp_name'],
                $nombreDirectorio.$nombreFichero);
                // Creamos la sentencia sql
                $sql = "INSERT INTO alumnes  VALUES ('$dni', '$nom', '$cognom', '$edat', '$nombreDirectorio$nombreFichero', '$email', '$md5pass' )";
            }else{
                print ("No se ha podido subir el fichero\n");
                // Creamos la sentencia sql
                $sql = "INSERT INTO professor VALUES ('$dni', '$nom', '$edat', '', '$email', '$md5pass' )";
            }

            // Ejecutamos la sentencia
            $consulta = mysqli_query ($bddcon,$sql);  
            // Controlamos posibles errores
            if(!$consulta){ 
                echo mysqli_error($bddcon)."<br>"; 
                echo "Error querry no valida ".$sql; 
                echo "Redirigint..";
                echo "<META HTTP-EQUIV='REFRESH' CONTENT='555555555555555;URL=signin_usu.php'>";
            }else{
                echo "Usuari creat exitosament!!!";
                echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=index.php'>";
            }   
        }    
    }else{
        // Generamos el formulario de login
        echo "<form class='mig_form form' action='signin_usu.php' ENCTYPE='multipart/form-data' method='post'>";
            echo "<h1> Crear compte</h1>";
            echo "<p>Nom: <input placeholder='Nom' type='text' name='nom' id='nom' required></p>";
            echo "<p>Cognom: <input placeholder='Cognom' type='text' name='cognom' id='cognom' required></p>";
            echo "<p>DNI: <input placeholder='DNI' type='text' name='dni' id='dni'required maxlength='9'></p>";
            echo "<p>Email: <input placeholder='Correu electronic' type='email' name='email' id='email' required></p>";
            echo "<p>Password: <input placeholder='Password' type='password' name='password' id='password'required></p>";
            echo "<p>Edad: <input type='number' name='edat' id='edat' required></p>";
            echo "<p>Foto: <input type='file' name='foto' id='foto' accept='image/*' required></p>";
            echo "<p><a class='doble_button' href='index.php'>Iniciar sessió</a><button class='doble_button' type='submit'>Crear compte</button></p>";       
        echo "</form>";
    }
   
        
    ?>

</body>
</html>