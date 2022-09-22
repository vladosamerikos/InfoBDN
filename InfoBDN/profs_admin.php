<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professors</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    // Comprobamos que hemos iniciado la session
    if (isset($_SESSION["email"])){
        if ($_POST) {
            // Creamos la conexion a la bdd
            $bddcon = mysqli_connect("localhost","root","","infobdn");
            // Comprobamos que la conexion sea valida
            if ($bddcon == false){
                mysqli_connect_error();
            }else{
                // Recogemos pos datos enviados des del formulario y los guardamos en variables locales
                $nom = $_POST['search'];
                $sql = "SELECT * FROM professor WHERE Nom LIKE '$nom'";
                // Ejecutamos la sentencia
                $consulta = mysqli_query ($bddcon,$sql); 
                
                if(!$consulta){ 
                    echo mysqli_error($bddcon)."<br>"; 
                    echo "Error querry no valida ".$sql; 
                    echo "Redirigint..";
                    echo "<META HTTP-EQUIV='REFRESH' CONTENT='33333333333333;URL=profs_admin.php'>";
                }else{
                    $numlines = mysqli_num_rows($consulta);
                    // Generamos la lista con en resultado de la consulta
                    ?>
                    <div class="menu_bar">
                        <a href="main_admin.php"><img class="logo_menu" src="img/transparent_logo.svg" alt=""></a>
                        <ul class="menu_list">
                            <li><a href="./cursos_admin.php">Cursos</a></li>
                            <li><a href="./profs_admin.php">Professors</a></li>
                            <li><a href="./logout.php">Tanca sessió</a></li>
                        </ul>
                    </div>
                    <?php
                    echo "<a class='createnew_link' href='crear_prof.php'>Donar d'alta professor nou</a>";
                    echo "<div class='search_bar'>";
                        echo "<img class='search_img' src='img/search.svg' alt='lupa de busqueda'>";
                        echo "<form class='search_form' action='profs_admin.php' method='post'>";
                            echo "<input type='text' name='search' id='search' placeholder='Introdueix el nom del professor.'>";
                            echo "<button type='submit'>Buscar</button>";
                        echo "</form>";
                    echo "</div>";
                    echo "<table>";
                        echo "<tr>";
                            echo "<th>DNI</th>";
                            echo "<th>Nom</th>";
                            echo "<th>Cognoms</th>";
                            echo "<th>Titol acadèmic</th>";
                            echo "<th>Foto</th>";
                            echo "<th>Correu electronic</th>";
                            echo "<th>Actiu</th>";
                            echo "<th></th>";
                            echo "<th></th>";
                            echo "<th></th>";
                            echo "<th></th>";
                        echo "</tr>";
                        for($i=0; $i<$numlines;$i++){
                            $prof= mysqli_fetch_assoc($consulta);
                            echo "<tr>";
                                echo "<td>".$prof['DNI']."</td>";
                                echo "<td>".$prof['Nom']."</td>";
                                echo "<td>".$prof['Cognoms']."</td>";
                                echo "<td>".$prof['Titol_academic']."</td>";
                                echo "<td><img class='profile_foto' src='".$prof['Foto']."'alt='foto'></td>";
                                echo "<td>".$prof['mail']."</td>";
                                echo "<td>".$prof['Actiu']."</td>";
                                echo "<td><a href='edit_prof.php?dni=".$prof['DNI']."'><img class='link_img' src='img/edit.svg' alt='editar'></a></td>";
                                echo "<td><a href='edit_proffoto.php?dni=".$prof['DNI']."&foto=".$prof['Foto']."'><img class='link_img' src='img/editphoto.svg' alt='editar foto'></a></td>";
                                echo "<td><a href='del_prof.php?dni=".$prof['DNI']."&foto=".$prof['Foto']."'><img class='link_img' src='img/delete.svg' alt='eliminar'></a></td>";
                                if($prof['Actiu']!="si"){
                                    echo "<td><a href='prof_status.php?dni=".$prof['DNI']."&opc=act'><img class='link_img' src='img/act.svg' alt='activar'></a></td>"; 
                                }else{
                                    echo "<td><a href='prof_status.php?dni=".$prof['DNI']."&opc=desact'><img class='link_img' src='img/desact.svg' alt='desactivar'></a></td>"; 
                                }
                            echo "</tr>";     
                        }     
                    echo "</table>";                     
                }   
                
            }
        }else{
            // Creamos la conexion a la bdd
            $bddcon = mysqli_connect("localhost","root","","infobdn");
            // Comprobamos que la conexion sea valida 
            if ($bddcon == false){
                mysqli_connect_error();
            }else{
                ?>
            <div class="menu_bar">
                <a href="main_admin.php"><img class="logo_menu" src="img/transparent_logo.svg" alt=""></a>
                <ul class="menu_list">
                    <li><a href="./cursos_admin.php">Cursos</a></li>
                    <li><a href="./profs_admin.php">Professors</a></li>
                    <li><a href="./logout.php">Tanca sessió</a></li>
                </ul>
            </div>
                <?php
                // Creamos la sentencia sql
                $sql = "SELECT * FROM professor";
                // Ejecutamos la sentencia
                $consulta = mysqli_query ($bddcon,$sql);
                // Generamos la lista con en resultado de la consulta
                $numlines = mysqli_num_rows($consulta);
                echo "<a class='createnew_link' href='crear_prof.php'>Donar d'alta professor nou</a>";
                echo "<div class='search_bar'>";
                    echo "<img class='search_img' src='img/search.svg' alt='lupa de busqueda'>";
                    echo "<form class='search_form' action='profs_admin.php' method='post'>";
                        echo "<input type='text' name='search' id='search' placeholder='Introdueix el nom del professor.'>";
                        echo "<button type='submit'>Buscar</button>";
                    echo "</form>";
                echo "</div>";
                echo "<table>";
                    echo "<tr>";
                        echo "<th>DNI</th>";
                        echo "<th>Nom</th>";
                        echo "<th>Cognoms</th>";
                        echo "<th>Titol acadèmic</th>";
                        echo "<th>Foto</th>";
                        echo "<th>Correu electronic</th>";
                        echo "<th>Actiu</th>";
                        echo "<th></th>";
                        echo "<th></th>";
                        echo "<th></th>";
                        echo "<th></th>";
                    echo "</tr>";
                for($i=0; $i<$numlines;$i++){
                    $prof= mysqli_fetch_assoc($consulta);
                    echo "<tr>";
                        echo "<td>".$prof['DNI']."</td>";
                        echo "<td>".$prof['Nom']."</td>";
                        echo "<td>".$prof['Cognoms']."</td>";
                        echo "<td>".$prof['Titol_academic']."</td>";
                        echo "<td><img class='profile_foto' src='".$prof['Foto']."'alt='foto'></td>";
                        echo "<td>".$prof['mail']."</td>";
                        echo "<td>".$prof['Actiu']."</td>";
                        echo "<td><a href='edit_prof.php?dni=".$prof['DNI']."'><img class='link_img' src='img/edit.svg' alt='editar'></a></td>";
                        echo "<td><a href='edit_proffoto.php?dni=".$prof['DNI']."&foto=".$prof['Foto']."'><img class='link_img' src='img/editphoto.svg' alt='editar foto'></a></td>";
                        echo "<td><a href='del_prof.php?dni=".$prof['DNI']."&foto=".$prof['Foto']."'><img class='link_img' src='img/delete.svg' alt='eliminar'></a></td>";
                        if($prof['Actiu']!="si"){
                            echo "<td><a href='prof_status.php?dni=".$prof['DNI']."&opc=act'><img class='link_img' src='img/act.svg' alt='activar'></a></td>"; 
                        }else{
                            echo "<td><a href='prof_status.php?dni=".$prof['DNI']."&opc=desact'><img class='link_img' src='img/desact.svg' alt='desactivar'></a></td>"; 
                        }
                    echo "</tr>";     
                }
                echo "</table>";
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



