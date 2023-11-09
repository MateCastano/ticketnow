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
                        session_start();

                        if(isset($_SESSION['membresia']) && $_SESSION['membresia'] === 'Administrador')
                        {
                        echo '<li><a href="../private/admin.php">Panel de Admin</a></li>';
                            
                        }
                        
                    ?>
                </ul>
            </nav>       
    </header>

    <main>
    <?php
        require("../public/conection.php");
                        
            $valor = $_GET['dato'];
            
            $consulta = mysqli_query($conection, "SELECT * FROM recital WHERE id = '$valor'");

            if (mysqli_num_rows($consulta) > 0) {
                $resultado = mysqli_fetch_assoc($consulta);
        
                echo '<div class="info-compra">';
                echo '<div class="left">';
                echo '<h2>' . $resultado["artista"] . '</h2>';
                echo '<img src="../images/' . $resultado["imagen_publicidad"] . '" alt="Imagen">';
                echo '</div>';
                
                echo '<div class="center"> a </div>';

                echo '<div class="right">';
                echo '<h2>Información general</h2>';
                echo '<p>Fecha: <span>' . $resultado["fecha"] . '</span></p>';
                echo '<p>Hora: <span>' . $resultado["hora"] . '</span></p>';
                
                $consultaEstadio = mysqli_query($conection, "SELECT * FROM estadio WHERE id = '" . $resultado['estadio_id'] . "'");
                $estadio = mysqli_fetch_assoc($consultaEstadio);
        
                echo '<p>Estadio: <span>' . $estadio["nombre"] . '</span></p>';
                echo '<p>Direccion: <span>' . $estadio["direccion"] . '</span></p>';
                echo '</div>';
                echo '</div>';
        
                
                $consultaEstadio = mysqli_query($conection, "SELECT * FROM estadio WHERE id = '" . $resultado['estadio_id'] . "'");
                $estadio = mysqli_fetch_assoc($consultaEstadio);
        
                $imagenBinaria = $estadio["plano"];
                $imagenBase64 = base64_encode($imagenBinaria); // Convierte la imagen binaria a base64
        
                echo '<div class="info-compra">';
                echo '<div class="left" style="width: 30%;">';
                echo '<h2>Ubicación y precios</h2>';
                echo '<img src="data:image/jpeg;base64,' . $imagenBase64 . '" alt="Imagen">';
                echo '</div>';
        
                echo '<div class="info-precio"><h3>VIP</h3>';
                $resultadoVIP = $resultado["precio"] * 2;
                echo '<p>$ ' . $resultadoVIP . '</p>';

                echo '<form class="form-entrada" method="post" action="../public/pago.php">';
                echo '<label for="cantidad_entradas">Cantidad:</label>';
                echo '<input type="number" id="cantidad_entradas" name="cantidad_entradas" min="1" max="3" value="1">';
                echo '<input type="hidden" name="tipo_entrada" value="vip">';
                echo '<input type="hidden" name="recital_id" value="' . $valor . '">';
                echo '<input type="hidden" name="precio" value="' . $resultadoVIP . '">';
                echo '<input type="hidden" name="estadio_id" value="' .$resultado['estadio_id'] . '">';
                
                echo '<input class="comprar-button" type="submit" value="COMPRAR">';
                echo '</form>';
                
                
                echo '</div>';
                

                echo '<div class="info-precio"><h3>CAMPO</h3>';
                $resultadoCampo = $resultado["precio"] * 1.4;
                echo '<p>$ ' . $resultadoCampo . '</p>';

                echo '<form class="form-entrada" method="post" action="../public/pago.php">';
                echo '<label for="cantidad_entradas">Cantidad:</label>';
                echo '<input type="number" id="cantidad_entradas" name="cantidad_entradas" min="1" max="3" value="1">';
                echo '<input type="hidden" name="tipo_entrada" value="campo">';
                echo '<input type="hidden" name="recital_id" value="' . $valor . '">';
                echo '<input type="hidden" name="precio" value="' . $resultadoCampo . '">';
                echo '<input type="hidden" name="estadio_id" value="' .$resultado['estadio_id'] . '">';

                echo '<input class="comprar-button" type="submit" value="COMPRAR">';
                echo '</form>';
                echo '</div>';
                

                echo '<div class="info-precio"><h3>PLATEA</h3>';
                $resultadoPlatea= $resultado["precio"] * 1.5;
                echo '<p>$ ' . $resultadoPlatea . '</p>';

                echo '<form class="form-entrada" method="post" action="../public/pago.php">';
                echo '<label for="cantidad_entradas">Cantidad:</label>';
                echo '<input type="number" id="cantidad_entradas" name="cantidad_entradas" min="1" max="3" value="1">';
                echo '<input type="hidden" name="tipo_entrada" value="platea">';
                echo '<input type="hidden" name="recital_id" value="' . $valor . '">';
                echo '<input type="hidden" name="precio" value="' . $resultadoPlatea . '">';
                echo '<input type="hidden" name="estadio_id" value="' .$resultado['estadio_id'] . '">';

                echo '<input class="comprar-button" type="submit" value="COMPRAR">';
                echo '</form>';
                
                echo '</div>';
            } else {
                echo 'No se encontraron resultados para el ID proporcionado.';
                }
            mysqli_close($conection);

    ?>

    </main>
    
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