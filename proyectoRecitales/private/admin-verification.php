<?php session_start();

    if(($_SESSION['membresia']) == "Administrador")
    {
        header("Location: ../private/admin.php");
    }
    else
    {
        header("Location: ../public/login.php");
    }
    ?>
</body>
</html>