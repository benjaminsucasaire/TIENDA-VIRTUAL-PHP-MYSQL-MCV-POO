<?php

class Producto{
    //utilizar sus atributos en privado creo que es una forma de mantener mas seguro la aplicacion ya que solo los metodos seran capaz de tener acceso a ellos
    private $id;
    private $categoria_id;
    private $nombre;
    private $descripcion;
    private $precio;
    private $stock;
    private $oferta;
    private $fecha;
    private $imagen;
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

    function getCategoria_id(){
        return $this->categoria_id;
    }

    function getNombre(){
       
        return $this->nombre;
    }
    function getDescripcion(){
       
        return $this->descripcion;
    }
    function getPrecio(){
       
        return $this->precio;
    }
    function getStock(){
       
        return $this->stock;
    }
    function getOferta(){
       
        return $this->oferta;
    }
    function getFecha(){
       
        return $this->fecha;
    }
    function getImagen(){
       
        return $this->imagen;
    }
    //
    function setId($id){
        $this->id=$id;
    }
    function setCategoria_id($categoria_id){
        $this->categoria_id=$categoria_id;
    }
    function setNombre($nombre){
        $this->nombre=$this->db->real_escape_string($nombre);
    }
    function setDescripcion($descripcion){
        $this->descripcion=$this->db->real_escape_string($descripcion);
    }
    function setPrecio($precio){
        $this->precio=$this->db->real_escape_string($precio);
    }
    function setStock($stock){
        $this->stock=$this->db->real_escape_string($stock);
    }
    function setOferta($oferta){
        $this->oferta=$this->db->real_escape_string($oferta);
    }

    function setFecha($fecha){
        $this->fecha=$fecha;
    }
    function setImagen($imagen){
        $this->imagen=$imagen;
    }

     

    //metodo para listar todos los productos
    public function getAll(){
        //hacemos la consulta y lo guardamos en una variable
        $productos=$this->db->query("SELECT * FROM productos order by id desc;");
        //devolvemos un valor en especifico.
        return $productos;
    }
    //metodo para sacar productos de la misma categoria 

        //metodo para listar todos los productos
        public function getAllCategory(){
            //hacemos la consulta y lo guardamos en una variable
            $sql="SELECT p.*,c.nombre as 'catnombre' FROM productos p"
            ." inner join categorias c on p.categoria_id=c.id"
            ." where p.categoria_id={$this->getCategoria_id()}" 
            ." order by id desc";
            // var_dump($sql);
            // die();
            $productos=$this->db->query($sql);
            
            //devolvemos un valor en especifico.
            return $productos;
        }
    //creamos un metodo para que me saque un producto en espesifco por su id
    public function getOne(){
        //hacemos la consulta y lo guardamos en una variable
        $producto=$this->db->query("SELECT * FROM productos where id={$this->getId()};");
        //devolvemos un valor en especifico y lo comvertimos a un objeto completamente usable.
        return $producto->fetch_object();
    }
    //metodo para listar los productos
    public function getRandom($limit){
        //la consulta sql orderna aleatoriamente los productos y limita a que solo pueda sacar $limit de  productos 
        $productos=$this->db->query("SELECT * FROM productos order by rand() limit $limit ");
        return $productos;
    }



       // ahora creamos los metodos para consulta con la base de datos
       public function save(){
        //para insertar datos que entrarar debemos unterpolar

        //los numero no van entrecomillas
       
        $sql="INSERT INTO productos VALUES (NULL,'{$this->getCategoria_id()}','{$this->getNombre()}','{$this->getDescripcion()}',{$this->getPrecio()},{$this->getStock()},NULL,curdate(),'{$this->getImagen()}');";
                //ahora insertamos una consulta 
        $save = $this->db->query($sql);
            
        // echo $sql;
        // echo "</br>";
        // echo $this->db->error;
        // die();


        $result = false; //este es el resultado por defecto
        //si el $save da true (en otras palabras no esta vacio y los datos se llenaron correctamente)
        if($save){
            $result=true;
        }
        return $result;
    }

    //creamos un metodo para eliminar
    public function delete(){
        //creamos mi consulta
        $sql="DELETE from productos where id={$this->id};";

        //ahora ejecutamos la consulta y guardamos el resultado dentro de una variable;
        $delete=$this->db->query($sql);

        $result = false; //este es el resultado por defecto
        //si el $delete da true (en otras palabras no esta vacio)
        if($delete){
            $result=true;
        }
        return $result;

    }

    public function edit(){
        //para insertar datos que entrarar debemos unterpolar

        //los numero no van entrecomillas
       
        $sql="UPDATE  productos  set categoria_id='{$this->getCategoria_id()}', nombre='{$this->getNombre()}', descripcion='{$this->getDescripcion()}', precio={$this->getPrecio()}, stock={$this->getStock()}";

        //hacemos un condicion para comprobar que me llega la imagen
        //ESTO QUIEREN QUEDIR QUE SI NO ESTA VACIO EL getImagen ya que quizas lo pudieron llenar de una nueva imagen
        if($this->getImagen() != null){
            //entonces que me guarde la nueva imagen
            $sql.=",imagen='{$this->getImagen()}'";
        }
        
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