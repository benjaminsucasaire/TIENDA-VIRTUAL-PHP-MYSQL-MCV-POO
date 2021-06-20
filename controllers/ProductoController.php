<?php
//cargamos el modelo para este controloadore
require_once 'models/producto.php';
//en cada uno tenemos que tener una clase 
class productoController{
    //creamos un metodo 
    public function index(){
      //llamamos al metodo que mostrara los productos de una matera aleatoria
      $producto=new Producto();
      //Ahora utlizamos el metodo getRandom($limit) e ingresamos un valor numerico para cantidad de productos a mostrar y lo guardamos e una variable 
        $productos=$producto->getRandom(8); 
      
        // echo 'Controlador Productos, Acción index';
        //renderizar vista
        //conocer bien los require, ya que comienza desde la raiz
        require_once 'views/producto/destacados.php';
       
    }
    //este metodo permitira ver el producto
    public function ver(){
      //comprobamos que me llegue por get el id
      if(isset($_GET['id'])){
        //CREAMOS UNA VARIABLE $EDIT
        $id=$_GET['id'];
        
    //creamos nuestro objeto
    $producto=new Producto();

    //le ingresamos el dato de id a nuestro objeto
    $producto->setId($id);
    //con le metodo que creamos sacamos el registro con el id ingresado el resultado lo guardamos en una variable
        $product=$producto->getOne();
      

  }
    //INCLUIMOS UNA VISTA a l final para que pueda tener los datos que sacamos, ya que la programacion va de arriba para abajo
    require_once 'views/producto/ver.php';
}


    public function gestion(){
      //comprobamos que sea un administrador
      Utils::isAdmin();
      //creamos un objeto apartir de la clase Producto();del modelo
      $producto = new Producto();
      //creamos
      //esto devuelve al objeto con el metodo de listar todos los productos
      $productos=$producto->getAll();
      require_once 'views/producto/gestion.php'; 
      
      return $productos;
    }

    //metodo para crear nuevo producto
    public function crear(){
      //comprobamos que sea un administrador
      Utils::isAdmin();
      require_once 'views/producto/crear.php';

    }
    
    //un metodo para guardar el producto de
    public function save(){
       //comprobamos que sea un administrador
       Utils::isAdmin();
      //si existe datos ingresados por post
      if(isset($_POST)){
        //utilizamos un ternario para comprobar si ingresa los datos
        $nombre = isset($_POST["nombre"])?$_POST["nombre"]:false;
        $descripcion = isset($_POST["descripcion"])?$_POST["descripcion"]:false;
        $precio = isset($_POST["precio"])?$_POST["precio"]:false;
        $stock = isset($_POST["stock"])?$_POST["stock"]:false;
        $categoria = isset($_POST["categoria"])?$_POST["categoria"]:false;

        
        //$imagen = isset($_POST["imagen"])?$_POST["imagen"]:false;
        //coprobamos que todos los datos llegaron bien
        if($nombre && $descripcion && $precio && $stock && $categoria){
          //creamos un objeto apartir de  la clase Producto(); que esta en el modelo
            $producto= new Producto();
            //ahora a este objeto le insertamos los datos por set ingresando los dator por parametros
            $producto->setNombre($nombre);
            $producto->setDescripcion($descripcion);
            $producto->setPrecio($precio);
            $producto->setStock($stock);
            $producto->setCategoria_id($categoria);



            //guardar la imagen
            //comprobamos que la imagen me llegue
            if(isset($_FILES['imagen'])){
                //es como crear un objeto en base a una clase, pero en este caso estamos agregando la iamgen
                $file=$_FILES['imagen'];
                //sacamos el nombre de la imagen en
                $filename=$file['name'];
                //sacamos  el tipo de dato de la imagen
                $mimetype=$file['type'];
                
                    //ahora hacemos una condicional para que solo guarde arcihvos de tipo imagen
                    if($mimetype =="image/jpg" || $mimetype =="image/jpeg" || $mimetype =="image/png" || $mimetype =="image/gif" ){
                      //si cumple  con la condicion que se guard
                      //y hacemos una condicional para que se guarde en una carpeta determinada
                      if(!is_dir('uploads/images/product')){
                        // si no existe la carpeta uploads/images
                        //creamos la carpeta
                        //agregamos la ruta donde se creara la carpeta images y el tipo de permiso para esa imagen
                        //MUY IMPORTANTE PONERLE TRUE, PARA QUE CREE DIRECTORIOS DENTRO DE OTRO RECURSIVAMENTE
                        mkdir('uploads/images/product',0777,true);
                      }
                                    //seteamos la variable imagen
                                  $producto->setImagen($filename);
                      //utlilizamos la funcion  PARA GUARDAR EL ARCHIVO
                      //ingresamos su nombre tenporal tmp_name
                      //y aohra le damos su verdadero nombre  con la ruta donde se guardara
                      move_uploaded_file($file['tmp_name'],'uploads/images/product/'.$filename);
                }
            }

            //AHORA AREMOS UNA CONDICIONAL PARA LOS DOS CASOS EDITAR Y GUARDAR
            //si existe un id por get
            if(isset($_GET['id'])){
              $id=$_GET['id'];
              //pasamos el id que me llegue por get 
              $producto->setId($id);
            //ejecutamos el metodo edit y lo guardamos dentro de una variable 
            $save=$producto->edit();
            }else{
              //si no ingresa ningun parametro id por get entonces solamente guardamos
              $save=$producto->save();
            }
          
              //si save da true o en otras palabras que se ejecuto  con total normalidad
              if($save){
                //creamos un session la cual indicara si se guardo correctamento o no
                  $_SESSION['producto']="complete";
              }else{
                //si los datos no se guardaron correctamente
                $_SESSION['producto']="failed";
              }
        }else{
          //si uno de los datos estan vacios 
          $_SESSION['producto']="failed";
        }

      }else{
        //si no me llega nada por post
        $_SESSION['producto']="failed";
      }
      //ahora hacemos una redireccion  donde se ven los productos
      header('Location:'.base_url.'producto/gestion');
    }
    //creamos los metodos para editar y elminar
    public function editar(){
            //comprobamos que sea un administrador
            Utils::isAdmin();
       //comprobamos que me llegue por get el id
       if(isset($_GET['id'])){
            //CREAMOS UNA VARIABLE $EDIT
            $id=$_GET['id'];
          $edit=true;
            
        //creamos nuestro objeto
        $producto=new Producto();

        //le ingresamos el dato de id a nuestro objeto
        $producto->setId($id);
        //con le metodo que creamos sacamos el registro con el id ingresado el resultado lo guardamos en una variable
            $pro=$producto->getOne();
            //INCLUIMOS UNA VISTA a l final para que pueda tener los datos que sacamos, ya que la programacion va de arriba para abajo
            require_once 'views/producto/crear.php';

       }else{
         //por ultimo hacemos una redireccion a la gestion de productos
      header('Location:'.base_url.'producto/gestion');
       }
      
    }


    public function eliminar(){
      //comprobamos que sea un administrador
      Utils::isAdmin();
      //comprobamos que me llegue por get el id
      if(isset($_GET['id'])){
        //pasamo el id que nos llega por get 
        $id=$_GET['id'];
        //creamos un objeto apartir de la clase
        $producto= new Producto();
        //ingresamos el id que nos llega por la url a nuestro objeto 
        $producto->setId($id);
        //ejecutamos el metodo delete, y lo guardamos en una variable
        $delete= $producto->delete();

        //si el metodo se ejecuto correctamente la vartiable $delete estara en true 
        if($delete){
            //creamos un session que sea delete
            $_SESSION['delete']='complete';
        }else{
          $_SESSION['delete']='failed';
        }
      }else{
        $_SESSION['delete']='failed';
      }

      //por ultimo hacemos una redireccion a la gestion de productos

      header('Location:'.base_url.'producto/gestion');
    }
}
