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
                $oldfoto = $_POST['oldfoto'];
                // Eliminamos el arxivo de la foto aterior
                if ($oldfoto!=''){
                    if (unlink($oldfoto)) {
                        echo"<p>Foto anterior eliminada exitosamente</p>";
                    } else {
                        echo"<p>Error a la hora de eliminar la foto</p>";
                    }
                }else{
                    echo"<p>El usuario no tenia foto</p>";
                }  

                if (is_uploaded_file ($_FILES['foto']['tmp_name'])){
                    $nombreDirectorio = "img/";
                    $idUnico = $dni;
                    $nomorig=$_FILES['foto']['name'];
                    $cont=explode(".",$nomorig);
                    $ext= $cont[1];
                    $nombreFichero = $idUnico.".".$ext;
                    move_uploaded_file ($_FILES['foto']['tmp_name'],
                    $nombreDirectorio.$nombreFichero);
                    $sql = "UPDATE professor SET Foto='img/$nombreFichero' WHERE DNI LIKE '$dni'";
                }else{
                    print ("<p>No has subido foto nueva</p>");
                    $sql = "UPDATE professor SET Foto='' WHERE DNI LIKE '$dni'";
                }
                // Ejecutamos la sentencia
                $consulta = mysqli_query ($bddcon,$sql);  
                // Controlamos posibles errores
                if(!$consulta){ 
                    echo mysqli_error($bddcon)."<br>"; 
                    echo "Error querry no valida ".$sql; 
                    echo "Redirigint..";
                    echo "<META HTTP-EQUIV='REFRESH' CONTENT='2;URL=profs_admin.php'>";
                }else{
                   echo "Foto modificada exitosament!!!";
                   echo "<META HTTP-EQUIV='REFRESH' CONTENT='2;URL=profs_admin.php'>";
                }
            }
        }else{
            // Comprobamos si nos han pasado dotos por request
            if ($_REQUEST['dni']) {
                $dni= $_REQUEST['dni'];
                $oldfoto= $_REQUEST['foto']; 
                echo "<form action='edit_proffoto.php' ENCTYPE='multipart/form-data' method='post'>";
                    echo "<h1> Modificar foto professor </h1>";
                    echo "<p><img with='150px' height='150px' src='$oldfoto' alt='No té foto'></p>";
                    echo "<input readonly class='ocult' type='text' name='dni' id='dni' value='$dni'>";
                    echo "<input readonly class='ocult' type='text' name='oldfoto' id='oldfoto' value='$oldfoto'>";
                    echo "<p><input required type='file' name='foto' id='foto' accept='image/*'></p>";
                    echo "<p><button class='submit_button' type='submit' >Modificar</button></p>";       
                echo "</form>";                   

            }else{
                echo "No hem pogut obtenir el DNI del professor";
                echo "<META HTTP-EQUIV='REFRESH' CONTENT='3;URL=profs_admin.php'>";
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