<?php
    include("../js/conexion.php");
    $stmt = $conn->prepare("SELECT id, nombre, descripcion, foto, DATE_FORMAT(fecha, '%d/%m/%Y') as fecha2 FROM noticias ORDER BY fecha DESC");
    $stmt->execute();
    $noticias = $stmt->fetchAll(PDO::FETCH_ASSOC);
    include("header.php");

    $error = isset($_GET['error']) ? $_GET['error'] : "";
?>
<div class="catego">
    <div>
        <h2>Noticias</h2>
        <table class="contTabla">
            <thead>
            <tr>
                <th>Título</th>
                <th>Descripción</th>
                <th>Foto</th>
                <th>Fecha</th>
                <th>Modificar</th>
                <th>Borrar</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($noticias as $noti): ?>
                <tr>
                    <td><?php echo $noti['nombre']; ?></td>
                    <td><?php echo $noti['descripcion']; ?></td>
                    <td><img src="<?php echo $noti['foto']; ?>"></td>
                    <td><?php echo $noti['fecha2']; ?></td>
                    <td>
                        <a href="editNoti.php?id=<?php echo $noti['id']; ?>"> 
                            <i class="fa-regular fa-pen-to-square"></i>
                        </a>
                    </td>
                    <td>
                        <a href="elimNoti.php?id=<?php echo $noti['id']; ?>" onclick="return confirm('¿Está seguro de que desea eliminar esta noticia?')">
                            <i class="fa-sharp fa-solid fa-trash"></i> 
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            <tbody>
        </table>
    </div> 
    <!-- insertar -->
    <div class="formAgregar hoverEffect notiForm">
        <h2> Agregar una Nueva Noticia </h2>
        <form method="POST" action="altaNoti.php" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>Título de la noticia:</td>
                    <td><input class="form-control" type="text" name="tituNot"  placeholder="Día internacional de la pizza" required></td>
                </tr>
                <tr>
                    <td>Descripción:</td>
                    <td><textarea class="form-control" name="descNot" rows="5" cols="40" placeholder="Disfruta de nuestras promociones."></textarea></td>
                </tr>
                <tr>
                    <td>Foto:</td>
                    <td><input class="form-control" type="file" id="img" name="img" required></td>
                </tr>
                <tr>
                    <td>Fecha</td>
                    <td><input class="form-control" type="date" name="fechaNot" required></td>
                </tr>
                <tr>
                    <td><input type="submit" value="Agregar Noticia"></td>
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