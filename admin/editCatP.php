<?php
    include "../js/conexion.php";
    
    $id2 = $_POST['id2'];
    $nombre2 = $_POST['cat2Nom'];

    $stmt = $conn->prepare("UPDATE categorias SET nombre = ? WHERE id = ?;");
    $resultado = $stmt->execute([$nombre2, $id2]);

    if($resultado === TRUE){
        header('Location: categorias.php');
    } else {
        echo "Error";
    }

    $conn = null;
?>