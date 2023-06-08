<?php
    include "../js/conexion.php";

    $nombre = $_POST['catNom'];

    $stmt = $conn->prepare("INSERT INTO categorias(nombre) VALUES (?)");
    $resultado = $stmt->execute([$nombre]);

    if($resultado === TRUE){
        header('Location: categorias.php');
    } else {
        echo "Error";
    }

    $conn = null;
?>