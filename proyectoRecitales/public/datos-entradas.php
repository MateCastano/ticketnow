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
    <div class="pago">
        <?php
            $id = $_GET['id'];  

            $consultaEntrada = mysqli_query($conection, "SELECT * FROM entrada where id = $id");

            $entrada = mysqli_fetch_array($consultaEntrada);
            $id_recital = $entrada['recital_id'];
            

            $consultaRecital = mysqli_query($conection, "SELECT * FROM recital where id = $id_recital");
            $recital = mysqli_fetch_array($consultaRecital);


            $id_estadio = $recital['estadio_id'];
            $consultaEstadio = mysqli_query($conection, "SELECT * FROM estadio where id = $id_estadio");
            $estadio = mysqli_fetch_array($consultaEstadio);
        ?>
            <h2>Detalles de la entrada</h2>
            <div class="secciones">   
                <div class="seccion">
                    <h3>Nº Ticket: </h3>
                    <h3>Fecha: </h3>
                    <h3>Estadio: </h3>
                    <h3>Direccion: </h3>
                    <h3>Sector: </h3>
                    <h3>Horario: </h3>
                    <h3>Total: </h3>
                    
                </div>
                <div class = "seccion">

                    <h3 class="dato"># <?php echo $entrada['id'] ?></h3>
                    <h3 class="dato"><?php echo $recital['fecha'] ?></h3>
                    <h3 class="dato"><?php echo $estadio['nombre'] ?></h3>
                    <h3 class="dato"><?php echo $estadio['direccion'] ?></h3>
                    <h3 class="dato"><?php echo $entrada['sector'] ?></h3>
                    <h3 class="dato"><?php echo $recital['hora'] ?></h3>
                    <h3 class="dato">$<?php echo $entrada['precio'] ?></h3>
                    
                    <?php 
                echo '<img src="' . $entrada['ruta_qr'] . '" alt="Código QR de la entrada ' . $entrada['id'] . '">';
                ?>
                </div>

                
                
            </div> 
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