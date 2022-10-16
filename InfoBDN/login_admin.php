<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login admin</title>
</head>

<body>
    <?php
    include "functions.php";
    $bddcon = getBddConn();
    if ($_POST) {

        // Recogemos pos datos enviados des del formulario y los guardamos en variables locales
        $email = $_POST['email'];
        $password = $_POST['password'];
        $md5pass = md5($password);
        // Creamos la sentencia sql
        $sql = "SELECT * FROM admins WHERE Mail = '$email' AND password = '$md5pass' ";
        // Ejecutamos la sentencia
        $consulta = mysqli_query($bddcon, $sql);
        // Controlamos posibles errores
        if (!$consulta) {
            echo mysqli_error($bddcon) . "<br>";
            echo "Error querry no valida " . $sql;
            echo "Redirigint..";
            echo "<META HTTP-EQUIV='REFRESH' CONTENT='3;URL=login_admin.php'>";
        } else {
            $num_rows = mysqli_num_rows($consulta);
            if ($num_rows == 1) {
                $_SESSION["email"] = $email;
                $_SESSION["role"] = 'admin';
                echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=main_admin.php'>";
            } else {
                echo "<p>Les dades són incorrectes!</p>";
                echo "<p>Intenta de nou ...</p>";
                echo "<META HTTP-EQUIV='REFRESH' CONTENT='3;URL=login_admin.php'>";
            }
        }
    } else {
        // Generamos el formulario de login
    ?>
        <img class="logo" src="img/logo.svg" alt="">
        <form class='form' action='login_admin.php' method='post'>
            <h1> Inici de sessió admin</h1>
            <p><input type='email' name='email' id='email' placeholder="Correu electronic" require></p>
            <p><input type='password' name='password' id='password' placeholder="Password" require></p>
            <p class='butons_line'><a class='doble_button' href="index.php">No soc admin</a><button class="doble_button" type='submit'>Iniciar sessió</button></p>
        </form>
    <?php
    }

    ?>

</body>

</html>