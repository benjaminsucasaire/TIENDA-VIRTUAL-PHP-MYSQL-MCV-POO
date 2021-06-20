<?php if(isset($gestion)):?>
<h1>Gestionar pedidos</h1>
<?php else: ?>
<h1>Mis pedidos</h1>
<?php endif; ?>
<table class="table-carrito">
<tr>
<th>N° Pedido</th>
<th>coste</th>
<th>Fecha</th>
<th>Estado</th>
</tr>
<?php
// en cada iteracion que yo haga me cree un objeto $ped
while($ped=$pedidos->fetch_object()):
    ?>
    <tr>
        <td>
        <a href="<?=base_url?>pedido/detalle&id=<?=$ped->id?>"><?=$ped->id?></a>

        </td>
        <td>
        <span>S/.</span><?=$ped->coste?>
        </td>
        <td>
        <?=$ped->fecha?>
        </td>
        <td>
        <?=Utils::showStatus($ped->estado)?>
        </td>
    </tr>
<?php endwhile; ?>
</table>