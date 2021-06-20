<h1>Registrarse</h1>

<!-- ahora mostramos lo que lleva dentro la session que fue creada en UsuarioController.php
si existe la sesion
AHORA MUY IMPORTANTE PONERLO EN LA SINTAXIS ESPECIAL DE VISTAS DE PHP -->
<!-- si la session existe y la seesion es igual a complete -->
<?php if(isset($_SESSION['register']) &&$_SESSION['register']=='complete'):?>
<strong class="alert_green">Registro Completado correctamente!!</strong>
<!-- si la session existe y la seesion es igual a failed -->
<?php elseif(isset($_SESSION['register']) &&$_SESSION['register']=='failed'): ?>
    <strong class="alert_red">Registro Fallido,introduce bien los datos!!</strong>
<?php endif; ?>
<!-- llamamos a la clase Utlis y a su metodo deleteSession -->
<!-- esto permite que la seesion se destruya y poder dejar de ver el strong -->
<?php Utils::deleteSession('register'); ?>

<form action="<?=base_url?>usuario/save" method="post">
<label for="nombre">Nombre</label>
<input type="text" name="nombre" id=""  required/>
<label for="apellidos">Apellidos</label>
<input type="text" name="apellidos" id="" required/>
<label for="email">Correo</label>
<input type="email" name="email" id="" required/>
<label for="password">Contraseña</label>
<input type="password" name="password" id="" required/>
<input type="submit" value="Registrarse" />
</form>