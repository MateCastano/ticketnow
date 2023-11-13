<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../styles/normalize.css">
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="icon" href="../images/logo.png">
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
    
    <div class="nosotros">
        <img src="../images/nosotros.jpg" alt="imagen">
        <p>
            Somos una empresa de venta de <strong>tickets de recitales y eventos masivos</strong> que se 
            realizan en Argentina.
            <br><br>Nuestro objetivo principal es brindarle un servicio <strong>rápido, 
            claro y eficiente</strong>s a nuestros clientes, ya sea para las <strong>empresas</strong>
            que organizan los eventos y confían en nosotros para la venta de las entradas de los mismos 
            y para los <strong>usuarios</strong> que realizan la compra de los tickets por medio de 
            nuestro sitio web.
            <br><br>Ante cualquier duda, contáctese  mediante el <strong>formulario de contacto</strong> para realizar una consulta, ya sea
            por propuestas laborales o por problemas con el sitio web.
            <br><br>Un saludo y ¡disfruten de todos los <strong>increíbles recitales</strong> y <strong>eventos</strong> que tenemos en nuestro catalogo! 
        </p>                
    </div>
        
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