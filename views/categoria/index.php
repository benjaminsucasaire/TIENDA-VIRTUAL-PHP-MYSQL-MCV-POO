<h1>Gestionar categorias</h1>
<!-- creamos un boton para crear categorias -->
<a href="<?=base_url?>/categoria/crear" class="button button-small">Crear Categoria</a>
<!-- los resultado lo colocamos en una tabla -->
<table class="table-carrito">
        <!-- ahora colocamos los encabezados de la tabla que seria el id y nombre -->
        <tr class="cabecera">
            <th>ID</th>
            <th>NOMBRE</th>
        </tr>
        <!-- esto permite que en cada iteracion se cree un objeto de la avar -->
        <?php while($cat=$categorias->fetch_object()):?>
          <!-- un tr de cada finla  -->
          <tr>
            <!-- ahora mostramos las columnas -->
            <td><?=$cat->id?></td>
            <td><?=$cat->nombre?></td>
          </tr> 
        <?php endwhile;?>
</table>