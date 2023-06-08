<?php
    if(!isset($_GET['id'])){
        header('Location: usuarios.php');
    }
    include "../js/conexion.php";
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM administrador WHERE id = ?;");
    $stmt->execute([$id]);
    $administrador = $stmt->fetch(PDO::FETCH_OBJ);
    include "header.php";
?>
<div class="fmodif">
    <!-- Modificar -->
    <div class="formModificar">
        <h2> Modificar Usuario <?php echo $administrador->usuario ?></h2>
        <form method="POST" action="editUserP.php">
            <table>
                <tr>
                    <td>Nombre de usuario:</td>
                    <td><input type="text" name="nom2User"  value="<?php echo $administrador->usuario ?>"></td>
                </tr>
                <tr>
                    <td>Contraseña:</td>
                    <td><input type="password" name="contra2User" value="<?php echo $administrador->clave ?>"></td>
                </tr>
                <tr>
                    <td>Correo:</td>
                    <td><input type="email" name="correo2User" value="<?php echo $administrador->email ?>"></td>
                </tr>
                <tr>
                    <input type="hidden" name= "id2" value="<?php echo $administrador->id ?>">
                    <td><input type="submit" value="Modificar Usuario"></td>
                </tr>
            </table>
        </form>
    </div>
    <!-- Fin Modificar -->
</div>
<a href="usuarios.php" id="btnSalir"> <i class="fa-solid fa-xmark"></i> </a>
<?php
    include("footer.php");
    $conn = null;
?>