<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda De Camisetas</title>
    <link rel="stylesheet" href="<?=base_url?>assets/css/styles.css" />
</head>

<body>
    <!-- la cabecera -->
    <header id="header">
        <div id="logo">
            <img src="<?=base_url?>assets/img/logo-sport.png" alt="Camiseta Logo" />
            <a href="<?=base_url?>">
                Tienda Overolitos
            </a>
        </div>
    </header>
    <!-- menu -->
    <!-- esto me va a devolver un array de objetos y lo guardamos en la vaiable $categorias -->
    <?php $categorias = Utils::showCategorias();?>
    <nav id="menu">
        <ul>
            <li><a href="<?=base_url?>">Inicio</a></li>
            <!-- por cada iteracion a caegorias, recorreme  y sacame los obejtos de toda la categorias de todo el resulset que me haya deuvelto la base de datos -->
              <?php while ($cat=$categorias->fetch_object()):?>
                <li><a href="<?=base_url?>categoria/ver&id=<?=$cat->id?>"><?=$cat->nombre?></a></li>
              <?php endwhile;?>  
            
        </ul>
    </nav>

    <div id="content">