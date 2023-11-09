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

    
        include("../public/conection.php"); 

        if(isset($_SESSION['membresia']) && $_SESSION['membresia'] === 'Suscriptor')
        {
            $tipo_entrada = $_POST['tipo_entrada'];
            $cantidad_entradas = $_POST['cantidad_entradas'];
            $precio = ($_POST['precio'] * $cantidad_entradas) ;
            $cargo_servicio = $precio * 0.1;
            $total = $precio + $cargo_servicio;
            $precioUnidad =  $_POST['precio'] * 1.1;
            $estadio_id = $_POST['estadio_id'];
            $recital_id = $_POST['recital_id'];

            



        ?>
            <div class="pago">
            <h2>Detalle de la compra</h2>
            <div class="secciones">   
                <div class="seccion">
                    <h3>Tipo de Entrada: </h3>
                    <h3>Cantidad de Entradas: </h3>
                    <h3>Precio total de entradas:  </h3>
                    <h3>Cargo por servicio:  </h3>
                    <br>
                    <h3>TOTAL: </h3>
                </div>
                <div class = "seccion">
                    <h3 class="dato"><?php echo $tipo_entrada; ?></h3>
                    <h3 class="dato"><?php echo $cantidad_entradas; ?></h3>
                    <h3 class="dato">$<?php echo $precio; ?></h3>
                    <h3 class="dato">$<?php echo $cargo_servicio; ?></h3>
                    <br>
                    <h3 class="dato">$<?php echo $total; ?></h3>
                </div>
            </div> 
                <?php

            $consultaRecital = mysqli_query($conection, "SELECT * FROM recital WHERE id = '" . $recital_id . "'");
            $recital = mysqli_fetch_assoc($consultaRecital);
            

            if ($recital[$tipo_entrada] >= $cantidad_entradas) {
                
                require '../vendor/autoload.php';
                MercadoPago\SDK::setAccessToken('TEST-40307714998932-110320-e49179705ca7715108b4425be2effec9-210993591');

                $preference = new MercadoPago\Preference();

                $item = new MercadoPago\Item();

                $item->id = '0001';
                $item->title = 'Entrada/s sector: ' . $tipo_entrada;
                $item->quantity = 1;
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

                $_SESSION['tipo_entrada'] = $tipo_entrada;
                $_SESSION['cantidad_entradas'] = $cantidad_entradas;
                $_SESSION['estadio_id'] = $estadio_id;
                $_SESSION['precioEntrada'] = $precioUnidad;
                $_SESSION['recital_id'] = $recital_id;
                
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
                </div>
            <?php
            }
            else 
            {
                
                header("Location: ../public/compra.php?error-sector=true");
                
            }
        }
        else if (isset($_SESSION['membresia']) && $_SESSION['membresia'] === 'Administrador')
        {
            header("Location: ../public/compra.php?error-admin=true");
        }
        else
        {
            header("Location: ../public/compra.php?error-sesion=true");
        }
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