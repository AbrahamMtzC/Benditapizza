<?php
    include('../js/conexion.php');

    $correo=$_POST['correo'];

    $ip = $_SERVER['REMOTE_ADDR'];
    $captcha = $_POST['g-recaptcha-response'];
    $secretkey = "6LdNVUYmAAAAALj9ydcXPmmcYKWivEmHulkSmz-Y";
    $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' .$secretkey. '&response=' .$captcha;

    //if(isset($_POST['g-recaptcha-response'])){
    //    $recaptcha=$_POST['g-recaptcha-response'];
        //if(!$recaptcha){
            //header("Location: index.php?error=Verificar Captcha");
            //exit;
        //}
    //}

    $respuesta = file_get_contents($url);
    $atributos = json_decode($respuesta, TRUE);

    if($atributos['success']){
    } else {
        header("Location: olvidarCon.php?error=Verificar Captcha");
        exit;
    }

    try {
        $stmt = $conn->prepare("SELECT * FROM administrador WHERE email=?");
        $resultado = $stmt->execute([$correo]);

        if ($stmt->rowCount() > 0) {
            // La cuenta existe en la base de datos
            //Obtener id
            $stmt = $conn->prepare("SELECT id FROM administrador WHERE email = ?");
            $stmt->execute([$correo]);
            $id = $stmt->fetchColumn();

            header("Location: /admin/PHPMailer/index.php?id=" . $id);
            //header("Location: index.php?msj=Se ha enviado un correo a la cuenta correspondiente.");
            exit;
        } 

        header("Location: olvidarCon.php?error=No existe ninguna cuenta asociada con ese correo.");
    }catch (PDOException $e) {
        echo "Error: ". $e->getMessage();
    }

    $conn=null;
?>