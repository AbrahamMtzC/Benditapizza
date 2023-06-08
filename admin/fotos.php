<?php
    include("../js/conexion.php");
    $stmt = $conn->prepare("SELECT * FROM fotos ORDER BY id DESC");
    $stmt->execute();
    $fotos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    include("header.php");

    $error = isset($_GET['error']) ? $_GET['error'] : "";
?>
<div class="catego">
    <div>
        <h2>Fotos</h2>
        <table class="contTabla">
            <thead>
            <tr>
                <th>Foto</th>
                <th>Titulo</th>
                <th>Modificar</th>
                <th>Borrar</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($fotos as $fot): ?>
                <tr>
                    <td><img src="<?php echo $fot['foto']; ?>"></td>
                    <td><?php echo $fot['titulo']; ?></td>
                    <td>
                        <a href="editFot.php?id=<?php echo $fot['id']; ?>">
                            <i class="fa-regular fa-pen-to-square"></i>
                        </a>
                    </td>
                    <td>
                        <a href="elimFot.php?id=<?php echo $fot['id']; ?>"
                            onclick="return confirm('¿Está seguro de que desea eliminar esta foto?')">
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
        <h2> Agregar una Nueva Foto </h2>
        <form method="POST" action="altaFoto.php" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>Título:</td>
                    <td><input class="form-control" type="text" name="tituFoto" placeholder="Chicago Style"></td>
                </tr>
                <tr>
                    <td>Foto:</td>
                    <td>
                        <input class="form-control" type="file" id="img" name="img" required>
                    </td>
                </tr>
                <tr>
                    <td><input type="submit" value="Agregar Foto"></td>
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