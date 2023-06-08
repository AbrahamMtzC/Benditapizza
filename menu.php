<?php 
    include "js/conexion.php";
    $stmt = $conn->prepare("SELECT * FROM productos ORDER BY idCat");
    $stmt->execute();
    $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Inicio</title>
    <meta description="Menú del sitio de Bendita Pizza">
    <meta keywords="Pizzas estilo Chicago, Restaurante de pizzas en Durango, Pasta fresca y casera, Hamburguesas gourmet, Comida para llevar, Bebidas refrescantes, Cena en familia, Servicio a domicilio, Ingredientes frescos y de alta calidad, Menú variado, Ambiente acogedor y relajante">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="bootstrap/css/bootstrap-grid.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/0e1cd44541.js" crossorigin="anonymous"></script>
    <!-- Estilos -->
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <div id="preloader"> <img src="img/benditaloading.gif" alt=""></div>
    <div class="icoderecha">
        <ul>
            <li> <a href="https://www.facebook.com/BenditaPizzaDgo" target="_blank"><i class="fa-brands fa-facebook"></i></a></li>
            <li> <a href="https://www.instagram.com/benditapizzadgo/?hl=es" target="_blank"><i class="fa-brands fa-instagram"></i></a></li>
            <li> <a href="reservar.html"><i class="fa-brands fa-whatsapp"></i></a></li>
        </ul>
    </div>
    <header>
		<nav class="barra">
            <div class="logo">
                <a href="index.html"><img src="img/logotipo.png" alt="Logo oficial de Bendita Pizza"></a>
            </div>
            <ul>
                <li><a href="index.html">Inicio</a></li>
                <li><a href="menu.php">Menú</a></li>
                <li><a href="noticias.php">Noticias</a></li>
                <li><a href="fotos.php">Fotos</a></li>
                <li><a href="reservar.html" class="bt-reservar">Reservar</a></li>
            </ul>
            <div class="hamburguesa">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
		</nav>
	</header>
    <main>
        <div class="separador"></div>
        
        <div class="menu">
            <div class="busqueda">
                <div class="selectCat">
                    <select class="form-control" name="select">
                        <option disabled selected>Ordenar Por:</option>
                        <option value="preci">Precio</option>
                        <option value="categ">Categorías</option>
                    </select>
                    <button id="btnOrdenar">
                        <i class="fa-solid fa-arrows-up-down"></i>
                    </button>
                    <select class="form-control" id="selectCategorias" type="text" name="prodCat">
                        <option value="todas" selected>Todas</option>
                            <?php
                                $stmt3 = $conn->prepare("SELECT * FROM categorias");
                                $stmt3->execute();
                                $categorias = $stmt3->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($categorias as $cate):
                            ?>
                                <option value="<?php echo $cate['nombre']; ?>"> <?php echo $cate['nombre']; ?> </option>
                            <?php endforeach; ?>
                    </select>
                </div>
            </div>
        
            <div class="galeria" id="galeria">
                <?php foreach ($productos as $produ): ?>
                    <div class="contenido">
                        <img loading="lazy" src="<?php echo substr($produ['foto'], 3); ?>" alt="<?php echo $produ['nombre']; ?>">
                        <h3><?php echo $produ['nombre']; ?></h3>
                        <p><?php echo $produ['descripcion']; ?></p>

                        <?php
                            $stmt2 = $conn->prepare("SELECT * FROM categorias WHERE id = " . $produ['idCat']);
                            $stmt2->execute();
                            $categoria = $stmt2->fetchAll(PDO::FETCH_ASSOC);
                            if(count($categoria) > 0) { // Verificamos si hay al menos una fila en el resultado
                        ?>        
                                <h4><?php echo $categoria[0]['nombre']; ?></h4>
                        <?php 
                            } 
                        ?>
                        <h6>$<?php echo $produ['precio']; ?>MXN</h6>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="separador"></div>
    </main>
    <footer>
        <div class="columnas-footer">
            <div class="columna-footer">
                <h2>Come con nosotros</h2>
                <ul>
                    <li><a href="menu.php">Menú</a></li>
                    <li><a href="reservar.html">Reservar una mesa</a></li>
                    <li><a href="reservar.html">Encuentra una sucursal</a></li>
                    <li><a href="entrega.html">Entrega a domicilio</a></li>
                </ul>
            </div>
            <div class="columna-footer">
                <h2>Explora</h2>
                <ul>
                    <li><a href="noticias.php">Blog de noticias</a></li>
                    <li><a href="acerca.html">Acerca de nosotros</a></li>
                    <li><a href="historia.html">Historia</a></li>
                </ul>
            </div>
            <div class="columna-footer">
                <h2>Mantente conectado</h2>
                <ul>
                    <li><a href="reservar.html">Contáctanos</a></li>
                    <li><a href="https://www.facebook.com/BenditaPizzaDgo" target="_blank">Facebook</a></li>
                    <li><a href="https://www.instagram.com/benditapizzadgo/?hl=es" target="_blank">Instagram</a></li>
                </ul>
            </div>
        </div> 
        <div class="footlogo">
            <img src="img/altlogo.png" alt="Logo oficial de Bendita Pizza">
        </div>
        <div class="texto-footer">
            <p>@ 2023 BENDITA PIZZA</p>
        </div>
        <div class="footicons">
            <a href="https://www.facebook.com/BenditaPizzaDgo" target="_blank"><i class="fa-brands fa-facebook footicon"></i></a>
            <a href="https://www.instagram.com/benditapizzadgo/?hl=es" target="_blank"><i class="fa-brands fa-instagram footicon"></i></a>
            <a href="reservar.html"><i class="fa-brands fa-whatsapp footicon"></i></a>
        </div>
    </footer>
     <div class="benditaburger">
        <a href="https://benditaburgermx.com" target="_blank">
            <img src="img/benditaburger.png">
        </a>
    </div>  
    <!-- boton para regresar -->
    <button onclick="topFunction()" id="btnRegresar" title="Regresar arriba"> <i class="fa-regular fa-circle-up"></i> </button>

    <!-- Javascript -->
    <script src="js/scripts.js"></script>
</body>
</html>

<?php
    $conn = null;
?>