<h1>Gestion de productos</h1>
<!-- creamos un boton para crear categorias -->
<a href="<?=base_url?>/producto/crear" class="button button-small">Crear Producto</a>
<?php if(isset($_SESSION['producto']) && $_SESSION['producto'] == 'complete'):?>
<strong class="alert_green">El producto se ha creado correctamente</strong>

<?php elseif(isset($_SESSION['producto']) && $_SESSION['producto'] != 'complete'):?>
<strong class="alert_red">El producto  NO se ha creado correctamente</strong>
<?php endif;?>
<!-- ahora borramos las sessiones utilizadas -->

<?php Utils::deleteSession('producto');?>


<!-- esto sera para la parte de editar o eliminar un producto -->
<?php if(isset($_SESSION['delete']) && $_SESSION['delete'] == 'complete'):?>
<strong class="alert_green">El producto se ha eliminado correctamente</strong>

<?php elseif(isset($_SESSION['delete']) && $_SESSION['delete'] != 'complete'):?>
<strong class="alert_red">El producto  NO se ha eliminado correctamente</strong>
<?php endif;?>
<!-- ahora borramos las sessiones utilizadas -->

<?php Utils::deleteSession('delete');?>

<!-- ---------------------------------------------------------- -->
<!-- los resultado lo colocamos en una tabla -->
<table class="table-carrito">
        <!-- ahora colocamos los encabezados de la tabla que seria el id y nombre -->
        <tr class="cabecera">
            <th>ID</th>
            <th>NOMBRE</th>
            <th>PRECIO</th>
            <th>STOCK</th>
            <th>ACCIONES</th>
        </tr>
        <!-- esto permite que en cada iteracion se cree un objeto de la avar -->
        <!-- el resulset lo convierte en un array de obejtos -->
        <?php while($pro=$productos->fetch_object()):?>
          <!-- un tr de cada finla  -->
          <tr>
            <!-- ahora mostramos las columnas -->
            <td><?=$pro->id?></td>
            <td><?=$pro->nombre?></td>
            <td><?=$pro->precio?></td>
            <td><?=$pro->stock?></td>
            <td>
            <div class="contenedorbotonEE"> 
               <!-- para poder editar este producto tenemos que agarrar su id -->
            <a href="<?=base_url?>producto/editar&id=<?=$pro->id?>" class="button boton-editar">Editar</a>
            <!-- para poder elimiar este producto tenemos que agarrar su id -->
            <a href="<?=base_url?>producto/eliminar&id=<?=$pro->id?>" class="button boton-eliminar">Eliminar</a>
            </div>
            </td>
          </tr> 
        <?php endwhile;?>
</table>