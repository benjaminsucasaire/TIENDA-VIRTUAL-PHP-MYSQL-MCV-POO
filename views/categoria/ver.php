<?php if(isset($categoria)):?>
<h1><?=$categoria->nombre?></h1>
    <!-- si el numero de filas es igual a cero entonces -->
        <?php if($productos->num_rows==0):?>
            <p>No hay productos en esta categoria</p>
        <?php else: ?>
            <div class="contenedor-producto"> 
                <!-- creame un objeto en base a la variable $productos y sacalo como objetos -->
                <?php while($product=$productos->fetch_object()):?>

                    <div class="product">
                    <a href="<?=base_url?>producto/ver&id=<?=$product->id?>" class="enlace-pro">
                                 <!-- podemos hacer una condicional para que cuando no tenga imagenes coloquemos una por defecto -->
                                <?php if($product->imagen != null):?>
                                <img src="<?=base_url?>uploads/images/product/<?=$product->imagen?>" alt="" />
                                <?php else:?>
                                <img src="<?=base_url?>assets/img/camiseta.png" alt="" />
                                <?php endif;?>
                                <h2><?=$product->nombre?></h2>
                        </a>
                        <p><?=$product->precio?></p>
                        <a href="<?=base_url?>carrito/add&id=<?=$product->id?>" class="boton-comprar">Comprar</a>
                    </div>
                    <?php endwhile; ?>
            </div>
        <?php endif; ?>
<?php else: ?>
<h1>La categoria no existe</h1>
<?php endif; ?>