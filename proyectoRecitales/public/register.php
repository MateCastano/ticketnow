<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../styles/normalize.css">
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="icon" href="../images/logo.png">
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
                    <li><a href="../public/login.php">Mi cuenta</a></li>
                </ul>
            </nav>        
    </header>
    <main class="main">
        <form class="formulario" action="../public/register-verification.php" method="post">
            <h2>Ingrese sus datos</h2>
            <br>
            <h3>Nombre:</h3>
                <input type="text" name="name" required class="text"/>
            <h3>Apellido:</h3>
                <input type="text" name="surname" required class="text"/>
            <h3>Email:</h3>
                <input type="email" name="email" required class="text"/>
            <h3>Nombre de usuario:</h3>
                <input type="text" name="username" maxlength="30" required class="text"/>
            <h3>Contraseña:</h3>
                <input type="password" name="password" maxlength="30" required class="text"/>
                <div class="mensaje-error">
                    <?php 
                        if(isset($_GET['error-mail']) && $_GET['error-mail'] == 'true')
                        {
                            echo '<center><p>¡Este mail ya esta registrado!</p></center>';
                        }
                    ?>
                </div>
            <input class="buttom" type="submit" value="Registrarse"/>
                <p>¿Ya tienes cuenta? Incia sesion aqui</p>
            <a href="../public/login.php">Inciar sesion</a>	    
        </form>
    </main>
    <footer class="footer">
        <div class="footer-links">
        <nav class="navbar">
                <ul>
                    <li><a href="../public/index.php">Inicio</a></li>
                    <li><a href="#">Nosotros</a></li>
                    <li><a href="#">Contacto</a></li>
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