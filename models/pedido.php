<?php

class Pedido{
    //utilizar sus atributos en privado creo que es una forma de mantener mas seguro la aplicacion ya que solo los metodos seran capaz de tener acceso a ellos
    private $id;
    private $usuario_id;
    private $provincia;
    private $localidad;
    private $direccion;
    private $coste;
    private $estado;
    private $fecha;
    private $hora;
    //en cada clase tenemos que tener un atributo db la cual sera la que tenga la conexion con la base de datos
    private $db;
    //ahora creamos un constructor para para la conexion con la base de datos
    public function __construct(){
        //estamos guardando la conexion en la base de datos;
        $this->db=Database::connect();
    }
    function getId(){
        return $this->id;
    }

    function getUsuario_id(){
        return $this->usuario_id;
    }

    function getProvincia(){
        return $this->provincia;
    }

    function getLocalidad(){
        return $this->localidad;
    }
    function getDireccion(){
        return $this->direccion;
    }

    function getCoste(){
        return $this->coste;
    }
    function getEstado(){
        return $this->estado;
    }
    function getFecha(){
        return $this->fecha;
    }
    function getHora(){
        return $this->hora;
    }

    //
    function setId($id){
        $this->id=$id;
    }
    function setUsuario_id($usuario_id){
        $this->usuario_id=$usuario_id;
    }
    function setProvincia($provincia){
        $this->provincia=$this->db->real_escape_string($provincia);
    }
    function setLocalidad($localidad){
        $this->localidad=$this->db->real_escape_string($localidad);
    }
    function setDireccion($direccion){
        $this->direccion=$this->db->real_escape_string($direccion);
    }
    function setCoste($coste){
        $this->coste=$coste;
    }
    function setEstado($estado){
        $this->estado=$estado;
    }
    function setFecha($fecha){
        $this->fecha=$fecha;
    }
    function setHora($hora){
        $this->hora=$hora;
    }


     

    //metodo para listar todos los productos
    public function getAll(){
        //hacemos la consulta y lo guardamos en una variable
        $productos=$this->db->query("SELECT * FROM pedidos order by id desc;");
        //devolvemos un valor en especifico.
        return $productos;
    }

    //creamos un metodo para que me saque un producto en espesifco por su id
    public function getOne(){
        //hacemos la consulta y lo guardamos en una variable
        $producto=$this->db->query("SELECT * FROM pedidos where id={$this->getId()};");
        //devolvemos un valor en especifico y lo comvertimos a un objeto completamente usable.
        return $producto->fetch_object();
    }
        //buscar un pedido por usuario
        public function getOneByUser(){
            //hacemos la consulta y lo guardamos en una variable
            $sql="SELECT id,coste FROM pedidos"
            ." where usuario_id={$this->getUsuario_id()} order by id desc limit 1";
            $pedido=$this->db->query($sql);
            //devolvemos un valor en especifico y lo comvertimos a un objeto completamente usable.
            return $pedido->fetch_object();
        }
                //buscar todo por usuario por usuario
                public function getAllByUser(){
                    //hacemos la consulta y lo guardamos en una variable
                    $sql="SELECT * FROM pedidos"
                    ." where usuario_id={$this->getUsuario_id()} order by id desc";
                    $pedido=$this->db->query($sql);
                    //devolvemos un valor en especifico 
                    return $pedido;
                }




        public function getProductosByPedido($id){
            
            $sql="select pr.*,lp.unidades from productos pr"
            ." inner join lineas_pedidos lp ON pr.id = lp.producto_id"
            ." where lp.pedido_id={$id}";

            $productos=$this->db->query($sql);
            //devolvemos un valor en especifico y lo dejamos como ubn array con los datos de los productos pedidos por el usuario
            return $productos;
        }

       // ahora creamos los metodos para consulta con la base de datos
       public function save(){
        //para insertar datos que entrarar debemos unterpolar

        //los numero no van entrecomillas
       
        $sql="INSERT INTO pedidos VALUES (NULL,{$this->getUsuario_id()},'{$this->getProvincia()}','{$this->getLocalidad()}','{$this->getDireccion()}',{$this->getCoste()},'confirm',curdate(),curtime());";
                //ahora insertamos una consulta 
        $save = $this->db->query($sql);
            

        $result = false; //este es el resultado por defecto
        //si el $save da true (en otras palabras no esta vacio y los datos se llenaron correctamente)
        if($save){
            $result=true;
        }
        return $result;
    }

    public function save_linea(){
        //esto sacaria el id del ultimo insert que hallams realizado
        $sql="select LAST_INSERT_ID() as 'pedido' ";

        $query = $this->db->query($sql);

        //convierte a un objeto
        //ahora le pasamos el dato de pedido
        $pedido_id=$query->fetch_object()->pedido;

        // va recorrer el carrito y va guardar cada elemento en la variable elemento como array
        foreach($_SESSION['carrito'] as $elemento){
            //aca e cada arrray guarda los valores a una variable que contenera los valores de los producto por comprar
            $producto =$elemento['producto'];

            $insert ="insert into lineas_pedidos values(NULL,{$pedido_id},{$producto->id},{$elemento['unidades']})";

            //ejecutamos el query para que guarde los elementos en la base de datos
            $save=$this->db->query($insert);
           
            // var_dump($producto);
            // var_dump($insert);
            // var_dump($save);
            // echo $this->db->error;
            // die();
        }
              $result = false; //este es el resultado por defecto
            //si el $save da true (en otras palabras no esta vacio y los datos se llenaron correctamente)
            if($save){
                $result=true;
            }
            return $result;

    }
    public function edit(){
        //para insertar datos que entrarar debemos unterpolar

        //los numero no van entrecomillas
       
        $sql="UPDATE  pedidos  set estado='{$this->getEstado()}'";
        
        $sql.="where id={$this->getId()};";

                //ahora insertamos una consulta 
        $save = $this->db->query($sql);

        $result = false; //este es el resultado por defecto
        //si el $save da true (en otras palabras no esta vacio y los datos se llenaron correctamente)
        if($save){
            $result=true;
        }
        return $result;
    }
}