<?php
//aca llamamos al modelo con las consultas de la base de datos
require_once 'models/pedido.php';
//en cada uno tenemos que tener una clase 
class pedidoController{
    //creamos un metodo 
    public function hacer(){
       require_once 'views/pedido/hacer.php';
    }
    public function add(){
        //verificamos que este logueado
        if(isset($_SESSION['identity'])){
            //sacamos el id del usuario para ponerlo en el pedido
            $usuario_id=$_SESSION['identity']->id;
            $provincia=isset($_POST['provincia'])?$_POST['provincia']:false;
            $localidad=isset($_POST['localidad'])?$_POST['localidad']:false;
            $direccion=isset($_POST['direccion'])?$_POST['direccion']:false;
            //llamamos al metodo stats que saca el coste total del carrito
            $stats=Utils::statsCarrito();
            //llamamos al array que tiene el total
            $coste=$stats['total'];
            //Guardar datos en bd;
            //si todos los datos existen
            if($provincia && $localidad && $direccion){
                //creamos un objeto   
                $pedido = new Pedido();
                $pedido->setUsuario_id($usuario_id);
                //ahora le pasamos los datos por set($pro);
                $pedido -> setProvincia($provincia);
                $pedido -> setLocalidad($localidad);
                $pedido -> setDireccion($direccion);
                $pedido -> setCoste($coste);
                //ejecutamos el metodo guardar y guardamos en una variable
                $save=$pedido->save();

                //guardar liena pedido
                $save_linea=$pedido->save_linea();
                if($save && $save_linea){
                    $_SESSION['pedido'] = "complete";
                }else{
                    $_SESSION['pedido'] = "failed";  
                }
            }else{
                $_SESSION['pedido'] = "failed";  
            }
            //si se logro guardar el pedido
            header("Location:".base_url."pedido/confirmado");
        }else{
            //redigir al index
            header("Location:".base_url);
        }

    }

    public function confirmado(){
            if(isset($_SESSION['identity'])){
                //aca le pasamos el usuario y sus atributos a la variable 
               $identity=$_SESSION['identity'];
               $pedido = new Pedido();
               $pedido->setUsuario_id($identity->id); 
               //ejecutamos el metodo para sacar el usuario y su monto toal a pagas
                $pedido=$pedido->getOneByUser();

                //creamos un nuevo objeto en base al pedido
                $pedido_productos=new Pedido();
                //ejecutamos el metodo para listar los pedidos como un array
                //en aqui tenemos todos los productos
                $productos=$pedido_productos->getProductosByPedido($pedido->id);
            }

          
        require_once 'views/pedido/confirmado.php';
    }

    public function mis_pedidos(){
        //utilizamos esta funcion para que solo pueda acceder los usuarios identificados
        Utils::isIdentity();
        //creamos un objeto y llamaos a la session de identity que tiene los valores del usuario
        //sacamos su id de usuario en la tabla pedido
        $usuario_id=$_SESSION['identity']->id;
        //metodo para sacar todos los pedidos
        $pedido=new Pedido();
        //sacamos los pedidos del usuario
        $pedido->setUsuario_id($usuario_id);
        //utilizamos el metodo
        $pedidos=$pedido->getAllByUser();
        require_once 'views/pedido/mis_pedidos.php'; 
    }

    public function detalle(){
       //utilizamos esta funcion para que solo pueda acceder los usuarios identificados
       Utils::isIdentity(); 

       if(isset($_GET['id'])){
           $id=$_GET['id'];
            //sacar el pedido
           $pedido = new Pedido();
           $pedido->setId($id); 
           //ejecutamos el metodo 
            $pedido=$pedido->getOne();

            //sacamos los productos
            $pedido_productos=new Pedido();
            //ejecutamos el metodo para listar los pedidos como un array
            //en aqui tenemos todos los productos
            $productos=$pedido_productos->getProductosByPedido( $id);

        require_once 'views/pedido/detalle.php';
       }else{
        header("Location:".base_url."pedido/mis_pedidos");
       }
       
    }

    //metodo para listar todos los pedidos
    public function  gestion(){
    //utilizamos esta funcion para que solo pueda acceder el admin
    Utils::isAdmin();
    $gestion= true;
    
    //creamos un objeto 
    $pedido=new Pedido();
    //ejecutamos el metodo getAll  y lo guardamos en una varaible
    $pedidos=$pedido->getAll();

    require_once 'views/pedido/mis_pedidos.php';
    }

    public function estado(){
         //utilizamos esta funcion para que solo pueda acceder el admin
        Utils::isAdmin();
       
        if(isset($_POST['pedido_id']) && isset($_POST['estado'])){
            //recoger los datos del formulario
            $id=$_POST['pedido_id'];
            $estado=$_POST['estado'];
            //hacer un  update
            $pedido=new Pedido();
            $pedido->setId($id);
            $pedido->setEstado($estado);
           
            //ejecutamos el metodo
                $pedido->edit();
                header("Location:".base_url."pedido/detalle&id=".$id);
        }else{
            header("Location:".base_url);
        }
    }
}
