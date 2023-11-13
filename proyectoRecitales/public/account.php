<?php session_start();?>
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

                        if(isset($_SESSION['membresia']) && $_SESSION['membresia'] === 'Administrador')
                        {
                        echo '<li><a href="../private/admin.php">Panel de Admin</a></li>';
                            
                        }
                        
                    ?>
                </ul>
            </nav>        
    </header>     
    <!-- Datos de la cuenta -->
    <div class="account-data">
        <h2>MI CUENTA</h2>
        <div class="secciones">
                <div class="seccion">   
                    <h3>NOMBRE:</h3>
                    <h3>APELLIDO:</h3>
                    <h3>NOMBRE DE USUARIO:</h3>
                    <h3>EMAIL:</h3>
                    <h3>MEMBRESIA:</h3>
                </div>
                <div class="seccion">
                    <?php 
                        echo  "<h3 class='dato'>".$_SESSION['nombre']."</h3>";
                        echo  "<h3 class='dato'>".$_SESSION['apellido']."</h3>";
                        echo  "<h3 class='dato'>".$_SESSION['username']."</h3>";
                        echo  "<h3 class='dato'>".$_SESSION['email']."</h3>";
                        echo  "<h3 class='dato'>".$_SESSION['membresia']."</h3>";
                        
                        ?>
                </div>
            </div>  
        <a href="../public/logout.php"><button class="logout-button">Logout</button></a>
    </div>
        <!-- Datos de las entradas asociadasa la cuenta -->
        <br><h2 class='mis-entradas'>Mis entradas</h2><br>
            <div class="recitales">
            <?php
                include("../public/conection.php");
                $id = $_SESSION['id'];

                $consulta = mysqli_query($conection, "SELECT * FROM entrada WHERE usuario_id = $id");

                if($consulta->num_rows > 0)
                {
                    while($entrada = mysqli_fetch_assoc($consulta)) // Obtiene cada entrada
                    {
                        $recital_id = $entrada['recital_id'];
                        $consulta_2 = mysqli_query($conection, "SELECT * FROM recital WHERE id = $recital_id");

                        $recital = mysqli_fetch_array($consulta_2);
                        $estadio_id = $recital['estadio_id'];
                        $consulta_3 = mysqli_query($conection, "SELECT * FROM estadio WHERE id = $estadio_id");
                        $estadio = mysqli_fetch_array($consulta_3);
                        echo '<div class="recital">
                        <h3>'. $recital["artista"]. '</h3>
                        <img src="../images/' . $recital["imagen_publicidad"] . '" alt="Imagen">
                        <b><a href="../public/datos-entradas.php?id=' . $entrada["id"] . '">Ver datos</a></b>
                        </div>';
                    }
                }
                else
                {
                    echo '<div></div>
                        <div class="recitales-container">
                            <p>Usted aun no ha comprado entradas</p>
                        </div>';
                }
            ?>
        </div>
        <footer class="footer">
        <div class="footer-links">
        <nav class="navbar">
                <ul>
                    <li><a href="../public/index.php">Inicio</a></li>
                    <li><a href="../public/nostros.php">Nosotros</a></li>
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