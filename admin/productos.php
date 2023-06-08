<?php
    include("../js/conexion.php");
    $stmt = $conn->prepare("SELECT * FROM productos ORDER BY id DESC");
    $stmt->execute();
    $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    include("header.php");

    $error = isset($_GET['error']) ? $_GET['error'] : "";
?>
<div class="catego">
    <div>
        <h2>Productos</h2>
        <table class="contTabla">
            <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Foto</th>
                <th>Categoría</th>
                <th>Modificar</th>
                <th>Borrar</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($productos as $prod): ?>
                <tr>
                    <td> <?php echo $prod['nombre']; ?> </td>
                    <td> <?php echo $prod['descripcion']; ?> </td>
                    <td>$<?php echo $prod['precio']; ?>MX</td>
                    <td><img src="<?php echo $prod['foto']; ?>" alt="<?php echo $prod['nombre']; ?>"></td>
                    <td>
                        <?php
                            $stmt2 = $conn->prepare("SELECT * FROM categorias WHERE id = " . $prod['idCat']);
                            $stmt2->execute();
                            $categoria = $stmt2->fetchAll(PDO::FETCH_ASSOC);
                            if(count($categoria) > 0) { // Verificamos si hay al menos una fila en el resultado
                                echo $categoria[0]['nombre']; // Si hay al menos una fila, accedemos al campo "nombre" de la primera fila y lo imprimimos
                            } else {
                                echo "Categoría no encontrada"; // Si no hay filas en el resultado, imprimimos un mensaje de error
                            }
                        ?>
                    </td>
                    <td>
                        <a href="editProd.php?id=<?php echo $prod['id']; ?>"> 
                            <i class="fa-regular fa-pen-to-square"></i>
                        </a>
                    </td>
                    <td>
                        <a href="elimProd.php?id=<?php echo $prod['id']; ?>" onclick="return confirm('¿Está seguro de que desea eliminar este producto?')">
                            <i class="fa-sharp fa-solid fa-trash"></i> 
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            <tbody>
        </table>
    </div> 
    <!-- insertar -->
    <div class="formAgregar hoverEffect produForm">
        <h2> Agregar un Nuevo Producto </h2>
        <form method="POST" action="altaProd.php" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>Nombre del Producto: </td>
                    <td><input class="form-control" type="text" name="prodNom"  placeholder="Ensalada diosa" required></td>
                </tr>
                <tr>
                    <td>Descripción del Producto: </td>
                    <td><textarea class="form-control" name="prodDesc" rows="5" cols="40"  placeholder="Mezcla de lechugas + espinaca + jamón" required></textarea></td>
                </tr>
                <tr>
                    <td>Precio del Producto: </td>
                    <td><input class="form-control" type="number" name="prodPrc" placeholder="105" required></td>
                </tr>
                <tr>
                    <td>Foto del Producto: </td>
                    <td><input class="form-control" type="file" name="img"></td>
                </tr>
                <tr>
                    <td>Categoría del Producto: </td>
                    <td>
                        <select class="form-control" type="text" name="prodCat">
                            <?php
                                $stmt3 = $conn->prepare("SELECT * FROM categorias");
                                $stmt3->execute();
                                $categorias = $stmt3->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($categorias as $cate):
                            ?>
                                <option value="<?php echo $cate['id']; ?>"> <?php echo $cate['nombre']; ?> </option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><input type="submit" value="Ingresar Producto"></td>
                </tr>
            </table>
        </form>
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?php echo $error ?></div>
        <?php endif ?>
    </div>
    <!-- fin insertar -->
</div>
<?php
    include("footer.php");
    $conn = null;
?>