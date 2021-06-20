<?php
//creamos una clase
class Utils{
    //creamos un metodo con un parametro de entrada que sera el nombre de la sesion
    public static function deleteSession($name){
        //comprobamos si la funcion existe
        if(isset($_SESSION[$name])){
            //colocamos un valor nulo a la session que entre
        $_SESSION[$name]=null;
        //unset — Destruye una session especificada
        unset($_SESSION[$name]);  
        }
        //ahora hacemos un return para que retorne algo en este caso terna el nombre de la session
        return  $name;
    }

    public static function isAdmin(){
        //verificamos is no existe la sesion admin
        if(!isset($_SESSION['admin'])){
            header("Location:".base_url);
        }else{
            return true;
        }
    }
    
    public static function isIdentity(){
        //verificamos is no existe una session de usuario y esto permitira que solo el usuario puede entrar a respectivas paginas.
        if(!isset($_SESSION['identity'])){
            header("Location:".base_url);
        }else{
            return true;
        }
    }


    public static function showCategorias(){
        //hacemos un require del modelo para poder utilizar.
        require_once 'models/categoria.php';
              //creamos un objeto en base a la clase de categoria que esta en mi modelo  
              $categoria = new Categoria();
              //llamamos al metodo getAll que creamos en el modelo;
              //y lo guardamos en otro variable la cual tedra las categorias 
              $categorias=$categoria->getAll();  
              //devolbemos categorias
              return $categorias;
        }
    public static function statsCarrito(){
        //valores por defecto si no se tiene ninguna session del carrito
        $stats=array(
            'count'=>0,
            'total'=>0
        );
        if(isset($_SESSION['carrito'])){
            $stats['count']=count($_SESSION['carrito']);

            foreach($_SESSION['carrito'] as $producto){
                $stats['total'] += $producto['precio']*$producto['unidades'];
            }
        }
        return $stats;
    }  
    
    public static function showStatus($status){
        $value='Pendiente';
        if($status=='confirm'){
            $value='Pendiente';
        }elseif($status=='preparation'){
            $value='En Preparacion';
        }
        elseif($status=='ready'){
            $value='Preparado para enviar';  
        }
        elseif($status=='sended'){
            $value='Enviado';
        }
        //que retorne el  valor
        return $value;
    }
}