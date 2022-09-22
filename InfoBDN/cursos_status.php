<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activar/Descativar cursos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    // Comprobamos que hemos iniciado la session
    if (isset($_SESSION["email"])){ 
        if ($_REQUEST['codi']) {
            // Creamos la conexion a la bdd
            $bddcon = mysqli_connect("localhost","root","","infobdn");
            // Comprobamos que la conexion sea valida
            if ($bddcon == false){
                mysqli_connect_error();
            }else{
                // Recogemos pos datos enviados des del formulario y los guardamos en variables locales
                $codi= $_REQUEST['codi'];
                $opc= $_REQUEST['opc'];
                if($opc=='desact'){
                    $sql = "UPDATE cursos SET Actiu='no' WHERE Codi LIKE '$codi'";
                }else{
                    $sql = "UPDATE cursos SET Actiu='si' WHERE Codi LIKE '$codi'";
                }
                // Ejecutamos la sentencia
                $consulta = mysqli_query ($bddcon,$sql);  
                // Controlamos posibles errores
                if(!$consulta){ 
                    echo mysqli_error($bddcon)."<br>"; 
                    echo "Error querry no valida ".$sql; 
                    echo "Redirigint..";
                    echo "<META HTTP-EQUIV='REFRESH' CONTENT='222222;URL=cursos_admin.php'>";
                }else{
                echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=cursos_admin.php'>";
                }
            }
        }else{
            echo "No hem pogut obtenir el codi del curs";
            echo "<META HTTP-EQUIV='REFRESH' CONTENT='3;URL=cursos_admin.php'>";
        }
    }else{
        // Mostramos mensaje y redirigimos a la pagina de login en el caso de session no iniciada
        echo "<p>Has d'estar valiat per veure aquesta pàgina</p>";
        echo "<META HTTP-EQUIV='REFRESH' CONTENT='3;URL=login_admin.php'>";
    }    
        
    ?>

</body>

</html>