<?php
//cargamos el modelo
require_once 'models/producto.php';
//en cada uno tenemos que tener una clase 
class carritoController{
    //creamos un metodo 
    public function index(){
        if(isset($_SESSION['carrito']) && count($_SESSION['carrito'])>=1){
            $carrito=$_SESSION['carrito'];
            
        }else{
            //si es falso que $carrito sea un array vacio;
            $carrito=array();
        }
        require_once 'views/carrito/index.php';
        
    }
    public function add(){
        if(isset($_GET['id'])){
            $producto_id=$_GET['id'];
        }else{
        // hacemos una redireccion 
      header('Location:'.base_url);
        }

        if(isset($_SESSION['carrito'])){
            $counter = 0;
           
            //si exista
            foreach($_SESSION['carrito'] as $indice => $elemento){
                
                if($elemento['id_producto'] == $producto_id){
                    $_SESSION['carrito'][$indice]['unidades']++;
                    $counter ++;
                }
            }
        }

        if(!isset($counter) || $counter==0){
            //conseguir producto
            $producto = new Producto();
            $producto->setId($producto_id);
            
            //el objeto del producto
            $producto=$producto->getOne();
            
            //añadir al carrito 
            if(is_object($producto)){
                $_SESSION['carrito'][]=array(
                   "id_producto"=>$producto->id, 
                   "precio"=>$producto->precio,
                   "unidades"=>1,
                   "producto"=>$producto
                ); 
            }
        }
        // hacemos una redireccion 
        header('Location:'.base_url.'carrito/index');
    }
    public function delete(){
        //comprovamos si ingresa por el get el index del array
        if(isset($_GET['index'])){
            //colocamos el index en una variable
            $index=$_GET['index'];
            //eliminamos el array con el indice index en la session carrito
            unset($_SESSION['carrito'][$index]);
        }
         // hacemos una redireccion 
         header('Location:'.base_url.'carrito/index');

    }

    //botones de carrito para las unidades
    public function up(){
        //comprovamos si ingresa por el get el index del array
        if(isset($_GET['index'])){
            //colocamos el index en una variable
            $index=$_GET['index'];
            //aumentamos el array con el indice index en la session carrito
            $_SESSION['carrito'][$index]['unidades']++;
        }
         // hacemos una redireccion 
         header('Location:'.base_url.'carrito/index');

    }

    public function down(){
        //comprovamos si ingresa por el get el index del array
        if(isset($_GET['index'])){
            //colocamos el index en una variable
            $index=$_GET['index'];
            //disminuimos el array con el indice index en la session carrito
            $_SESSION['carrito'][$index]['unidades']--;
            
            //si ese indice su valor de unidades es igual a 0 entonces eliminarme la session
            if($_SESSION['carrito'][$index]['unidades']==0){
                //eliminamos el array con el indice index en la session carrito
                unset($_SESSION['carrito'][$index]);
            }
        }
         // hacemos una redireccion 
         header('Location:'.base_url.'carrito/index');

    }
 


    public function delete_all(){
        unset($_SESSION['carrito']);
           // hacemos una redireccion 
            header('Location:'.base_url.'carrito/index');
    }

}
