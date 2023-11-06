<?php
    include("../public/conection.php");

    $name = $_POST['nombre'];
    $surname = $_POST['apellido'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $user_message = $_POST['user_message'];

    mail('ticketnow@gmail.com', 'Mensaje via contacto', $user_message);

    $consulta = mysqli_query($conection, "INSERT INTO contacto values(0,'$name','$surname','$email', '$username', '$user_message')");

    header("Location: ../public/contacto.php");
?>