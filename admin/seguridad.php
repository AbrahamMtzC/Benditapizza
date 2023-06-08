<?php
    session_start();
    if ($_SESSION["sesionOn"] !="si") {
        header("Location: index.php?error=Debes iniciar sesión para ver la página");
        exit();
    }
?>