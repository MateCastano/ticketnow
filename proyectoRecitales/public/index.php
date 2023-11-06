<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../styles/normalize.css">
    <link rel="stylesheet" href="../styles/style.css">

    <title>TicketNow</title>

</head>

<?php include("../public/conection.php"); 

    $resultado = mysqli_query($conection, "SELECT * FROM recital");
    
?>

<body>

    <header class="header">
            <a class="header-logo" href="../public/index.php">
                <img href="../public/index.php" src="../images/logo.png" alt="inicio">
                </a>
            
            <nav class="navbar">
                <ul>
                    <li><a href="../public/index.php">Inicio</a></li>
                    <li><a href="../public/nosotros.php">Nosotros</a></li>
                    <li><a href="../public/contacto.php">Contacto</a></li>
                    <li><a href="../public/account-verification.php">Mi cuenta</a></li>
                    <?php 
                        session_start();

                        if(isset($_SESSION['membresia']) && $_SESSION['membresia'] === 'Administrador')
                        {
                        echo '<li><a href="../private/admin.php">Panel de Admin</a></li>';
                            
                        }
                        
                    ?>
                </ul>
            </nav>        
    </header>

    <main class="main-buscador">

        <form class ="form-buscador" action="" method="GET">
            
            <input class="buscador" type="text" name="busqueda" placeholder="Busca tu artista favorito aqui">
        </form>

            <div class="recitales">

           
            <?php
            if ($resultado->num_rows > 0) {
                while ($row = mysqli_fetch_assoc($resultado)) {
                    echo '<div class="recital">
                        <h3>'. $row["artista"]. '</h3>
                        <img src="../images/' . $row["imagen_publicidad"] . '" alt="Imagen">

                        <b><a href="compra.php?dato=' . $row["id"] . '">Comprar</a></b>
                    </div>';
            
                }
            } 
            ?>        
            </div>

    </main>

    <footer class="footer">
        <div class="footer-links">
        <nav class="navbar">
                <ul>
                    <li><a href="../public/index.php">Inicio</a></li>
                    <li><a href="../public/nosotros.php">Nosotros</a></li>
                    <li><a href="../public/contacto.php">Contacto</a></li>
                    <li><a href="../public/account-verification.php">Mi cuenta</a></li>
                    <?php

                        if(isset($_SESSION['membresia']) && $_SESSION['membresia'] === 'Administrador')
                        {
                        echo '<li><a href="../private/admin.php">Panel de Admin</a></li>';
                            
                        }
                        
                    ?>
                </ul>
            </nav>
        </div>

    </footer>
    
</body>
</html>