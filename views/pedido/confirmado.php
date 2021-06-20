<?php if(isset($_SESSION['pedido']) && $_SESSION['pedido']=='complete') :?>
<h1>Tu pedido se ha confirmado</h1>
<p>Tu pedido ha sido guardado con exito, una vez que realices la transferencia bancaria a la cuenta 7382947289239ADD con el coste del pedido, será procesado y enviado.</p>
<br/>
<!-- verificamos que exista la variable pedido sacado del metodo confirmado  -->
<?php if(isset($pedido)): ?>
    <h3>Datos del pedido:</h3>
    <br/>
    <!-- la etiqueta pre mantiene los saltos de linea que yo ponga -->
    <p>Número de pedido:<?=$pedido->id?></p><br/>
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

<?php elseif(isset($_SESSION['pedido']) && $_SESSION['pedido']!='complete') : ?>
    <h1>Tu pedido NO se logro procesar</h1>
<?php endif; ?>