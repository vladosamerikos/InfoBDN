<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes cursos</title>
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
            echo "<h1 class='pageTitles'>Notes</h1>";
            $nom= $_POST['search'];
            // Creamos la sentencia sql
            $sql = "SELECT * FROM cursos WHERE Nom LIKE '%$nom%' and Actiu like 'si' and Data_final<'$fechaActual' and Codi IN ( SELECT Codi_curs FROM matricula WHERE DNI_alum like '$dni')";
            // Ejecutamos la sentencia
            $consulta = mysqli_query ($bddcon,$sql); 
            $numlines = mysqli_num_rows($consulta);
            displaySearchBarAlumCursosNotes();
            for($i=0; $i<$numlines;$i++){
                $curs= mysqli_fetch_assoc($consulta);
                $dniprof= $curs['DNI_prof'];
                $sql2 = "SELECT * FROM professor WHERE  DNI like '$dniprof'";
                $consulta2 = mysqli_query ($bddcon,$sql2);
                $prof= mysqli_fetch_assoc($consulta2);
                if (isset($curs['nota'])){
                    $nota=$curs['nota'];
                }else{
                    $nota='0';
                }
                echo "<div class='cursDisponible'>
                    <div class='leftContent'>
                        <img src='".$curs['Foto']."'>
                    </div>
                    <div class='rightContent'>
                        <div class=' cursDispTitle'>".$curs['Nom']."</div>
                        <div class='cursDispRow cursDispDescrip'>".$curs['Descripcio']."</div>
                        <div class='cursDispRow'><img class='cursIcon' src='img/teacher.svg'> &nbsp ".$prof['Nom']." ".$prof['Cognoms']."</div>
                        <div class='cursDispRow'><div class='cursDispData'>Curs acabat: ".$curs['Data_final']."</div><div class='cursDispTime'> <img class='cursIcon' src='./img/nota.svg'> &nbsp". $nota."</div></div>
                    </div>
                </div>";
            }                    
        }else{
            displayMenuAlumn();
            echo "<h1 class='pageTitles'>Notes</h1>";
            // Creamos la sentencia sql
            $sql = "SELECT * FROM cursos WHERE Actiu like 'si' and Data_final<'$fechaActual' and Codi IN ( SELECT Codi_curs FROM matricula WHERE DNI_alum like '$dni')";
            // Ejecutamos la sentencia
            $consulta = mysqli_query ($bddcon,$sql);
            // Generamos la lista con en resultado de la consulta
            $numlines = mysqli_num_rows($consulta);
            displaySearchBarAlumCursosNotes();
            for($i=0; $i<$numlines;$i++){
                $curs= mysqli_fetch_assoc($consulta);
                $dniprof= $curs['DNI_prof'];
                $sql2 = "SELECT * FROM professor WHERE  DNI like '$dniprof'";
                $consulta2 = mysqli_query ($bddcon,$sql2);
                $prof= mysqli_fetch_assoc($consulta2);
                if (isset($curs['nota'])){
                    $nota=$curs['nota'];
                }else{
                    $nota='0';
                }
                echo "<div class='cursDisponible'>
                    <div class='leftContent'>
                        <img src='".$curs['Foto']."'>
                    </div>
                    <div class='rightContent'>
                        <div class=' cursDispTitle'>".$curs['Nom']."</div>
                        <div class='cursDispRow cursDispDescrip'>".$curs['Descripcio']."</div>
                        <div class='cursDispRow'><img class='cursIcon' src='img/teacher.svg'> &nbsp ".$prof['Nom']." ".$prof['Cognoms']."</div>
                        <div class='cursDispRow'><div class='cursDispData'><img class='cursIcon' src='img/enddate.svg'> &nbsp&nbsp".$curs['Data_final']."</div><div class='cursDispTime'> <img class='cursIcon' src='./img/nota.svg'> &nbsp". $nota."</div></div>
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