<?php
// Creamos la conexion a la bdd
function getBddConn()
{
    $bddcon = mysqli_connect("localhost", "root", "", "infobdn");
    // Comprobamos que la conexion sea valida
    if ($bddcon == false) {
        return mysqli_connect_error();
    } else {
        return $bddcon;
    }
}

function displayMenuAdmin()
{
?>
    <div class="menu_bar">
        <a href="main_admin.php"><img class="logo_menu" src="img/transparent_logo.svg" alt=""></a>
        <div class='menuWelcomeMsg'>
            Estàs loguejat com a administrador <?php echo  $_SESSION['email'] ?>
        </div>
        <ul class="menu_list">
            <li><a href="./cursos_admin.php">Cursos</a></li>
            <li><a href="./profs_admin.php">Professors</a></li>
            <li><a href="./logout.php"><img class='menuicon' src="./img/sessionclose.svg" alt="Tancar sessió"></a></li>
        </ul>
    </div>
<?php
}

function displayMenuAlumn()
{
?>
    <div class="menu_bar">
        <a href="main_alu.php"><img class="logo_menu" src="img/transparent_logo.svg" alt=""></a>
        <div class='menuWelcomeMsg'>
            Estàs loguejat com alumne <?php echo  $_SESSION['nom'] . " " . $_SESSION['cognoms'] ?>
        </div>
        <ul class="menu_list">
            <li><a href="./llistatcursos_alu.php">Cursos disponibles</a></li>
            <li><a href="./micursos_alu.php">Meus cursos</a></li>
            <li><a href="./minotes_alu.php">Notes</a></li>
            <li><a href="./meu_perfil.php"><img class='menuicon' src="./img/profile.svg" alt="Perfil"></a></li>
            <li><a href="./logout.php"><img class='menuicon' src="./img/sessionclose.svg" alt="Tancar sessió"></a></li>
        </ul>
    </div>
<?php
}

function displayMenuProf()
{
?>
    <div class="menu_bar">
        <a href="main_prof.php"><img class="logo_menu" src="img/transparent_logo.svg" alt=""></a>
        <div class='menuWelcomeMsg'>
            Estàs loguejat com a professor <?php echo  $_SESSION['nom'] . " " . $_SESSION['cognoms'] ?>
        </div>
        <ul class="menu_list">
            <li><a href="./cursos_prof.php">Cursos Actius</a></li>
            <li><a href="./alumnes_prof.php">Alumnes</a></li>
            <li><a href="./notes_prof.php">Notes</a></li>
            <li><a href="./meu_perfil.php"><img class='menuicon' src="./img/profile.svg" alt="Perfil"></a></li>
            <li><a href="./logout.php"><img class='menuicon' src="./img/sessionclose.svg" alt="Tancar sessió"></a></li>
        </ul>
    </div>
<?php
}

function displaySearchBarAdminProfs()
{
    echo "<div class='search_bar'>
            <img class='search_img' src='img/search.svg' alt='lupa de busqueda'>
            <form class='search_form' action='profs_admin.php' method='post'>
                <input type='text' name='search' id='search' placeholder='Introdueix el nom del professor.'>
                <button type='submit'>Buscar</button>
            </form>
        </div>";
}

function displaySearchBarAdminCursos()
{
    echo "<div class='search_bar'>
            <img class='search_img' src='img/search.svg' alt='lupa de busqueda'>
            <form class='search_form' action='cursos_admin.php' method='post'>
                <input type='text' name='search' id='search' placeholder='Introdueix el nom del curs.'>
                <button type='submit'>Buscar</button>
            </form>
        </div>";
}

function displaySearchBarProfCursos()
{
    echo "<div class='search_bar'>
            <img class='search_img' src='img/search.svg' alt='lupa de busqueda'>
            <form class='search_form' action='cursos_prof.php' method='post'>
                <input type='text' name='search' id='search' placeholder='Introdueix el nom del curs.'>
                <button type='submit'>Buscar</button>
            </form>
        </div>";
}

function displaySearchBarProfAlumnes()
{
    echo "<div class='search_bar'>
            <img class='search_img' src='img/search.svg' alt='lupa de busqueda'>
            <form class='search_form' action='alumnes_prof.php' method='post'>
                <input type='text' name='search' id='search' placeholder='Introdueix el nom del curs.'>
                <button type='submit'>Buscar</button>
            </form>
        </div>";
}

function displaySearchBarProfNotes()
{
    echo "<div class='search_bar'>
            <img class='search_img' src='img/search.svg' alt='lupa de busqueda'>
            <form class='search_form' action='notes_prof.php' method='post'>
                <input type='text' name='search' id='search' placeholder='Introdueix el nom del curs.'>
                <button type='submit'>Buscar</button>
            </form>
        </div>";
}

function displaySearchBarAlumCursosDisponibles()
{
    echo "<div class='search_bar'>
            <img class='search_img' src='img/search.svg' alt='lupa de busqueda'>
            <form class='search_form' action='llistatcursos_alu.php' method='post'>
                <input type='text' name='search' id='search' placeholder='Introdueix el nom del curs.'>
                <button type='submit'>Buscar</button>
            </form>
        </div>";
}

function displaySearchBarAlumCursosMatriculats()
{
    echo "<div class='search_bar'>
            <img class='search_img' src='img/search.svg' alt='lupa de busqueda'>
            <form class='search_form' action='micursos_alu.php' method='post'>
                <input type='text' name='search' id='search' placeholder='Introdueix el nom del curs.'>
                <button type='submit'>Buscar</button>
            </form>
        </div>";
}
function displaySearchBarAlumCursosNotes()
{
    echo "<div class='search_bar'>
            <img class='search_img' src='img/search.svg' alt='lupa de busqueda'>
            <form class='search_form' action='minotes_alu.php' method='post'>
                <input type='text' name='search' id='search' placeholder='Introdueix el nom del curs.'>
                <button type='submit'>Buscar</button>
            </form>
        </div>";
}



?>