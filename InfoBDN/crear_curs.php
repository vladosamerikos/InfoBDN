<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear curs</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    include "functions.php";
    $bddcon= getBddConn();
    // Comprobamos que hemos iniciado la session
    if (isset($_SESSION["email"]) && $_SESSION["role"]=="admin"){
            if ($_POST) {
                // Recogemos pos datos enviados des del formulario y los guardamos en variables locales
                $codi = $_POST['codi'];
                $nom = $_POST['nom'];
                $descrip = $_POST['descrip'];
                $hdurara = $_POST['hdurara'];
                $dinici = $_POST['dinici'];
                $dfinal = $_POST['dfinal'];
                $dniprof = $_POST['dniprof'];

                if (is_uploaded_file ($_FILES['foto']['tmp_name'])){
                    $nombreDirectorio = "img/";
                    $idUnico = $codi;
                    $nomorig=$_FILES['foto']['name'];
                    $cont=explode(".",$nomorig);
                    $ext= $cont[1];
                    $nombreFichero = $idUnico.".".$ext;
                    move_uploaded_file ($_FILES['foto']['tmp_name'],
                    $nombreDirectorio.$nombreFichero);
                    $sql = "INSERT INTO cursos VALUES ('$codi', '$nom', '$descrip', '$hdurara', '$dinici', '$dfinal', '$dniprof', 'si', 'img/$nombreFichero')";
                }else{
                    print ("<p>No has subido foto nueva</p>");
                    $sql = "INSERT INTO cursos VALUES ('$codi', '$nom', '$descrip', '$hdurara', '$dinici', '$dfinal', '$dniprof', 'si', '')";
                }
                // Ejecutamos la sentencia
                $consulta = mysqli_query ($bddcon,$sql);  
                // Controlamos posibles errores
                if(!$consulta){ 
                    echo mysqli_error($bddcon)."<br>"; 
                    echo "Error querry no valida ".$sql; 
                    echo "Redirigint..";
                    echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=crear_curs.php'>";
                }else{
                    echo "Curs creat exitosament!!!";
                    echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=cursos_admin.php'>";
                }      
            }else{
                
                // Creamos la sentencia sql
                $sql = "SELECT DNI, Nom, Cognoms FROM professor WHERE Actiu like 'si'";
                // Ejecutamos la sentencia
                $consulta = mysqli_query ($bddcon,$sql);  
                // Controlamos posibles errores
                if(!$consulta){ 
                    echo mysqli_error($bddcon)."<br>"; 
                    echo "Error querry no valida ".$sql; 
                    echo "Redirigint..";
                    echo "<META HTTP-EQUIV='REFRESH' CONTENT='3;URL=cursos_admin.php'>";
                }else{
                    displayMenuAdmin();
                    echo "<form class='big_form form'  ENCTYPE='multipart/form-data' action='crear_curs.php' method='post'>
                        <h1> Crear curs </h1>
                        <p>Foto<input required type='file' name='foto' id='foto' accept='image/*'></p>
                        <p>Codi<input required type='number' name='codi' id='codi'></p>
                        <p>Nom<input required type='text' name='nom' id='nom'></p>
                        <p>Descripció<input required type='text' name='descrip' id='descrip'></p>
                        <p>Hores que durará<input required type='number' name='hdurara' id='hdurara'></p>
                        <p>Data d'inici<input required type='date' name='dinici' id='dinici'></p>
                        <p>Data de final<input required type='date' name='dfinal' id='dfinal'></p>
                        <p>Professor que imparteix<select required name='dniprof' id='dniprof'>";
                        $numlines = mysqli_num_rows($consulta);
                        for($i=0; $i<$numlines;$i++){
                            $dni= mysqli_fetch_assoc($consulta);
                            ?>
                            <option value="<?php echo $dni['DNI']?>"><?php echo $dni['DNI']." - ".$dni['Nom']." ".$dni['Cognoms']?></option>
                            <?php
                        }
                        echo "</select></p>";
                        echo "<p><button class='submit_button' type='submit'>Crear</button></p>";       
                    echo "</form>";
                }   
            }
    }else{
        // Mostramos mensaje y redirigimos a la pagina de login en el caso de session no iniciada
        echo "<p>Has d'estar valiat per veure aquesta pàgina</p>";
        echo "<META HTTP-EQUIV='REFRESH' CONTENT='3;URL=index.php'>";
    }    
        
    ?>

</body>
</html>