<!DOCTYPE html>
<html lang="en">
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
                    <li><a href="../public/login.php">Mi cuenta</a></li>
                </ul>
            </nav>        
    </header>
    <main class="main">
        <form class="formulario" action="../public/register-verification.php" method="post">
            <h2>Ingrese sus datos</h2>
            <label>Nombre:</label><br/>
                <input type="text" name="name" required/><br>
            <br><label>Apellido:</label><br/>
                <input type="text" name="surname" required/><br>
            <br><label>Email:</label><br/>
                <input type="email" name="email" required/><br>
            <br><label>Nombre de usuario:</label><br/>
                <input type="text" name="username" maxlength="30" required/><br>
            <br><label>Contraseña:</label><br/>
                <input type="password" name="password" maxlength="30" required/><br>
            <br>
            <input class="buttom" type="submit" value="Registrarse"/>	
        </form>
    </main>
    <footer class="footer">
        <div class="footer-links">
            <ul>
                <li><a href="#">Inicio</a></li>
                <li><a href="#">Nosotros</a></li>
                <li><a href="#">Contacto</a></li>
                
            </ul>
        </div>

    </footer>
</body>
</html>