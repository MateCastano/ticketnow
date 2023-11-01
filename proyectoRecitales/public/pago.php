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


    <main>

    <?php
        include("../public/conection.php"); 
        session_start();

        if(isset($_SESSION['membresia']) && $_SESSION['membresia'] === 'Suscriptor')
        {
            
            
            $tipo_entrada = $_POST['tipo_entrada'];
            $cantidad_entradas = $_POST['cantidad_entradas'];
            $precio = ($_POST['precio'] * $cantidad_entradas) ;
            $cargo_servicio = $precio * 0.1;
            $total = $precio + $cargo_servicio;
            $estadio_id = $_POST['estadio_id'];

            

            ?>  
            <div class="pago">

            
                <h1>Detalle de la Compra</h1>
                <p>Tipo de Entrada: <?php echo $tipo_entrada; ?></p>
                <p>Cantidad de Entradas: <?php echo $cantidad_entradas; ?></p>
                <p>Precio total de entradas: $ <?php echo $precio; ?></p>
                <p>Cargo por servicio: $ <?php echo $cargo_servicio; ?></p>
                <p>TOTAL: $<?php echo $total; ?></p>

                
                <h2>Selecciona tu método de pago</h2>
                <form action="../public/procesar_pago.php" method="post">
                    <label for="metodo_pago">Método de Pago:</label>
                    <input type="hidden" name="tipo_entrada" value="<?php echo $tipo_entrada; ?>">
                    <input type="hidden" name="cantidad_entradas" value="<?php echo $cantidad_entradas; ?>">
                    <input type="hidden" name="precio" value="<?php echo $precio; ?>">
                    <input type="hidden" name="estadio_id" value="<?php echo $estadio_id; ?>">
                    <select name="metodo_pago" id="metodo_pago">
                        <option value="tarjeta">Tarjeta de Crédito</option>
                        <option value="paypal">PayPal</option>
                        
                    </select>
                    <button type="submit">Confirmar Compra</button>
                </form>
            </div>

            
        <?php
        }else if (isset($_SESSION['membresia']) && $_SESSION['membresia'] === 'Administrador'){

            echo '<h1 style="color:red;text-align:center;margin-top:12px">No puedes realizar esta acción como administrador. Logeate como usuario.</h1>';
            
            
      
        }else{
            echo '<h1 style="color:red;text-align:center;margin-top:12px">Debes estar logeado para comprar!</h1>';
        }
    ?>

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