<?php
//iniciamos la session para usuario
session_start();

//con esto cargamos el autoload la cual tiene acceso a todos los controladores
require_once 'autoload.php';
//ahora nos conectamos con la base de datos 
require_once 'config/db.php';
//ahora cargamos la url,clase y metodo por defecto
require_once 'config/parameters.php';
//añadimos los helpes para realizar algunas tareas en espesifco(como eliminar sesiones)
require_once 'helpers/utils.php';
//require  a el header sidebar,footer(en la parte inferior).
require_once 'views/layoud/header.php';
require_once 'views/layoud/sidebar.php';

// require_once 'controllers/UsuarioController.php';
//YA ENTENDI el
//LE ESTAMOS INGRESANDO POR GET UN PARAMETRO CON EL NAME = controller
// la cual tiene como valor Nota  y la cual guarda el nombre como 'NotaController', la cual es una clase que esta en la carpeta controlador, y esta clase 'NotaController' se esta guardando en una variable.

//verificamos si entra un parametro por get dentro de la variable controller

//creamos una funcion para el error de pagina y lo llamos donde lo necesitemos
function show_error(){
        //si no exite una clase con el nombre de ...Controller();
        $error =new errorController();
        $error->index();
}



if (isset($_GET['controller'])) {
    $nombre_controlador = $_GET['controller'] . 'Controller';
}elseif(!isset($_GET['controller'])&& !isset($_GET['action'])){
    //para que cargue el controlador por default que esta en parameters
        $nombre_controlador=controller_default;
}
 else {
    show_error();
    exit();
}

//en esta parte coprueba su existe tal variable la cual tiene dentro una clase de controlador llamada 'NotaController'
if (isset($nombre_controlador)) {

    //ahora creamos un objeto llamado controlador
    $controlador = new $nombre_controlador();

    //verificamos que llega por get el name action, lacual tendra dentro de el un metodo llamado (listar)
    //verificamos que el metodo exista method_exists

    if (isset($_GET['action']) && method_exists($controlador, $_GET['action'])) {
        //ahora lo que ingreso por get con el name de action que es el metodo listar se almacena en una variable
        $action = $_GET['action'];
        //ahora es en esta lina final donde se ejecuta el metodo listar, 
        // la cual tiene un requiere hacia la carpeta Vista(views) la cual tiene dentro una carpeta nota la cual tiene una vista llamada listar.php, y dentro de la cual se imprime un h3 y h4 que tiene dentro el getNombre y getDescripcion
        $controlador->$action();
    }elseif(!isset($_GET['controller'])&& !isset($_GET['action'])){
        $action_default=action_default;
        $controlador->$action_default();

    } else {
        show_error();
    }
} else {
    show_error();
}



require_once 'views/layoud/footer.php';
 