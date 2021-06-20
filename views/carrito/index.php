<h1>Carrito e la compra</h1>

<?php if(isset($_SESSION['carrito']) && count($_SESSION['carrito'])>=1): ?>
<table class="table-carrito">
<tr>
<th>Imagen</th>
<th>Nombre</th>
<th>Precio</th>
<th>Uds</th>
<th>Eliminar</th>
</tr>
<?php

// use Spipu\Html2Pdf\Tag\Html\U;

foreach($carrito as $indice =>$elemento): 
    $producto =$elemento['producto'];
    ?>
 <tr>
 <td>
                                <!-- podemos hacer una condicional para que cuando no tenga imagenes coloquemos una por defecto -->
                                <?php if($producto->imagen != null):?>
                                <img class="carrito" src="<?=base_url?>uploads/images/product/<?=$producto->imagen?>" alt="" />
                                <?php else:?>
                                    <img class="carrito" src="<?=base_url?>assets/img/camiseta.png" alt="" />
                                <?php endif;?>
 </td>
 <td><a href="<?=base_url?>producto/ver&id=<?=$producto->id?>"><?=$producto->nombre?></a></td>
 <td><?=$producto->precio?></td>
 <!-- cremos enlaces para aumentar o disminuir elementos al carrito -->
 <td>
    <a href="<?=base_url?>carrito/up&index=<?=$indice?>" class="button button-delgado">+</a>
    <?=$elemento['unidades']?>
    <a href="<?=base_url?>carrito/down&index=<?=$indice?>" class="button button-delgado">-</a>
 </td>
 <td>
     <!-- aca colocamos el index del productos que queramos elimiar del carrito  -->
 <a href="<?=base_url?>carrito/delete&index=<?=$indice?>" class="button button-pedido alert_red">Quitar producto</a>
</td>
</tr>
<?php endforeach; ?>
</table>
</br>

<div class="contenedor-carrito">
    <div class="contenedor-delete">
        <a href="<?=base_url?>carrito/delete_all" class="button button-pedido alert_red">Vaciar pedido</a>
    </div>

    <div class="contenedor-confirma">
        <?php $stats = Utils::statsCarrito(); ?>
        <h3 class="precio">Precio total: S/.<?=$stats['total']?></h3>
        <a href="<?=base_url?>pedido/hacer" class="button button-pedido alert_green">Hacer pedido</a>
    </div>
</div>
<?php else: ?>
    <p>El Carrito esta vacio, añade algun producto</p>
<?php endif; ?>