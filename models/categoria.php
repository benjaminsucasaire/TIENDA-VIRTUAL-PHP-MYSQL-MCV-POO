<?php

class Categoria{
    //utilizar sus atributos en privado creo que es una forma de mantener mas seguro la aplicacion ya que solo los metodos dentro de esta clase seran capaz de tener acceso a ellos
    private $id;
    private $nombre;

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
    function getNombre(){
       
        return $this->nombre;
    }
    //
    function setId($id){
        $this->id = $id;
    }
    function setNombre($nombre){
               //tambien podemos poner la opcion que todo lo que salga del get esta convertido en String ya que en la base de datos son de tipo varchar
               $this->nombre = $this->db->real_escape_string($nombre);
    }
        //este metodo que hemos creado es para que liste a todos las categorias
    public function getAll(){

        //el resultado de la consulta lo guardamos en categorias
                $categorias=$this->db->query('select * from categorias order by id desc;');
                //y retornamos los datos de categorias
                return $categorias;
    }

    public function getOne(){
        //el resultado de la consulta me selecionara una categoria
        $categoria=$this->db->query("select * from categorias where id={$this->getId()}");
        //y retornamos los datos de categoria en formato como objeto
        return $categoria->fetch_object();;
    }

    public function save(){
                //para insertar datos que entrarar debemos unterpolar
                $sql="INSERT INTO categorias VALUES (NULL,'{$this->getNombre()}');";
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