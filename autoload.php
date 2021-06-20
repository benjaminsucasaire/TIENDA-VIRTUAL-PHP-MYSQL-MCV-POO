<?php
///creamos una funcion que cargara todo lo que esta en controllers
function controllers_autoload($classname){
    //esta funcion entra en la carpeta controllardores y hace un include de cada uno de los controladores
include 'controllers/'.$classname.'.php'; 
}

//ahora utlizamos la funcion spl_autoload_register
//y le pasamos el nombre de la funcion como parametro.
spl_autoload_register('controllers_autoload');