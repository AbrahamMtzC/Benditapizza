<?php
    include "../js/conexion.php";

    $usuario = $_POST['nomUser'];
    $clave = $_POST['contraUser'];
    $email = $_POST['correoUser'];

    $stmt = $conn->prepare("INSERT INTO administrador(usuario, clave, email) VALUES (?, ?, ?)");
    $resultado = $stmt->execute([$usuario, $clave, $email]);

    if($resultado === TRUE){
        header('Location: usuarios.php');
    } else {
        echo "Error";
    }

    $conn = null;
?>