<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda De Camisetas</title>
    <link rel="stylesheet" href="assets/css/styles.css" />
</head>

<body>
    <!-- la cabecera -->
    <header id="header">
        <div id="logo">
            <img src="assets/img/logo-sport.png" alt="Camiseta Logo" />
            <a href="index.php">
                Tienda de camisetas
            </a>
        </div>
    </header>
    <!-- menu -->
    <nav id="menu">
        <ul>
            <li><a href="#">Inicio</a></li>
            <li><a href="#">Categoria 1</a></li>
            <li><a href="#">Categoria 2</a></li>
            <li><a href="#">Categoria 3</a></li>
            <li><a href="#">Categoria 4</a></li>
            <li><a href="#">Categoria 5</a></li>
        </ul>
    </nav>

    <div id="content">
        <!-- barra lateral -->
        <aside id="lateral">
            <div id="login" class="block_aside">
                <h3>Entrar a la web</h3>
                <form action="#" method="post">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="" />
                    <label for="password">Contraseña</label>
                    <input type="password" name="password" id="" />
                    <input type="submit" value="Enviar" />
                </form>
                <ul>
                    <li><a href="#">Mis pedidos</a></li>
                    <li><a href="#">Gestionar pedidos</a></li>
                    <li><a href="#">Gestionar Categorias</a></li>
                </ul>



            </div>
        </aside>

        <!-- contenido central -->
        <div id="central">
            <h1>Productos Destacados</h1>
            <div class="contenedor-producto">
                <div class="product">
                    <img src="assets/img/camiseta.png" alt="" />
                    <h2>Camiseta Azul Ancha</h2>
                    <p>30 euros</p>
                    <a href="" class="boton-comprar">Comprar</a>
                </div>
                <div class="product">
                    <img src="assets/img/camiseta.png" alt="" />
                    <h2>Camiseta Azul Ancha</h2>
                    <p>30 euros</p>
                    <a href="" class="boton-comprar">Comprar</a>
                </div>
                <div class="product">
                    <img src="assets/img/camiseta.png" alt="" />
                    <h2>Camiseta Azul Ancha</h2>
                    <p>30 euros</p>
                    <a href="" class="boton-comprar">Comprar</a>
                </div>
                <div class="product">
                    <img src="assets/img/camiseta.png" alt="" />
                    <h2>Camiseta Azul Ancha</h2>
                    <p>30 euros</p>
                    <a href="" class="boton-comprar">Comprar</a>
                </div>
                <div class="product">
                    <img src="assets/img/camiseta.png" alt="" />
                    <h2>Camiseta Azul Ancha</h2>
                    <p>30 euros</p>
                    <a href="" class="boton-comprar">Comprar</a>
                </div>
                <div class="product">
                    <img src="assets/img/camiseta.png" alt="" />
                    <h2>Camiseta Azul Ancha</h2>
                    <p>30 euros</p>
                    <a href="" class="boton-comprar">Comprar</a>
                </div>
                <div class="product">
                    <img src="assets/img/camiseta.png" alt="" />
                    <h2>Camiseta Azul Ancha</h2>
                    <p>30 euros</p>
                    <a href="" class="boton-comprar">Comprar</a>
                </div>
                <div class="product">
                    <img src="assets/img/camiseta.png" alt="" />
                    <h2>Camiseta Azul Ancha</h2>
                    <p>30 euros</p>
                    <a href="" class="boton-comprar">Comprar</a>
                </div>
            </div>

        </div>
    </div>

    <!-- pie de pagina -->
    <footer id="footer">
        <p>Desarrollado por Benjamin Sucasaire &copy; <?= date('Y') ?></p>
    </footer>


</body>

</html>