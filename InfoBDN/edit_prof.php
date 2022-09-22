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
    // Comprobamos que hemos iniciado la session
    if (isset($_SESSION["email"])){ 
        // En el caso de que la pagina ha recivido datos POST genera sentencia sql que compruba si los datos coinciden con algun registro en la BD.
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

                $sql = "UPDATE professor SET Nom='$nom', Cognoms='$cognoms', Titol_academic='$titol', mail='$email', password='$md5pass' WHERE DNI LIKE '$dni'";
                // Ejecutamos la sentencia
                $consulta = mysqli_query ($bddcon,$sql);  
                // Controlamos posibles errores
                if(!$consulta){ 
                    echo mysqli_error($bddcon)."<br>"; 
                    echo "Error querry no valida ".$sql; 
                    echo "Redirigint..";
                    echo "<META HTTP-EQUIV='REFRESH' CONTENT='3;URL=profs_admin.php'>";
                }else{
                   echo "Professor modificat exitosament!!!";
                   echo "<META HTTP-EQUIV='REFRESH' CONTENT='3;URL=profs_admin.php'>";
                }
            }
        }else{
            // Comprobamos si nos han pasado dotos por request
            if ($_REQUEST['dni']) {
                // Creamos la conexion a la bdd
                $bddcon = mysqli_connect("localhost","root","","infobdn");
                // Comprobamos que la conexion sea valida
                if ($bddcon == false){
                    mysqli_connect_error();
                }else{
                    // Recogemos pos datos enviados des del formulario y los guardamos en variables locales
                    $dni = $_REQUEST['dni'];
                    // Creamos la sentencia sql
                    $sql = "SELECT * FROM professor WHERE DNI LIKE '$dni'";
                    // Ejecutamos la sentencia
                    $consulta = mysqli_query ($bddcon,$sql);  
                    // Controlamos posibles errores
                    if(!$consulta){ 
                        echo mysqli_error($bddcon)."<br>"; 
                        echo "Error querry no valida ".$sql; 
                        echo "Redirigint..";
                        echo "<META HTTP-EQUIV='REFRESH' CONTENT='3;URL=profs_admin.php'>";
                    }else{
                        $prof= mysqli_fetch_assoc($consulta);
                        
                        echo "<form class='big_form' action='edit_prof.php' ENCTYPE='multipart/form-data' method='post'>";
                            echo "<h1> Modificar professor </h1>";
                            echo "<p>DNI<input type='text' name='dni' id='dni' value='".$prof['DNI']."' readonly></p>";
                            echo "<p>Nom<input type='text' name='nom' id='nom' value='".$prof['Nom']."'></p>";
                            echo "<p>Cognoms<input type='text' name='cognoms' id='cognoms' value='".$prof['Cognoms']."'></p>";
                            echo "<p>Titol academic<input type='text' name='titol' id='titol' value='".$prof['Titol_academic']."'></p>";
                            echo "<p>Correu electronic<input type='email' name='correu' id='correu' value='".$prof['mail']."'></p>";
                            echo "<p>Contrasenya<input type='password' name='password' id='password'></p>";
                            echo "<p><button class='submit_button' type='submit'>Modificar</button></p>";       
                         echo "</form>";                     
                    }   
                } 
            }else{
                echo "No hem pogut obtenir el DNI del professor";
            }
        }
    }else{
        // Mostramos mensaje y redirigimos a la pagina de login en el caso de session no iniciada
        echo "<p>Has d'estar valiat per veure aquesta pàgina</p>";
        echo "<META HTTP-EQUIV='REFRESH' CONTENT='3;URL=login_admin.php'>";
    }    
        
    ?>

</body>
</html>