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
                    <li><a href="../public/login.php">Mi cuenta</a></li>
                </ul>
            </nav>        
    </header>

    <main class= info-compra>
    <?php
        require("../public/conection.php");

        if (isset($_GET['dato'])) {
            $valor = $_GET['dato'];
            $consulta = mysqli_query($conection, "SELECT * from recital where id = '$valor'");
            $resultado = mysqli_fetch_assoc($consulta);
            if(mysqli_num_rows($consulta) > 0)
            {    
              
                echo '<div> <h2>' . $resultado["artista"]. '</h2>
                
                     <img src="../images/'.$resultado["imagen_publicidad"].'" alt="Imagen">
                     
                     </div>
                
                <div 
                    <p>Fecha: <span>' .$resultado["fecha"]. '</span> </p>
                    <p>Hora: <span>' .$resultado["hora"]. '</span> </p>';

                    $consultaEstadio = mysqli_query($conection, "SELECT nombre from estadio where id = '" . $resultado['estadio_id'] . "'");
                     
                    $nombreEstadio = mysqli_fetch_assoc($consultaEstadio);

                    echo '<p>Estadio: <span>' .$nombreEstadio["nombre"]. '</span> </p>

                </div>';





            } else {
            echo "No se recibió ningún dato.";
            }
        }

    ?>



    </main>
    
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