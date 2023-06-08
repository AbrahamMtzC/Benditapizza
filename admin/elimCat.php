<?php 
    include "../js/conexion.php";
    $codigo = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM categorias WHERE id = ?;");
    $resultado = $stmt->execute([$codigo]);

    if($resultado === TRUE){
        header('Location: categorias.php');
    } else {
        echo "Error";
    }

    $conn = null;
?>