<?php
    if(!isset($_GET['id'])){
        header('Location: productos.php');
    }
    include "../js/conexion.php";
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM productos WHERE id = ?;");
    $stmt->execute([$id]);
    $productos = $stmt->fetch(PDO::FETCH_OBJ);
    include "header.php";

    $error = isset($_GET['error']) ? $_GET['error'] : "";
?>
<div class="fmodif">
    <!-- Modificar -->
    <div class="formModificar">
        <h2> Modificar <?php echo $productos->nombre ?></h2>
        <form method="POST" action="editProdP.php" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>Nombre del Producto: </td>
                    <td><input class="form-control" type="text" name="prod2Nom"  value="<?php echo $productos->nombre ?>"></td>
                </tr>
                <tr>
                    <td>Descripción del Producto: </td>
                    <td><textarea class="form-control" name="prod2Desc" rows="5" cols="40"><?php echo $productos->descripcion ?></textarea></td>
                </tr>
                <tr>
                    <td>Precio del Producto: </td>
                    <td><input class="form-control" type="number" name="prod2Prc" value="<?php echo $productos->precio ?>"></td>
                </tr>
                <tr>
                    <td> </td>
                    <td>
                        <img src="<?php echo $productos->foto ?>" style="width:200px">
                    </td>
                </tr>
                <tr>
                    <td>Foto del Producto: </td>
                    <td><input class="form-control" type="file" id="img2" name="img2"></td>
                    <input type="hidden" name="imgNoChange" value="<?php echo $productos->foto ?>">
                </tr>
                <tr>
                    <td>Categoría del Producto: </td>
                    <td>
                        <select class="form-control" type="text" name="prod2Cat">
                            <?php
                                $stmt3 = $conn->prepare("SELECT * FROM categorias");
                                $stmt3->execute();
                                $categorias = $stmt3->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($categorias as $cate):
                            ?>
                                <option value="<?php echo $cate['id']; ?>" 
                                    <?php
                                        // Si la categoría actual es la misma que la del producto, la marcamos como seleccionada 
                                        if (isset($productos->idCat) && $cate['id'] == $productos->idCat) { 
                                            echo ' selected'; 
                                        } 
                                    ?>>
                                    <?php echo $cate['nombre']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <input type="hidden" name= "id2" value="<?php echo $productos->id ?>">
                    <td><input type="submit" value="Modificar Producto"></td>
                </tr>
            </table>
        </form>
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?php echo $error ?></div>
        <?php endif ?>
    </div>
    <!-- Fin Modificar -->
</div>
<a href="productos.php" id="btnSalir"> <i class="fa-solid fa-xmark"></i> </a>
<?php
    include("footer.php");
    $conn = null;
?>