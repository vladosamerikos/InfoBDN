<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cursos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    // Comprobamos que hemos iniciado la session
    if (isset($_SESSION["email"])){
        if($_POST){
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
                $nom= $_POST['search'];
                // Creamos la sentencia sql
                $sql = "SELECT * FROM cursos WHERE Nom LIKE '$nom' ";
                // Ejecutamos la sentencia
                $consulta = mysqli_query ($bddcon,$sql); 
                if(!$consulta){ 
                    echo mysqli_error($bddcon)."<br>"; 
                    echo "Error querry no valida ".$sql; 
                    echo "Redirigint..";
                    echo "<META HTTP-EQUIV='REFRESH' CONTENT='33333333333333;URL=profs_admin.php'>";
                }else{
                     // Generamos la lista con en resultado de la consulta
                    $numlines = mysqli_num_rows($consulta);
                    echo "<a class='createnew_link' href='crear_curs.php'>Donar d'alta curs nou</a>";
                    echo "<div class='search_bar'>";
                        echo "<img class='search_img' src='img/search.svg' alt='lupa de busqueda'>";
                        echo "<form class='search_form' action='cursos_admin.php' method='post'>";
                            echo "<input type='text' name='search' id='search' placeholder='Introdueix el nom del curs.'>";
                            echo "<button type='submit'>Buscar</button>";
                        echo "</form>";
                    echo "</div>";
                    echo "<table>";
                        echo "<tr>";
                            echo "<th>Codi</th>";
                            echo "<th>Nom</th>";
                            echo "<th>Descripció</th>";
                            echo "<th>Hores durara</th>";
                            echo "<th>Data inici</th>";
                            echo "<th>Data final</th>";
                            echo "<th>DNI professor</th>";
                            echo "<th>Actiu</th>";
                            echo "<th></th>";
                            echo "<th></th>";
                            echo "<th></th>";
                        echo "</tr>";
                    for($i=0; $i<$numlines;$i++){
                        $curs= mysqli_fetch_assoc($consulta);
                        echo "<tr>";
                            echo "<td>".$curs['Codi']."</td>";
                            echo "<td>".$curs['Nom']."</td>";
                            echo "<td>".$curs['Descripcio']."</td>";
                            echo "<td>".$curs['Horres_durara']."</td>";
                            echo "<td>".$curs['Data_inici']."</td>";
                            echo "<td>".$curs['Data_final']."</td>";
                            echo "<td>".$curs['DNI_prof']."</td>";
                            echo "<td>".$curs['Actiu']."</td>";
                            echo "<td><a href='edit_curs.php?codi=".$curs['Codi']."'><img class='link_img' src='img/edit.svg' alt='editar'></a></td>";
                            echo "<td><a href='del_curs.php?codi=".$curs['Codi']."'><img class='link_img' src='img/delete.svg' alt='eliminar'></a></td>";
                            if($curs['Actiu']!="si"){
                                echo "<td><a href='cursos_status.php?codi=".$curs['Codi']."&opc=act'><img class='link_img' src='img/act.svg' alt='activar'></a></td>"; 
                            }else{
                                echo "<td><a href='cursos_status.php?codi=".$curs['Codi']."&opc=desact'><img class='link_img' src='img/desact.svg' alt='desactivar'></a></td>"; 
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
                $sql = "SELECT * FROM cursos";
                // Ejecutamos la sentencia
                $consulta = mysqli_query ($bddcon,$sql);
                 // Generamos la lista con en resultado de la consulta
                $numlines = mysqli_num_rows($consulta);
                echo "<a class='createnew_link' href='crear_curs.php'>Donar d'alta curs nou</a>";
                echo "<div class='search_bar'>";
                    echo "<img class='search_img' src='img/search.svg' alt='lupa de busqueda'>";
                    echo "<form class='search_form' action='cursos_admin.php' method='post'>";
                        echo "<input type='text' name='search' id='search' placeholder='Introdueix el nom del curs.'>";
                        echo "<button type='submit'>Buscar</button>";
                    echo "</form>";
                echo "</div>";
                echo "<table>";
                    echo "<tr>";
                        echo "<th>Codi</th>";
                        echo "<th>Nom</th>";
                        echo "<th>Descripció</th>";
                        echo "<th>Hores durara</th>";
                        echo "<th>Data inici</th>";
                        echo "<th>Data final</th>";
                        echo "<th>DNI professor</th>";
                        echo "<th>Actiu</th>";
                        echo "<th></th>";
                        echo "<th></th>";
                        echo "<th></th>";
                    echo "</tr>";
                for($i=0; $i<$numlines;$i++){
                    $curs= mysqli_fetch_assoc($consulta);
                    echo "<tr>";
                        echo "<td>".$curs['Codi']."</td>";
                        echo "<td>".$curs['Nom']."</td>";
                        echo "<td>".$curs['Descripcio']."</td>";
                        echo "<td>".$curs['Horres_durara']."</td>";
                        echo "<td>".$curs['Data_inici']."</td>";
                        echo "<td>".$curs['Data_final']."</td>";
                        echo "<td>".$curs['DNI_prof']."</td>";
                        echo "<td>".$curs['Actiu']."</td>";
                        echo "<td><a href='edit_curs.php?codi=".$curs['Codi']."'><img class='link_img' src='img/edit.svg' alt='editar'></a></td>";
                        echo "<td><a href='del_curs.php?codi=".$curs['Codi']."'><img class='link_img' src='img/delete.svg' alt='eliminar'></a></td>";
                        if($curs['Actiu']!="si"){
                            echo "<td><a href='cursos_status.php?codi=".$curs['Codi']."&opc=act'><img class='link_img' src='img/act.svg' alt='activar'></a></td>"; 
                        }else{
                            echo "<td><a href='cursos_status.php?codi=".$curs['Codi']."&opc=desact'><img class='link_img' src='img/desact.svg' alt='desactivar'></a></td>"; 
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



