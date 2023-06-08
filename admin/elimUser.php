<?php 
    include "../js/conexion.php";
    $codigo = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM administrador WHERE id = ?;");
    $resultado = $stmt->execute([$codigo]);

    if($resultado === TRUE){
        header('Location: usuarios.php');
    } else {
        echo "Error";
    }

    $conn = null;
?>