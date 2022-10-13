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
    include "functions.php";
    $bddcon= getBddConn();
    // Comprobamos que hemos iniciado la session
    if (isset($_SESSION["email"]) && $_SESSION["role"]=="admin"){
        // Comprobamos si nos han pasado dotos por request
        if ($_REQUEST['dni']) {
            // Recogemos pos datos enviados des del formulario y los guardamos en variables locales
            $dni = $_REQUEST['dni'];
            $foto = $_REQUEST['foto'];
            // Eliminamos el arxivo de la foto
            if (isset($foto)){
                if (unlink($foto)) {
                    echo"<p>Foto eliminada exitosamente</p>";
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
                echo "<META HTTP-EQUIV='REFRESH' CONTENT='3;URL=profs_admin.php'>";
            }else{
                echo "Professor eliminat exitosament!";
                echo "<META HTTP-EQUIV='REFRESH' CONTENT='1.5;URL=profs_admin.php'>";                     
            }   
        }else{
            echo "No hem pogut obtenir el dni del professor";
            echo "<META HTTP-EQUIV='REFRESH' CONTENT='1.5;URL=profs_admin.php'>";
        }
    }else{
        // Mostramos mensaje y redirigimos a la pagina de login en el caso de session no iniciada
        echo "<p>Has d'estar valiat per veure aquesta pàgina</p>";
        echo "<META HTTP-EQUIV='REFRESH' CONTENT='1.5;URL=index.php'>";
    }    
        
    ?>

</body>
</html>