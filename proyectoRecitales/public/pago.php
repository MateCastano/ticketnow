


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../styles/normalize.css">
    <link rel="stylesheet" href="../styles/style.css">

    <title>TicketNow</title>

    <script src="https://sdk.mercadopago.com/js/v2"></script>


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

                <?php

            $consultaEstadio = mysqli_query($conection, "SELECT * FROM estadio WHERE id = '" . $estadio_id . "'");
            $estadio = mysqli_fetch_assoc($consultaEstadio);



            if ($estadio[$tipo_entrada] >= $cantidad_entradas) {

                require '../vendor/autoload.php';
                MercadoPago\SDK::setAccessToken('TEST-40307714998932-110320-e49179705ca7715108b4425be2effec9-210993591');

                $preference = new MercadoPago\Preference();

                $item = new MercadoPago\Item();

                $item->id = '0001';
                $item->title = 'Entrada/s sector: ' . $tipo_entrada;
                $item->quantity =  1;
                $item->unit_price =  $total;
                $item->currency_id = "ARS";

                $preference->items = array ($item);
                

                $preference->back_urls = array(
                    "success" => "http://localhost/proyectoRecitales/public/procesar_pago.php",
                    "failure" => "../pago.php"


                );

                $preference->auto_return = "approved";
                $preference->binary_mode = true;

                $preference->save();
                ?>
            

                
                    <div class="checkout-btn"></div>
                    <script>
                                const mp = new MercadoPago('TEST-99961a6f-9c1c-49cb-8790-cb90bbe3bbc5', {
                            locale: 'es-AR',  // Reemplazar ; por ,
                        });

                        mp.checkout({
                            preference: {
                                id: '<?php echo $preference->id; ?>'
                            },
                            render: {
                                container: '.checkout-btn',
                                label: 'Pagar con MP'
                            }
                        });
                    </script>
            <?php    
            } else {

                echo '<h1 style="color:red;text-align:center;margin-top:12px;text-transform:uppercase">Sector agotado, por favor elija otro sector.</h1>';
                
            }
                    
            
                
        
            
        
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