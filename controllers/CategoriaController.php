<?php
//añadimos el archivo categoria que esta en modelo
require_once 'models/categoria.php';
//cargamos el modelo producto para poder sacar el listado de productos en categoria
require_once 'models/producto.php';
//en cada uno tenemos que tener una clase 
class categoriaController{
    //creamos un metodo 
    public function index(){
        //coprobamos que el usuario es administrador
        Utils::isAdmin();
        //creamos un objeto en base a la clase de categoria que esta en mi modelo  
        $categoria = new Categoria();
        //llamamos al metodo getAll que creamos en el modelo;
        //y lo guardamos en otro variable la cual tedra las categorias 
        $categorias=$categoria->getAll();

        require_once 'views/categoria/index.php'; 
        
    }
    public function ver(){
        if(isset($_GET['id'])){
            $id=$_GET['id'];
            
            
            //conseguir categoria

            //creamos un objeto en base a la clase objeto();
            $categoria=new Categoria();
            //le pasamos el id y lo seteamoss
            $categoria->setId($id);
            //ejecutamos el metodo getOne()
             //aca me sacarala informacion de la categoria selecionada desde la base de datos
            $categoria=$categoria->getOne();
             
            
            //conseguir productos
            $producto = new Producto();
            $producto->setCategoria_id($id);
            $productos=$producto->getAllCategory();
        }
        //creamos una vist para poder ver
         require_once 'views/categoria/ver.php';;   
    }   

    public function crear(){
        //coprobamos que el usuario es administrador
        Utils::isAdmin();
        require_once 'views/categoria/crear.php';
    }
    public function save(){
        //coprobamos que el usuario es administrador
        Utils::isAdmin();
        //verificamos si existe el metodo post y que ingrese con el nombre de nombre
        if(isset($_POST) && isset($_POST['nombre'])){
            //guardar la categoria en la bd
                    //creamos un objeto categoria
                    $categoria=new Categoria();
                    //ingresamos el dato que ingreso por post 
                    $categoria->setNombre($_POST['nombre']);
                    //ahora utilizamos el metodo creado en modelo categoria save
                    $categoria->save();
        }
       
        //redireccion
        header("Location:".base_url."categoria/index");
    }
}
