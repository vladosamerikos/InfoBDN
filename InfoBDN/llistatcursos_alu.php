<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cursos disponibles</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    include "functions.php";
    // Comprobamos que hemos iniciado la session
    if (isset($_SESSION["email"]) && $_SESSION["role"]=="alum"){
        $bddcon= getBddConn();
        $fechaActual = date ( 'Y-m-d' );
        $dni= $_SESSION['dni'];
        if($_POST){
            displayMenuAlumn();
            $nom= $_POST['search'];
            // Creamos la sentencia sql
            $sql = "SELECT * FROM cursos WHERE Nom LIKE '%$nom%' and Data_inici>'$fechaActual' and Actiu like 'si' and Codi NOT IN ( SELECT Codi_curs FROM matricula WHERE DNI_alum like '$dni')";
            // Ejecutamos la sentencia
            $consulta = mysqli_query ($bddcon,$sql); 
            $numlines = mysqli_num_rows($consulta);
            displaySearchBarAlumCursosDisponibles();
            for($i=0; $i<$numlines;$i++){
                $curs= mysqli_fetch_assoc($consulta);
                $dniprof= $curs['DNI_prof'];
                $sql2 = "SELECT * FROM professor WHERE  DNI like '$dniprof'";
                $consulta2 = mysqli_query ($bddcon,$sql2);
                $prof= mysqli_fetch_assoc($consulta2);
                echo "<div class='cursDisponible'>
                    <div class='leftContent'>
                        <img src='".$curs['Foto']."'>
                    </div>
                    <div class='rightContent'>
                        <div class=' cursDispTitle'>".$curs['Nom']."</div>
                        <div class='cursDispRow cursDispDescrip'>".$curs['Descripcio']."</div>
                        <div class='cursDispRow'><img class='cursIcon' src='img/teacher.svg'> &nbsp ".$prof['Nom']." ".$prof['Cognoms']."</div>
                        <div class='cursDispRow'><div class='cursDispData'><img class='cursIcon' src='img/data.svg'> &nbsp ".$curs['Data_inici']."</div><div class='cursDispTime'> <img class='cursIcon' src='./img/time.svg'>".$curs['Horres_durara']."</div></div>
                        <div class='cursDispRow buttonContainer'><a class='matricularButon' href='matricular.php?codi=".$curs['Codi']."'>Matricular</a></div>
                    </div>
                </div>";
            }                    
        }else{
            displayMenuAlumn();
            // Creamos la sentencia sql
            $sql = "SELECT * FROM cursos WHERE Data_inici>'$fechaActual' and Actiu like 'si' and Codi NOT IN ( SELECT Codi_curs FROM matricula WHERE DNI_alum like '$dni')";
            // Ejecutamos la sentencia
            $consulta = mysqli_query ($bddcon,$sql);
                // Generamos la lista con en resultado de la consulta
            $numlines = mysqli_num_rows($consulta);
            echo "<h1 class='pageTitles'>Cursos disponibles</h1>";
            displaySearchBarAlumCursosDisponibles();
            for($i=0; $i<$numlines;$i++){
                $curs= mysqli_fetch_assoc($consulta);
                $dniprof= $curs['DNI_prof'];
                $sql2 = "SELECT * FROM professor WHERE  DNI like '$dniprof'";
                $consulta2 = mysqli_query ($bddcon,$sql2);
                $prof= mysqli_fetch_assoc($consulta2);
                echo "<div class='cursDisponible'>
                    <div class='leftContent'>
                        <img src='".$curs['Foto']."'>
                    </div>
                    <div class='rightContent'>
                        <div class=' cursDispTitle'>".$curs['Nom']."</div>
                        <div class='cursDispRow cursDispDescrip'>".$curs['Descripcio']."</div>
                        <div class='cursDispRow'><img class='cursIcon' src='img/teacher.svg'> &nbsp ".$prof['Nom']." ".$prof['Cognoms']."</div>
                        <div class='cursDispRow'><div class='cursDispData'><img class='cursIcon' src='img/data.svg'> &nbsp ".$curs['Data_inici']."</div><div class='cursDispTime'> <img class='cursIcon' src='./img/time.svg'>".$curs['Horres_durara']."</div></div>
                        <div class='cursDispRow buttonContainer'><a class='matricularButon' href='matricular.php?codi=".$curs['Codi']."'>Matricular</a></div>
                    </div>
                </div>";
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


