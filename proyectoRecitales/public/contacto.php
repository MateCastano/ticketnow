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
    <div class="contacto form">
    <main class="main">
        <form class="formularioContacto" action="../public/enviarContacto.php" method="post">
        <h2 class="contactH2">Envianos tus consultas mediante el siguiente formulario</h2>
            <br><h3>Nombre:</h3>
                <input type="text" name="nombre" required  class="textContacto"/>
            <h3>Apellido:</h3>  
                <input type="text" name="apellido" required  class="textContacto"/>
            <h3>Nombre de usuario:</h3>
                <input type="text" name="username" required  class="textContacto"/>
            <h3>Email:</h3>
                <input type="email" name="email" required  class="textContacto"/>
            <br>
            <br>
            <textarea name="user_message" placeholder="Escriba aqui su mensaje" required="true" required></textarea>
            <br>
            <input class="buttom" type="submit" value="Enviar"/>	
        </form>
    </main> 
    <footer class="footer">
        <div class="footer-links">
        <nav class="navbar">
                <ul>
                    <li><a href="../public/index.php">Inicio</a></li>
                    <li><a href="#">Nosotros</a></li>
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