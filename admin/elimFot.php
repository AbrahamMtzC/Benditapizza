<?php 
    include "../js/conexion.php";
    $codigo = $_GET['id'];

    // Primero, obtenemos la información del archivo que queremos eliminar
    $stmt = $conn->prepare("SELECT foto FROM fotos WHERE id = ?");
    $stmt->execute([$codigo]);
    $foto = $stmt->fetchColumn();

    // Eliminamos el registro de la base de datos
    $stmt = $conn->prepare("DELETE FROM fotos WHERE id = ?;");
    $resultado = $stmt->execute([$codigo]);

    // Si la eliminación de la base de datos fue exitosa, intentamos eliminar el archivo local
    if($resultado === TRUE){
        // Comprobamos que el archivo exista en el servidor
        if(file_exists($foto) && $foto != '../img/altlogo.png'){
            // Eliminamos el archivo
            unlink($foto);
        }
        header('Location: fotos.php');
    } else {
        echo "Error";
    }

    $conn = null;
?>

