
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
    <link rel="icon" href="../images/logo.png">

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
            
        <br><h2>Agregar recital</h2>   
            <form class="admin-formulario" action="agregar_recital.php" method="post" enctype="multipart/form-data">

                <br><label>Artista: </label>
                    <input type="text" name="artista" required class="text"/></br>
                <br/><label>Fecha:</label>
                    <input type="date" name="fecha" required class="text"/></br>
                
                <br><label>Horario: </label>
                    <input type="time" name="hora" required class="text"/></br>

                <br><label>Estadio: </label>
                <select name="estadio"required>
                    <option value="" disabled selected>Seleccione un estadio</option>
                    <option value="River">River</option>  
                    <option value="Vélez">Vélez</option> 
                    <option value="Obras">Obras</option>
                    <option value="Huracan">Huracan</option>
                    <option value="GEBA">Geba</option> 
                </select><br>

                <br><label>Imagen: </label>
               <input type="file" name="imagen_publicidad" required></br>
                
               <br><label>Precio: </label>
                    <input type="number" name="precio" required class="text"/></br>

                <input class="buttom" type="submit" value="Agregar recital" class="text"/>
 	
            </form>

        </div>

        </div>
        
           
        <div class="eventos">
        <br><h2>Eventos</h2><br>
        <table>
        <tr>
            <th>ID</th>
            <th>Artista</th>
            <th>Fecha</th>
            <th>Horario</th>
            <th>Estadio</th>
            <th>Precio</th>
            <!--<th>Imagen</th> PARA MOSTRAR LA IMAGEN EN EL REGISTRO--> 
            
            
            

        </tr>

        <?php
            if ($resultado->num_rows > 0) {
                

                while ($row = mysqli_fetch_assoc($resultado)) {

                    $estadioResultado = mysqli_query($conection, "SELECT * FROM estadio WHERE id = " . $row['estadio_id']);
                    $estadio = mysqli_fetch_assoc($estadioResultado);
                    



                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["artista"] . "</td>";
                    echo "<td>" . $row["fecha"] . "</td>";
                    echo "<td>" . $row["hora"] . "</td>";
                    echo "<td>" . $estadio["nombre"] . "</td>";
                    echo "<td>" . $row["precio"] . "</td>";
                    //echo '<td><img src="../images/' . $row["imagen_publicidad"] . '" alt="Imagen"></td>'; PARA MOSTRAR LA IMAGEN EN EL REGISTRO

                    echo '<td>'; 
                    echo '<form class="btn-eliminar" method="post" action="eliminar_registro.php">';
                    echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
                    echo '<input class="buttom" type="submit" value="Eliminar">';
                    echo '</form>';
                    echo '</td>';
                    

                    echo '<td>';
                    echo '<form class="btn-eliminar" method="post" action="editar_recital.php">';
                    echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
                    echo '<input class="buttom" type="submit" value="Editar">';
                    echo '</form>';
                    echo '</td>';
                    echo '</tr>';
                    
                }

                

                
            } 
            ?>


    </table>
     
  

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