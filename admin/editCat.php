<?php
    if(!isset($_GET['id'])){
        header('Location: categorias.php');
    }
    include "../js/conexion.php";
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM categorias WHERE id = ?;");
    $stmt->execute([$id]);
    $categorias = $stmt->fetch(PDO::FETCH_OBJ);
    include "header.php";
?>

<div class="fmodif">
    <!-- Modificar -->
    <div class="formModificar">
        <h2> Editar Categoría <?php echo $categorias->nombre ?></h2>
        <form method="POST" action="editCatP.php">
            <table>
                <tr>
                    <td>Nombre de la Categoría:</td>
                    <td><input type="text" name="cat2Nom" value="<?php echo $categorias->nombre ?>"></td>
                </tr>
                <tr>
                    <input type="hidden" name= "id2" value="<?php echo $categorias->id ?>">
                    <td><input type="submit" value="Modificar Categoría"></td>
                </tr>
            </table>
        </form>
    </div>
    <!-- Fin Modificar -->
</div>
<a href="categorias.php" id="btnSalir"> <i class="fa-solid fa-xmark"></i> </a>
<?php
    include("footer.php");
    $conn = null;
?>