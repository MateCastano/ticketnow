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
                    <?php 

                        if(isset($_SESSION['membresia']) && $_SESSION['membresia'] === 'Administrador')
                        {
                        echo '<li><a href="../private/admin.php">Panel de Admin</a></li>';
                            
                        }
                        
                    ?>
                </ul>
            </nav>        
    </header>        
    <div class="account-data">
            <h3>MIS ENTRADAS</h3>
                <?php
                    include("../public/conection.php");
                    $id = $_SESSION['id'];
                    
                    $consulta = mysqli_query($conection, "SELECT * from entrada where usuario_id = $id");
                    if(mysqli_num_rows($consulta))
                    {
                        $entrada = mysqli_fetch_array($consulta);
                        $recital_id = $entrada['recital_id'];
                        $consulta_2 = mysqli_query($conection, "SELECT * from recital where id = $recital_id");

                        $recital = mysqli_fetch_array($consulta_2);
                        $estadio_id = $recital['estadio_id'];
                        $consulta_3 = mysqli_query($conection, "SELECT * from estadio where id = $estadio_id");

                        $estadio = mysqli_fetch_array($consulta_3);

                        echo '<p>Artista: <span>' . $recital['artista'] . '</span></p>';
                        echo '<p>Fecha: <span>' . $recital['fecha'] . '</span></p>';
                        echo '<p>Horario: <span>' . $recital['hora'] . '</span></p>';
                        echo '<p>Estadio: <span>' . $estadio['nombre'] . '</span></p>';
                    }
                    else
                    {
                        echo "Usted aun no ha comprado entradas";
                    }
                ?>
            <br>
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