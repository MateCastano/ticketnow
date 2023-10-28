
<?php include("../public/conection.php"); 

    $resultado = mysqli_query($conection, "SELECT * FROM recital");
    
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
                <a class="header-logo" href="index.html">
                    <img href="index.html" src="../images/logo.png" alt="inicio">
                    </a>
                
                <nav class="navbar">
                    <ul>
                        <li><a href="#">Inicio</a></li>
                        <li><a href="#">Nosotros</a></li>
                        <li><a href="#">Contacto</a></li>                  
                        <li><a href="#">Iniciar sesion</a></li>
                    </ul>
                </nav>        
        </header>
    <main class="main">
          
        <div class="titulo">
            
        <h2>Agregar recital</h2>
            <form class="admin-formulario" action="agregar_recital.php" method="post" enctype="multipart/form-data">

                <br><label>Artista: </label>
                    <input type="text" name="artista" required /></br>
                <br/><label>Fecha:</label>
                    <input type="date" name="fecha" required/></br>
                
                <br><label>Horario: </label>
                    <input type="time" name="hora" required /></br>

                <br><label>Estadio: </label>
                <select name="estadio" required>
                    <option value="" disabled selected>Seleccione un estadio</option>
                    <option value="River">River</option>  
                </select><br>

                <br><label>Imagen: </label>
               <input type="file" name="imagen_publicidad" required></br>
                
                
                <input class="agregar-button" type="submit" value="Agregar recital"/>
 	
            </form>

            

        </div>

        

        </div>
            

        
           
        <div class="eventos">
        <h2>Eventos</h2>
        <table>
        <tr>
            <th>ID</th>
            <th>Artista</th>
            <th>Fecha</th>
            <th>Horario</th>
            <th>Estadio</th>
            <!--<th>Imagen</th> PARA MOSTRAR LA IMAGEN EN EL REGISTRO--> 
            
            

        </tr>
        <?php
            if ($resultado->num_rows > 0) {
                while ($row = mysqli_fetch_assoc($resultado)) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["artista"] . "</td>";
                    echo "<td>" . $row["fecha"] . "</td>";
                    echo "<td>" . $row["hora"] . "</td>";
                    echo "<td>" . $row["estadio_id"] . "</td>";
                    //echo '<td><img src="../images/' . $row["imagen_publicidad"] . '" alt="Imagen"></td>'; PARA MOSTRAR LA IMAGEN EN EL REGISTRO

                    echo '<td>'; 
                    echo '<form class="btn-eliminar" method="post" action="eliminar_registro.php">';
                    echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
                    echo '<input class="btn-eliminar-submit" type="submit" value="Eliminar">';
                    echo '</form>';
                    echo '</td>';
                    echo '</tr>';
                    
                }

                

                
            } 
            ?>
    </table>
     

        </div>

    </main>
</body>
</html>