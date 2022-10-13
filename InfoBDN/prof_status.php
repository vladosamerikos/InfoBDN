<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activar/Descativar professor</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    // Comprobamos que hemos iniciado la session
    if (isset($_SESSION["email"]) && $_SESSION["role"]=="admin"){ 
        if ($_REQUEST['dni']) {
            // Creamos la conexion a la bdd
            $bddcon = mysqli_connect("localhost","root","","infobdn");
            // Comprobamos que la conexion sea valida
            if ($bddcon == false){
                mysqli_connect_error();
            }else{
                // Recogemos pos datos enviados des del formulario y los guardamos en variables locales
                $dni= $_REQUEST['dni'];
                $opc= $_REQUEST['opc'];
                if($opc=='desact'){
                    $sql = "UPDATE professor SET Actiu='no' WHERE DNI LIKE '$dni'";
                }else{
                    $sql = "UPDATE professor SET Actiu='si' WHERE DNI LIKE '$dni'";
                }
                // Ejecutamos la sentencia
                $consulta = mysqli_query ($bddcon,$sql);  
                // Controlamos posibles errores
                if(!$consulta){ 
                    echo mysqli_error($bddcon)."<br>"; 
                    echo "Error querry no valida ".$sql; 
                    echo "Redirigint..";
                    echo "<META HTTP-EQUIV='REFRESH' CONTENT='22;URL=profs_admin.php'>";
                }else{
                echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=profs_admin.php'>";
                }
            }
        }else{
            echo "No hem pogut obtenir el DNI del professor";
            echo "<META HTTP-EQUIV='REFRESH' CONTENT='3;URL=profs_admin.php'>";
        }
    }else{
        // Mostramos mensaje y redirigimos a la pagina de login en el caso de session no iniciada
        echo "<p>Has d'estar valiat per veure aquesta pàgina</p>";
        echo "<META HTTP-EQUIV='REFRESH' CONTENT='1.5;URL=login_admin.php'>";
    }    
        
    ?>

</body>

</html>