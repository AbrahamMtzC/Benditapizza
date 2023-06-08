<?php
    include("../js/conexion.php");
    $stmt = $conn->prepare("SELECT * FROM administrador");
    $stmt->execute();
    $administrador = $stmt->fetchAll(PDO::FETCH_ASSOC);
    include("header.php");
?>
<div class="catego">
    <div>
        <h2>Usuarios Administradores</h2>
        <table class="contTabla">
            <thead>
            <tr>
                <th>Usuario</th>
                <th>Email</th>
                <th>Modificar</th>
                <th>Borrar</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($administrador as $admin): ?>
                    <tr>
                        <td><?php echo $admin['usuario']; ?></td>
                        <td><?php echo $admin['email']; ?></td>
                        <td>
                            <a href="editUser.php?id=<?php echo $admin['id']; ?>"> 
                                <i class="fa-regular fa-pen-to-square"></i>
                            </a>
                        </td>
                        <td>
                            <a href="elimUser.php?id=<?php echo $admin['id']; ?>" onclick="return confirm('¿Está seguro de que desea eliminar este usuario?')">
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
        <h2> Agregar un Nuevo Usuario </h2>
        <form method="POST" action="altaUser.php">
            <table>
                <tr>
                    <td>Nombre de usuario:</td>
                    <td><input type="text" name="nomUser"  placeholder="Usuario123" required></td>
                </tr>
                <tr>
                    <td>Contraseña:</td>
                    <td><input type="password" name="contraUser"  placeholder="••••••••••" required></td>
                </tr>
                <tr>
                    <td>Correo:</td>
                    <td><input type="email" name="correoUser" placeholder="info@correo.com" required></td>
                </tr>
                <tr>
                    <td><input type="submit" value="Ingresar Usuario"></td>
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