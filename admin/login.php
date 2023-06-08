<?php
    session_start();
    include('../js/conexion.php');
    $usuario=$_POST['user'];
    $pss=$_POST['pss'];

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

    // if($atributos['success']){
       
    // } else {
    //     header("Location: index.php?error=Verificar Captcha");
    //     exit;
    // }

    try {
        $stmt = $conn->prepare("SELECT * FROM administrador WHERE usuario=? AND clave=?");
        $resultado = $stmt->execute([$usuario, $pss]);

        while($result = $stmt->fetch(PDO::FETCH_OBJ)){
            $_SESSION['sesionOn']='si';
            $_SESSION['user']=$usuario;
            $_SESSION['pss']=$pss;
            header("Location:usuarios.php");
            exit();
        }
        session_destroy();
        header("Location: index.php?error=Datos incorrectos");
    }catch (PDOException $e) {
        echo "Error: ". $e->getMessage();
    }

    $conn=null;
?>