<?php
    include "../js/conexion.php";
    
    $id2 = $_POST['id2'];
    $usuario2 = $_POST['nom2User'];
    $clave2 = $_POST['contra2User'];
    $email2 = $_POST['correo2User'];

    $stmt = $conn->prepare("UPDATE administrador SET usuario = ?, clave = ?, email = ? WHERE id = ?;");
    $resultado = $stmt->execute([$usuario2, $clave2, $email2, $id2]);

    if($resultado === TRUE){
        header('Location: usuarios.php');
    } else {
        echo "Error";
    }

    $conn = null;
?>