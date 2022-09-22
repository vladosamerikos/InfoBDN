<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar professor</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    // Comprobamos que hemos iniciado la session
    if (isset($_SESSION["email"])){ 
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
                $foto = $_REQUEST['foto'];
                // Eliminamos el arxivo de la foto
                if (isset($foto)){
                    if (unlink($foto)) {
                        echo"<p>Foto anterior eliminada exitosamente</p>";
                    } else {
                        echo"<p>Error a la hora de eliminar la foto</p>";
                    }
                }else{
                    echo"<p>El usuario no tenia foto</p>";
                }
               
                // Creamos la sentencia sql
                $sql = "DELETE FROM professor WHERE  DNI= '$dni'";
                // Ejecutamos la sentencia
                $consulta = mysqli_query ($bddcon,$sql);  
                // Controlamos posibles errores
                if(!$consulta){ 
                    echo mysqli_error($bddcon)."<br>"; 
                    echo "Error querry no valida ".$sql; 
                    echo "Redirigint..";
                    echo "<META HTTP-EQUIV='REFRESH' CONTENT='3333333;URL=profs_admin.php'>";
                }else{
                    echo "Professor eliminat exitosament!";
                    echo "<META HTTP-EQUIV='REFRESH' CONTENT='3333333;URL=profs_admin.php'>";                     
                }   
            } 
        }else{
            echo "No hem pogut obtenir el dni del professor";
        }
    }else{
        // Mostramos mensaje y redirigimos a la pagina de login en el caso de session no iniciada
        echo "<p>Has d'estar valiat per veure aquesta pàgina</p>";
        echo "<META HTTP-EQUIV='REFRESH' CONTENT='3;URL=login_admin.php'>";
    }    
        
    ?>

</body>
</html>