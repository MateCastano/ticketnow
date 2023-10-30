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
                    <li><a href="#">Nosotros</a></li>
                    <li><a href="#">Contacto</a></li>
                    <li><a href="../public/account-verification.php">Mi cuenta</a></li>
                </ul>
            </nav>        
    </header>        
        <div class="account">
            <h3>MI CUENTA</h3>
            <u><b>NOMBRE</b></u>
            <?php
            echo $_SESSION['nombre'] . " ";
            ?>
            <br>
            <br><u><b>APELLIDO:</b></u>
            <?php
            echo $_SESSION['apellido'] . " ";
            ?>
            <br>
            <br><u><b>USUARIO:</b></u>
            <?php
            echo $_SESSION['username'] . " ";
            ?>
            <br>
            <br><u><b>EMAIL:</b></u>
            <?php
            echo $_SESSION['email'] . " ";
            ?>
            <br>
            <br><u><b>MEMBRESIA:</b></u>
            <?php
            echo $_SESSION['membresia'] . " ";
            ?>
            <br>
            <br>
            </b><button><a href="../public/logout.php"><b>Logout</b></a></button>
        </div>
        <footer class="footer">
        <div class="footer-links">
            <ul>

                <li><a href="../public/index.php">Inicio</a></li>
                <li><a href="#">Nosotros</a></li>
                <li><a href="#">Contacto</a></li>
                <li><a href="../public/account-verification.php">Mi cuenta</a></li>
                

            </ul>
        </div>

    </footer>
    
</body>
</html>