<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar curs</title>
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
                $codi = $_POST['codi'];
                $nom = $_POST['nom'];
                $descrip = $_POST['descrip'];
                $hdurara = $_POST['hdurara'];
                $dinici = $_POST['dinici'];
                $dfinal = $_POST['dfinal'];
                $dniprof = $_POST['dniprof'];

                // Creamos la sentencia sql
                $sql = "UPDATE cursos SET Nom='$nom', Descripcio='$descrip', Horres_durara='$hdurara', Data_inici='$dinici', Data_final='$dfinal', DNI_prof='$dniprof' WHERE Codi='$codi'";
                // Ejecutamos la sentencia
                $consulta = mysqli_query ($bddcon,$sql);  
                // Controlamos posibles errores
                if(!$consulta){ 
                    echo mysqli_error($bddcon)."<br>"; 
                    echo "Error querry no valida ".$sql; 
                    echo "Redirigint..";
                    echo "<META HTTP-EQUIV='REFRESH' CONTENT='99999999999999999993;URL=cursos_admin.php'>";
                }else{
                   echo "Curs modificat exitosament!!!";
                   echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=cursos_admin.php'>";
                }
            }
        }else{
            // Comprobamos si nos han pasado dotos por request
            if ($_REQUEST['codi']) {
                // Creamos la conexion a la bdd
                $bddcon = mysqli_connect("localhost","root","","infobdn");
                // Comprobamos que la conexion sea valida
                if ($bddcon == false){
                    mysqli_connect_error();
                }else{
                    // Recogemos pos datos enviados des del formulario y los guardamos en variables locales
                    $codi = $_REQUEST['codi'];
                    // Creamos la sentencia sql
                    $sql = "SELECT * FROM cursos WHERE Codi = $codi";
                    $sqldni = "SELECT DNI, Nom, Cognoms FROM professor";
                    // Ejecutamos la sentencia
                    $consulta = mysqli_query ($bddcon,$sql);  
                    // Controlamos posibles errores
                    if(!$consulta){ 
                        echo mysqli_error($bddcon)."<br>"; 
                        echo "Error querry no valida ".$sql; 
                        echo "Redirigint..";
                        echo "<META HTTP-EQUIV='REFRESH' CONTENT='99999999999999999993;URL=crear_curs.php'>";
                    }else{
                        $curs= mysqli_fetch_assoc($consulta);

                        echo "<form class='big_form' action='edit_curs.php' method='post'>";
                            echo "<h1> Modificar curs </h1>";
                            echo "<p>Codi<input type='text' name='codi' id='codi' value='".$curs['Codi']."' readonly></p>";
                            echo "<p>Nom<input type='text' name='nom' id='nom' value='".$curs['Nom']."'></p>";
                            echo "<p>Descripció<input type='text' name='descrip' id='descrip' value='".$curs['Descripcio']."'></p>";
                            echo "<p>Hores que durará<input type='number' name='hdurara' id='hdurara' value='".$curs['Horres_durara']."'></p>";
                            echo "<p>Data d'inici<input type='date' name='dinici' id='dinici' value='".$curs['Data_inici']."'></p>";
                            echo "<p>Data de final<input type='date' name='dfinal' id='dfinal' value='".$curs['Data_final']."'></p>";
                            echo "<p>Professor que imparteix<select name='dniprof' id='dniprof'>";
                            $consultadni = mysqli_query ($bddcon,$sqldni);
                            $numlines = mysqli_num_rows($consultadni);
                            for($i=0; $i<$numlines;$i++){
                                $dni= mysqli_fetch_assoc($consultadni);
                                if ($dni['DNI']==$curs['DNI_prof']){
                                    ?>
                                    <option selected value="<?php echo $dni['DNI']?>"><?php echo $dni['DNI']." - ".$dni['Nom']." ".$dni['Cognoms']?></option>
                                    <?php
                                }else{
                                    ?>
                                    <option value="<?php echo $dni['DNI']?>"><?php echo $dni['DNI']." - ".$dni['Nom']." ".$dni['Cognoms']?></option>
                                    <?php
                                }
                            }
                            echo "</select></p>";
                            echo "<p><button class='submit_button' type='submit'>Modificar</button></p>";
                        echo "</form>";                     
                    }   
                } 
            }else{
                echo "No hem pogut obtenir el id del curs";
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