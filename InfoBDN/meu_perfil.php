<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Perfil d'usuari</title>
</head>

<body>
    <?php
    include "functions.php";
    // Comprobamos que hemos iniciado la session
    if (isset($_SESSION["email"]) && ($_SESSION["role"]=="prof" || $_SESSION["role"]=="alum")) {
        $bddcon = getBddConn();
        $email = $_SESSION['email'];
        if ($_SESSION['role'] == 'alum') {
            $table = 'alumnes';
        } elseif ($_SESSION['role'] == 'prof') {
            $table = 'professor';
        }
        // Creamos la sentencia sql
        $sql = "SELECT * FROM $table WHERE Mail like '$email'";
        // Ejecutamos la sentencia
        $consulta = mysqli_query($bddcon, $sql);
        $perfil = mysqli_fetch_assoc($consulta);
        // Generamos el contenido de la pagina
        if ($_SESSION['role'] == 'alum') {
            displayMenuAlumn();
        } elseif ($_SESSION['role'] == 'prof') {
            displayMenuProf();
        }
        $foto = $perfil['Foto'];

        echo "<h1 class='pageTitles'>Meu Perfil</h1>
        <div class='profileContent'>
            <div class='profilePhoto'>
                <img class='roundProfilePhoto' src='$foto'>
                <p class='profileName'>".$perfil['Nom']." ".$perfil['Cognoms']."</p>
                <a class='bntEditProfile' href='edit_profilefoto.php?mail=".$perfil['Mail']."'>Editar Foto</a>
            </div>
            <div class='profileInfo'>
                <div class='profileRow'>
                    <div class='rowTitle'>Nom Complet</div><div class='rowContent'>".$perfil['Nom']." ".$perfil['Cognoms']."</div>
                </div>
                <hr>
                <div class='profileRow'>
                    <div class='rowTitle'>Correu Electronic</div><div class='rowContent'>".$perfil['Mail']."</div>
                </div>
                <hr>
                <div class='profileRow'>
                    <div class='rowTitle'>DNI</div><div class='rowContent'>".$perfil['DNI']."</div>
                </div>
                <hr>
                <div class='profileRow'>
                    <div class='rowTitle'>Edat</div><div class='rowContent'>".$perfil['Edat']."</div>
                </div>
                <hr>
                <div class='profileRow'>
                <a class='bntEditProfile' href='edit_profileinfo.php?mail=".$perfil['Mail']."'>Editar</a>
                </div>
            <div>
        </div>";
    } else {
        // Mostramos mensaje y redirigimos a la pagina de login en el caso de session no iniciada
        echo "<p>Has d'estar valiat per veure aquesta pàgina</p>";
        echo "<META HTTP-EQUIV='REFRESH' CONTENT='2;URL=index.php'>";
    }
    ?>
</body>

</html>