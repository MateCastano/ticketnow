
<?php 
    include("../public/conection.php"); 

    session_start();

    $resultado = mysqli_query($conection, "SELECT * FROM recital");
    if(!isset($_SESSION['membresia']))
    {
        header("Location: ../public/login.php");
    }
    else if($_SESSION['membresia'] === 'Suscriptor')
    {
        header("Location: ../public/index.php");
    }
    
?>

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
<body class="admin">

    <header class="header">
                <a class="header-logo" href="../public/index.php">
                    <img href="../public/index.php" src="../images/logo.png" alt="inicio">
                </a>
                
                <nav class="navbar">
                    <ul>
                        <li><a href="../public/index.php">Inicio</a></li>
                        <li><a href="../public/nosotros.php">Nosotros</a></li>
                        <li><a href="#">Contacto</a></li>                  
                        <li><a href="../public/account.php">Mi cuenta</a></li>
                        <?php

                        if(isset($_SESSION['membresia']) && $_SESSION['membresia'] === 'Administrador')
                        {
                        echo '<li><a href="../private/admin.php">Panel de Admin</a></li>';
                            
                        }
                        
                    ?>
                    </ul>
                </nav>        
        </header>
    <main class="main">
          
        <div class="titulo">
            
        <?php $id = $_POST["id"]; 
        
            $consulta = mysqli_query($conection, "SELECT * FROM recital WHERE id = " . $id);
            $recital = mysqli_fetch_assoc($consulta);

            
            $estadioResultado = mysqli_query($conection, "SELECT * FROM estadio WHERE id = " . $recital['estadio_id']);
            $estadio = mysqli_fetch_assoc($estadioResultado);
    
            $estadioNombre = $estadio['nombre'];


               
            
        ?>
        <br><h2>Editar recital</h2>   
            <form class="admin-formulario" style="background-color: cadetblue;" action="proceso_editar_recital.php" method="post" enctype="multipart/form-data">

                <br><label>Artista: </label>
                    <input type="text" name="artista" value="<?php echo $recital['artista']; ?>" required class="text"/></br>

                <br/><label>Fecha:</label>
                    <input type="date" name="fecha" value="<?php echo $recital['fecha']; ?>" required class="text"/></br>
                
                <br><label>Horario: </label>
                    <input type="time" name="hora" value="<?php echo $recital['hora']; ?>" required class="text"/></br>


             

                <br><label>Estadio: </label>
                <select name="estadio" required>
                    <option value="<?php echo $estadioNombre; ?>" disable selected> <?php echo $estadioNombre; ?></option>
                    <option value="River">River</option>  
                    <option value="Vélez">Vélez</option> 
                    <option value="Obras">Obras</option>
                    <option value="Huracan">Huracan</option>
                    <option value="GEBA">Geba</option> 
                </select><br>

                
                
               <br><label>Precio: </label>
                    <input type="number" name="precio" value="<?php echo $recital['precio']; ?>" required class="text"/></br>

                    <?php  
                    
                    echo '<input type="hidden" name="id"  value="' . $_POST["id"] . '">';
                        
                            
                    ?>
                    
                <input class="buttom" type="submit" value="Editar recital" class="text"/>
 	
            </form>

        </div>

        </div>
        
  
  

</body>
</html>
        </div>

    </main>
    <footer class="footer">
        <div class="footer-links">
        <nav class="navbar">
                <ul>
                    <li><a href="../public/index.php">Inicio</a></li>
                    <li><a href="#">Nosotros</a></li>
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