<h1>Detalle Del Pedido</h1>
<?php if(isset($pedido)): ?>
<?php if(isset($_SESSION['admin'])): ?>
<h3>Cambiar estado del pedido</h3>
<!-- esto permitira cambiar el estado del pedido -->
<form action="<?=base_url?>pedido/estado" method="post">
<input type="hidden" name="pedido_id" value="<?=$pedido->id?>"/>
    <select name="estado" id="">
    <option value="confirm"  <?=$pedido->estado=="confirm"?'selected':'';?>>Pendiente</option>
    <option value="preparation" <?=$pedido->estado=="preparation"?'selected':'';?>>En preparación</option>
    <option value="ready" <?=$pedido->estado=="ready"?'selected':'';?>>Preparado para enviar</option>
    <option value="sended" <?=$pedido->estado=="sended"?'selected':'';?>>Enviado</option>
    </select>
    <input type="submit" value="Cambiar estado"/>
</form>
<br/>
<?php endif; ?>
    <h3>Dirección de envio</h3>
    <p>Provincia:<?=$pedido->provincia?></p>
    <p>Ciudad:<?=$pedido->localidad?></p>
    <p>Direccion:<?=$pedido->direccion?></p><br/>

    <h3>Datos del pedido:</h3>
    <p>Estado:<?=Utils::showStatus($pedido->estado)?></p>
    <p>Número de pedido:<?=$pedido->id?></p>
    <p>Total a pagar:<?=$pedido->coste?></p><br/>
    <p>Productos:
    <table class="table-carrito">
    <tr>
        <th>Imagen</th>
        <th>Nmobre</th>
        <th>Precio</th>
        <th>Unidades</th>
    </tr>
    <!-- creamos un bucle para listar los productos -->
    <!-- en cada iteracion de la variable productos  que me saque un solo producto -->
    <?php while($producto=$productos->fetch_object()): ?>
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
            <td><?=$producto->unidades?></td>
        </tr>   
    <?php endwhile ;?>
    </table>
<?php endif; ?>