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
                    <li><a href="../public/login.php">Iniciar sesion</a></li>
                </ul>
            </nav>        
    </header>
    <main class="main">
        <form action="login-verification.php" method="post" id="Form">
            <h2>Please log-in!</h2>
            <br><label>Email:</label><br/>
                <input type="email" name="email" required />
            <br/><label>Password:</label><br/>
                <input type="password" name="password" maxlength="12" required/>
            <br>
            <input class="buttom" type="submit" value="Log-in"/>
                <p>Are you not register? Do it here!</p>
            <a href="formRegister.php" class="registerButtom">Register</a>	
        </form>
    </main>
    </header>
    <footer class="footer">
        <div class="footer-links">
            <ul>
                <li><a href="#">Inicio</a></li>
                <li><a href="#">Nosotros</a></li>
                <li><a href="#">Contacto</a></li>
                <li><a href="#">Iniciar sesion</a></li>
            </ul>
        </div>

    </footer>
    
</body>
</html>