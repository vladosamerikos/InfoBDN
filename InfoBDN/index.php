<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Inici de sessió </title>
</head>
<body>
    <?php 
    include "functions.php";
        // Creamos la conexion a la bdd
        $bddcon = getBddConn();
        // En el caso de que la pagina ha recivido datos POST genera sentencia sql que compruba si los datos coinciden con algun registro en la BD.
        if ($_POST) {
            // Recogemos pos datos enviados des del formulario y los guardamos en variables locales
            $email = $_POST['email'];
            $password = $_POST['password'];
            $usu = $_POST['usu'];
            $md5pass = md5($password);
            // Creamos la sentencia sql
            if($usu=='alum'){
                $sql = "SELECT * FROM alumnes WHERE Mail LIKE '$email' AND Password LIKE '$md5pass' ";
                // Ejecutamos la sentencia
                $consulta = mysqli_query ($bddcon,$sql);  
                // Controlamos posibles errores
                if(!$consulta){ 
                    echo mysqli_error($bddcon)."<br>"; 
                    echo "Error querry no valida ".$sql; 
                    echo "Redirigint..";
                    echo "<META HTTP-EQUIV='REFRESH' CONTENT='33333;URL=index.php'>";
                }else{
                    $alumne= mysqli_fetch_assoc($consulta);
                    $num_rows= mysqli_num_rows($consulta);
                    if ($num_rows== 1){
                        $_SESSION["email"]= $email;
                        $_SESSION["dni"]= $alumne['DNI'];
                        $_SESSION["role"]=$usu;
                        $_SESSION["nom"]= $alumne['Nom'];
                        $_SESSION["cognoms"]= $alumne['Cognoms'];
                        echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=main_alu.php'>";
                    }else{
                        echo $sql;
                        echo "<p>Les dades són incorrectes!</p>";
                        echo "<p>Intenta de nou ...</p>";
                        echo "<META HTTP-EQUIV='REFRESH' CONTENT='3333;URL=index.php'>";
                    }
                }   
            }else{
                $sql = "SELECT * FROM professor WHERE Mail like '$email' AND password like '$md5pass' ";
                // Ejecutamos la sentencia
                $consulta = mysqli_query ($bddcon,$sql);  
                // Controlamos posibles errores
                if(!$consulta){ 
                    echo mysqli_error($bddcon)."<br>"; 
                    echo "Error querry no valida ".$sql; 
                    echo "Redirigint..";
                    echo "<META HTTP-EQUIV='REFRESH' CONTENT='333333;URL=index.php'>";
                }else{
                    $prof= mysqli_fetch_assoc($consulta);
                    $num_rows= mysqli_num_rows($consulta);
                    if ($num_rows== 1){
                        $_SESSION["email"]= $email;
                        $_SESSION["dni"]= $prof['DNI'];
                        $_SESSION["role"]=$usu;
                        $_SESSION["nom"]= $prof['Nom'];
                        $_SESSION["cognoms"]= $prof['Cognoms'];
                        echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=main_prof.php'>";
                    }else{
                        echo "<p>Les dades són incorrectes!</p>";
                        echo "<p>Intenta de nou ...</p>";
                        echo "<META HTTP-EQUIV='REFRESH' CONTENT='333333;URL=index.php'>";
                    }
                }   
            }    
        }else{
            // Generamos el formulario de login
            ?>
            <img class="logo" src="img/logo.svg" alt="">
            <form class="form" action='index.php' method='post'>
            <h1> Inici de sessió</h1>
            <p><input type='email' name='email' id='email' placeholder="Correu electronic" require></p>
            <p><input type='password' name='password' id='password' placeholder="Password" require></p> 
            <p><input checked  type="radio" id="alum" name="usu" value="alum">Alumne <input type="radio" id="prof" name="usu" value="prof">Professor</p>
            <p><a class='doble_button' href="signin_usu.php">Crear compte</a><button class="doble_button" type='submit'>Iniciar sessió</button></p>   
            <a class="custom_link" href="login_admin.php">Manteniment</a> 
            </form>
            <?php
        }
        
    ?>

</body>
</html>