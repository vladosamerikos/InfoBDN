<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear professor</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    include "functions.php";
    $bddcon= getBddConn();
    // Comprobamos que hemos iniciado la session
    if (isset($_SESSION["email"]) && $_SESSION["role"]=="admin"){
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
                    $cognoms = $_POST['cognoms'];
                    $titol = $_POST['titol'];
                    $email= $_POST['correu'];
                    $password= $_POST['password'];
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
                        $sql = "INSERT INTO professor VALUES ('$dni', '$nom', '$cognoms', '$titol', '$nombreDirectorio$nombreFichero', '$email', 'si' ,'$md5pass' )";
                    }else{
                        print ("No se ha podido subir el fichero\n");
                        // Creamos la sentencia sql
                        $sql = "INSERT INTO professor VALUES ('$dni', '$nom', '$cognoms', '$titol', '', '$email', 'si' ,'$md5pass')";
                    }

                    // Ejecutamos la sentencia
                    $consulta = mysqli_query ($bddcon,$sql);  
                    // Controlamos posibles errores
                    if(!$consulta){ 
                        echo mysqli_error($bddcon)."<br>"; 
                        echo "Error querry no valida ".$sql; 
                        echo "Redirigint..";
                        echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=crear_curs.php'>";
                    }else{
                       echo "Professor creat exitosament!!!";
                       echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=profs_admin.php'>";
                    }   
                }    
            }else{
                // Creamos la sentencia sql
                $sql = "SELECT DNI FROM professor";
                // Ejecutamos la sentencia
                $consulta = mysqli_query ($bddcon,$sql);  
                // Controlamos posibles errores
                if(!$consulta){ 
                    echo mysqli_error($bddcon)."<br>"; 
                    echo "Error querry no valida ".$sql; 
                    echo "Redirigint..";
                    echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=profs_admin.php'>";
                }else{
                    displayMenuAdmin();
                    echo "<form class='big_form' action='crear_prof.php' ENCTYPE='multipart/form-data' method='post'>
                        <h1> Crear professor </h1>
                        <p>DNI<input type='text' name='dni' id='dni' required></p>
                        <p>Nom<input type='text' name='nom' id='nom' required></p>
                        <p>Cognoms<input type='text' name='cognoms' id='cognoms' required></p>
                        <p>Titol academic<input type='text' name='titol' id='titol'required></p>
                        <p>Foto<input type='file' name='foto' id='foto' accept='image/*' required></p>
                        <p>Correu electronic<input type='email' name='correu' id='correu' required></p>
                        <p>Contrasenya<input type='password' name='password' id='password' required></p>
                        <p><button class='submit_button' type='submit'>Crear</button></p>      
                    </form>";
                }
            }
    }else{
        // Mostramos mensaje y redirigimos a la pagina de login en el caso de session no iniciada
        echo "<p>Has d'estar valiat per veure aquesta pàgina</p>";
        echo "<META HTTP-EQUIV='REFRESH' CONTENT='3;URL=index.php'>";
    }    
        
    ?>

</body>
</html>