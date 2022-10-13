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
    include "functions.php";
    // Comprobamos que hemos iniciado la session
    if (isset($_SESSION["email"]) && $_SESSION["role"]=="alum"){
        if ($_REQUEST['codi']) {
            $bddcon = getBddConn();
            $codi = $_REQUEST['codi'];
            $dni = $_SESSION['dni'];
            // Creamos la sentencia sql
            $sql = "DELETE FROM matricula WHERE Codi_curs like '$codi' and DNI_alum like '$dni'";
            // Ejecutamos la sentencia
            $consulta = mysqli_query ($bddcon,$sql);  
            // Controlamos posibles errores
            if(!$consulta){ 
                echo mysqli_error($bddcon)."<br>"; 
                echo "Error querry no valida ".$sql; 
                echo "Redirigint..";
                echo "<META HTTP-EQUIV='REFRESH' CONTENT='333333333333;URL=llistatcursos_alu.php'>";
            }else{
                echo mysqli_error($bddcon)."<br>"; 
                echo "Curs desmatriculat"; 
                echo "Redirigint..";
                echo "<META HTTP-EQUIV='REFRESH' CONTENT='3;URL=micursos_alu.php'>";
            }    
        }else{
            // Mostramos mensaje y redirigimos a la pagina de login en el caso de session no iniciada
            echo "<p>No hem pugut obtenir el codi del curs</p>";
            echo "<META HTTP-EQUIV='REFRESH' CONTENT='3;URL=llistatcursos_alu.php'>";
        }    
    }else{
        // Mostramos mensaje y redirigimos a la pagina de login en el caso de session no iniciada
        echo "<p>Has d'estar valiat per veure aquesta pàgina</p>";
        echo "<META HTTP-EQUIV='REFRESH' CONTENT='3;URL=index.php'>";
    }    
        
?>
</body>
</html>