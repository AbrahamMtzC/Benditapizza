<?php
    include("../js/conexion.php");
    $stmt = $conn->prepare("SELECT * FROM categorias");
    $stmt->execute();
    $categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);
    include("header.php");
?>
<div class="catego">
    <div>
        <h2>Categorías</h2>
        <table class="contTabla">
            <thead>
            <tr>
                <th>Categoría</th>
                <th>Modificar</th>
                <th>Borrar</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($categorias as $cate): ?>
                <tr>
                    <td><?php echo $cate['nombre']; ?></td>
                    <td>
                        <a href="editCat.php?id=<?php echo $cate['id']; ?>"> 
                            <i class="fa-regular fa-pen-to-square"></i>
                        </a>
                    </td>
                    <td>
                        <a href="elimCat.php?id=<?php echo $cate['id']; ?>" 
                            onclick="return confirm('¿Está seguro de que desea eliminar esta categoría?')">
                            <i class="fa-sharp fa-solid fa-trash"></i> 
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>                
            <tbody>
        </table>
    </div> 
    <!-- insertar -->
    <div class="formAgregar">
        <h2> Agregar una Nueva Categoría </h2>
        <form method="POST" action="altaCat.php">
            <table>
                <tr>
                    <td>Nombre de la Categoría:</td>
                    <td><input type="text" name="catNom" placeholder="Chicago Style" required></td>
                </tr>
                <tr>
                    <td><input type="submit" value="Ingresar Categoría"></td>
                </tr>
            </table>
        </form>
    </div>
    <!-- fin insertar -->
</div>
<?php
    include("footer.php");
    $conn = null;
?>