<?php

class Usuario{
    //utilizar sus atributos en privado creo que es una forma de mantener mas seguro la aplicacion ya que solo los metodos seran capaz de tener acceso a ellos
    private $id;
    private $nombre;
    private $apellidos;
    private $email;
    private $password;
    private $rol;
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
    function getNombre(){
       
        return $this->nombre;
    }
    function getApellidos(){
        return $this->apellidos;
    }
    function getEmail(){
        return $this->email;
    }
    function getPassword(){
         //encriptamos el password ya que tenemos la contraseña en $password//indicamos el tipo de incriptamiento y las veces a encriptar (4 pasadas)
        return password_hash($this->db->real_escape_string($this->password),PASSWORD_BCRYPT,['cost'=>4]);
    }
    function getRol(){
        return $this->rol;
    }
    function getImagen(){
        return $this->imagen;
    }


    function setId($id){
        $this->id = $id;
    }
    function setNombre($nombre){
         //tambien podemos poner la opcion que todo lo que salga del get esta convertido en String ya que en la base de datos son de tipo varchar
        $this->nombre = $this->db->real_escape_string($nombre);
    }
    function setApellidos($apellidos){
        $this->apellidos = $this->db->real_escape_string($apellidos);
    }
    function setEmail($email){
        $this->email = $this->db->real_escape_string($email);
    }
    function setPassword($password){
       
        $this->password=$password;
    }
    function setRol($rol){
        $this->rol = $rol;
    }
    function setImagen($imagen){
        $this->imagen = $imagen;
    }
   // ahora creamos los metodos para consulta con la base de datos
    public function save(){
        //para insertar datos que entrarar debemos unterpolar
        $sql="INSERT INTO usuarios VALUES (NULL,'{$this->getNombre()}','{$this->getApellidos()}','{$this->getEmail()}','{$this->getPassword()}','user',NULL);";
                //ahora insertamos una consulta 
        $save = $this->db->query($sql);
            
        $result = false; //este es el resultado por defecto
        //si el $save da true (en otras palabras no esta vacio y los datos se llenaron correctamente)
        if($save){
            $result=true;
        }
        return $result;
    }
    //creamos un metodo para el login
    public function login(){
        //creo una variable para la respuesta
        $result=false;
            //obetemos los datos ingresados por set y llamamos a las propiedades
        $email=$this->email;
        $password=$this->password;
        
        //comprobar si existe el usuario y la guardamos en una variable
            //creamos la consulta
            $sql="SELECT * from usuarios where email='$email';";

           
        //aca insertamos la query y la guardamos en una variable
        $login=$this->db->query($sql);
        
        //si login es true y $login tiene como numero de filas solo 1
        //Obtiene el número de filas de un resultado
        $count  = mysqli_num_rows($login);
        
        if($login && $count == 1){
            //revuelve los datos a un objeto
            $usuario= $login->fetch_object();
            
            //verificamos la contraseña 
            //password_verify(ingresamos la contraseña que esta entrando desde el imput,aca se coloca el hass osea la contraseña que esta guardado en la base de datos);
            $verify=password_verify($password,$usuario->password);
               
           
            //verificamos que    $verify este en true
                    //si es true entonces mandar los datos del usuario a la varaible $result
            if($verify){
                $result=$usuario;
            }

        }
        //retornamos los datos del usuario si todo sale bien
       return  $result;
    }


}