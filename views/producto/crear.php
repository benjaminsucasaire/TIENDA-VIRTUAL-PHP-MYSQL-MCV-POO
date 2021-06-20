<!-- verificamos si existe la variable edit y si sexiste la variable $pro y si $pro es un objeto -->
<?php if(isset($edit) && isset($pro) && is_object($pro)):?>
<h1>Editar productos <?=$pro->nombre?></h1>
     <!-- le damos una ruta para editar el producto  como action y le damos el id del producto elejido-->
     <?php $url_action=base_url."producto/save&id=".$pro->id;?>
<?php else:?>
    <h1>Crear nuevo producto</h1>
        <!-- le damos una ruta para guardar como action -->
    <?php $url_action=base_url."producto/save";?>
<?php endif;?>

<div class="form_container">
  
<!-- esto me permiteenviar ficheros en el formmulario multipart/form-data -->
    <form action="<?=$url_action?>" method="post" enctype="multipart/form-data">

        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" value="<?=isset($pro) && is_object($pro)?$pro->nombre:''?>"/>

        <label for="descripcion">Descripcion</label>
        <!-- utilizamos una texarea para que nos permite llenar mas texto -->
        <textarea name="descripcion"><?=isset($pro) && is_object($pro)?$pro->descripcion:''?></textarea>

        <label for="precio">Precio</label>
        <input type="text" name="precio" id="" value="<?=isset($pro) && is_object($pro)?$pro->precio:''?>" />

        <label for="stock">Stock</label>
        <input type="number" name="stock" id="" value="<?=isset($pro) && is_object($pro)?$pro->stock:''?>" />

        <label for="categoria">Categoria</label>
        <!-- esto me devolveria las categorias -->
        <?php $categorias = Utils::showCategorias(); ?>
        <select name="categoria" >
            <!-- por cada iteracion a caegorias, recorreme  y sacame los obejtos de toda la categorias de todo el resulset que me haya deuvelto la base de datos -->
            <?php while ($cat = $categorias->fetch_object()) : ?>
                <!-- MUY IPORTANTE QUE CADA CATEGORIA ESTA ENLAZADO CON SU ID Y ESE ID SERA EL ENVIADO POR EL VALUE CUANO ALGUIEN ELIJE UNA CATEGORIA POR SU NOMBRE  -->

                        <!-- para la opcion de editar  la ternario mesiona que is existe $pro y si es una objeto y si existe un id en $cat->id que sea igual a $pro->categoria_id entonces que lo selecione y si todo eso es falso, entonces que no haga nada o este ''  -->
            <option value="<?= $cat->id ?>"<?=isset($pro) && is_object($pro) && $cat->id==$pro->categoria_id?'selected':''?>>
                    <!-- las opciones a elejir seran los nombres de la categoria -->
                    <?= $cat->nombre ?>
                </option>
            <?php endwhile; ?>
        </select>

        <label for="imagen">Imagen</label>
        <!-- hacemos una condicional  -->
                <!-- si existe y es un objeto y no esta vacio la propiedad $pro->imagen -->
        <?php if(isset($pro) && is_object($pro) && !empty($pro)):?>
            <img src="<?=base_url?>uploads/images/product/<?=$pro->imagen?>" class="imagen-miniatura" />
        <?php endif;?>
        <input type="file" name="imagen" id="">

        <input type="submit" value="Guardar">
    </form>

</div>