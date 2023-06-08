<?php
    $error = isset($_GET['error']) ? $_GET['error'] : "";
?>

<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador de contenidos</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="bootstrap/css/bootstrap-grid.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/0e1cd44541.js" crossorigin="anonymous"></script>
    <!-- Google recaptcha -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <!-- Estilos -->
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body class="formIniciar">
    <div class="register">
        <img class="site_logo" src="../img/logotipo.png" alt="Logo de Bendita Pizza">
        <h1>Ayúdanos a encontrarte</h1>

        <form action="contra.php" method="POST" class="form">
            <div class="form__container">
                <div class="form__field">
                    <input type="text" name="correo" id="correo" placeholder=" " autocomplete="off" required>
                    <label for="correo" class="form__label">Correo elctrónico</label>
                </div>
                <div class="form__field">
                    <div class="g-recaptcha" data-sitekey="6LdNVUYmAAAAAPKeHGUosIt_2rP8XxyWwCwbmKk1"></div>
                </div>
                <div class="form__field">
                    <input type="submit" value="Solicitar nueva contraseña">
                </div>
            </div>
        </form>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?php echo $error ?></div>
        <?php endif ?>

    </div>

    <a href="index.php" id="btnSalir"> <i class="fa-solid fa-xmark"></i> </a>
</body>
</html>