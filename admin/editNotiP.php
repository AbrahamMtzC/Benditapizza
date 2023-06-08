<?php
    include "../js/conexion.php";

    $id2 = $_POST['id2'];
    $nombre2 = $_POST['titu2Not'];
    $descripcion2 = $_POST['desc2Not'];
    $fecha2 = $_POST['fecha2Not'];

    if(isset($_FILES['img2']) && $_FILES['img2']['error'] == 0) {
        // Obtener información del archivo
        $file_info = $_FILES['img2'];

        // Validar tipo de archivo permitido
        $allowed_types = ['image/gif', 'image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
        $file_type = $file_info['type'];
    
        if (!in_array($file_type, $allowed_types)) {
            // Tipo de archivo no permitido
            header("Location: editNoti.php?id=" .$id2. "&error=Solo se permiten archivos GIF, JPEG, JPG, PNG y WebP.");
            exit;
        }

        // Validar tamaño máximo
        $max_size = 1 * 1024 * 1024; // 1 MB en bytes
        $file_size = $file_info['size'];
        
        if ($file_size > $max_size) {
            // Tamaño de archivo excede el límite
            header("Location: editNoti.php?id=" .$id2. "&error=El tamaño máximo permitido es de 1 MB.");
            exit;
        }

        // Si se recibió una imagen y no hay errores, se define la ruta donde se guardará y se mueve el archivo a esa ruta
        $img = "../img/noticias/" . basename($_FILES['img2']['name']);
        move_uploaded_file($_FILES['img2']['tmp_name'], $img);
    } else {
        // Si no se recibió una imagen o hay algún error, se asigna una imagen por defecto
        $img = $_POST['imgNoChange'];
    }

    $stmt = $conn->prepare("UPDATE noticias SET nombre = ?, descripcion = ?, foto = ?, fecha = ? WHERE id = ?;");
    $resultado = $stmt->execute([$nombre2, $descripcion2, $img, $fecha2, $id2]);

    if($resultado === TRUE){
        header('Location: noticias.php');
    } else {
        echo "Error";
    }

    $conn = null;
?>