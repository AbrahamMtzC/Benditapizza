<?php
    if(!isset($_GET['id'])){
        header('Location: fotos.php');
    }
    include "../js/conexion.php";
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM fotos WHERE id = ?;");
    $stmt->execute([$id]);
    $fotos = $stmt->fetch(PDO::FETCH_OBJ);
    include "header.php";

    $error = isset($_GET['error']) ? $_GET['error'] : "";
?>
<div class="fmodif">
    <!-- Modificar -->
    <div class="formModificar">
        <h2> Modificar Foto </h2>
        <form method="POST" action="editFotP.php" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>Título:</td>
                    <td><input class="form-control" type="text" name="titu2Foto" value="<?php echo $fotos->titulo ?>"></td>
                </tr>
                <tr>
                    <td> </td>
                    <td>
                        <img src="<?php echo $fotos->foto ?>" style="width:200px">
                    </td>
                </tr>
                <tr>
                    <td>Foto:</td>
                    <td>
                        <input class="form-control" type="file" id="img2" name="img2">
                        <input type="hidden" name="imgNoChange" value="<?php echo $fotos->foto ?>">
                    </td>
                </tr>
                <tr>
                    <input type="hidden" name= "id2" value="<?php echo $fotos->id ?>">
                    <td><input type="submit" value="Modificar Foto"></td>
                </tr>
            </table>
        </form>
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?php echo $error ?></div>
        <?php endif ?>
    </div>
    <!-- Fin Modificar -->
</div>
<a href="fotos.php" id="btnSalir"> <i class="fa-solid fa-xmark"></i> </a>
<?php
    include("footer.php");
    $conn = null;
?>