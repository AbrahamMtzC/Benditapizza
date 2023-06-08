<?php
    if(!isset($_GET['id'])){
        header('Location: noticias.php');
    }
    include "../js/conexion.php";
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT id, nombre, descripcion, foto, DATE_FORMAT(fecha, '%d/%m/%Y') as fecha FROM noticias WHERE id = ?;");
    $stmt->execute([$id]);
    $noticias = $stmt->fetch(PDO::FETCH_OBJ);
    include "header.php";

    $error = isset($_GET['error']) ? $_GET['error'] : "";
?>
<div class="fmodif">
    <!-- Modificar -->
    <div class="formModificar">
        <h2> Editar Noticia</h2>
        <form method="POST" action="editNotiP.php" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>Título de la noticia:</td>
                    <td><input class="form-control" type="text" name="titu2Not" value="<?php echo $noticias->nombre ?>"></td>
                </tr>
                <tr>
                    <td>Descripción:</td>
                    <td><textarea class="form-control" name="desc2Not" rows="5" cols="40"><?php echo $noticias->descripcion ?></textarea></td>
                </tr>
                <tr>
                    <td> </td>
                    <td>
                        <img src="<?php echo $noticias->foto ?>" style="width:200px">
                    </td>
                </tr>
                <tr>
                    <td>Foto:</td>
                    <td>
                        <input class="form-control" type="file" id="img2" name="img2">
                        <input type="hidden" name="imgNoChange" value="<?php echo $noticias->foto ?>">
                    </td>
                </tr>
                <tr>
                    <td>Fecha:</td>
                    <?php 
                        $fecha = date_create_from_format('d/m/Y', $noticias->fecha);
                        $fechaHTML = $fecha->format('Y-m-d');
                    ?>
                    <td>
                        <input class="form-control" type="date" name="fecha2Not" value="<?php echo $fechaHTML ?>">
                    </td>
                </tr>
                <tr>
                    <input type="hidden" name= "id2" value="<?php echo $noticias->id ?>">
                    <td><input type="submit" value="Modificar Noticia"></td>
                </tr>
            </table>
        </form>
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?php echo $error ?></div>
        <?php endif ?>
    </div>
    <!-- Fin Modificar -->
</div>
<a href="noticias.php" id="btnSalir"> <i class="fa-solid fa-xmark"></i> </a>
<?php
    include("footer.php");
    $conn = null;
?>