<?php
//añadimos el archivo usuario que esta en modelo
require_once 'models/usuario.php';
//en cada uno tenemos que tener una clase 
class usuarioController
{
    //creamos un metodo 
    public function index()
    {
        echo 'Controlador Usuarios, Acción index';
    }
    //creamos un metodo registro
    public function registro()
    {
        //para el registro, vamos a llamar a una vista
        require_once 'views/usuario/registro.php';
    }

    public function save()
    {
        //si ingresa datos por post
        if (isset($_POST)) {
            //ahora vamos a comprobar si existe cada valor por el post y si existe lo guardamos ese valor en una variable y si no existe, a esa variable ledamos el valor de false(VAMOS A UTILIZAR  UNA CONDICIONAL ABREVIADA)
            $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : false;
            $apellidos = isset($_POST["apellidos"]) ? $_POST["apellidos"] : false;
            $email = isset($_POST["email"]) ? $_POST["email"] : false;
            $password = isset($_POST["password"]) ? $_POST["password"] : false;

            //aca verificamos que si nombre es =true y apellidos es = true , etc.
            if ($nombre && $apellidos && $email && $password) {

                //creamos un objeto usuario con la clase Usuario();
                $usuario = new Usuario();
                //ahora aqui utilizamos los set ;
                //los datos que pasan por post como ejemplo: desde el input con el name=nombre entrara como parametroa setNombre y se guardara en el objeto$usuario que cremos en esta funcion
                $usuario->setNombre($nombre);
                $usuario->setApellidos($apellidos);
                $usuario->setEmail($email);
                $usuario->setPassword($password);

                //ahora si mandamos estos datos  dentro de la funcion o metodo save();y para verficar que los datos entraron a la base de datos corectamente hacemos un if
                $save = $usuario->save();


                if ($save) {
                    //ACA MUY IMPORTANTE VEREMOS esta sesion que fue iniciada en index ahi se inicio esa sesion (siempre se tiene que iniciar una sesion) y en esa linea de aqui "$_SESSION['register']='complete'" estamos creando una session y le estamos dando un valor
                    $_SESSION['register'] = 'complete';
                } else {
                    $_SESSION['register'] = 'failed';
                }
            } else {
                $_SESSION['register'] = 'failed';
            }
        } else {
            $_SESSION['register'] = 'failed';
        }
        //redirigimos a la ventana de registro
        header('location:' . base_url . 'usuario/registro');
    }


    //creamos un nuevo metodo para poder crear el login
    public function login()
    {
        //SI NOS LLEGA DATOS POR EL POST 
        if (isset($_POST)) {
            //IDENTIFICAMOS AL USUARIO
            //consulta a la base de datos
            //creamos un objeto usuario en base a la clase Usuario que esta en models usuario.php
            $usuario = new Usuario();
            //ahora ingreamos los datos a nuestro obejto por set que resivimos de post
            $usuario->setEmail($_POST['email']);
            $usuario->setPassword($_POST['password']);
            //ahora llamamos al metodo login  la cual nos devuelve los datos del usuario logeado(nombre,apellido,email,password,etc) y lo colocamos todos esos datos en una varia;
            $identify = $usuario->login();
            //si $identify es true y si $identify es un objeto
            if ($identify && is_object($identify)) {
                //ALGO MUY IMPORTANTE QUE ESTAMOS GUARDANDO NUSTRO OBJETO USUARIO EN UNA SESSION LA CUAL VA TENER TODOS LOS DATOS DE NUESTRO USUARIO
                $_SESSION['identity'] = $identify;

                //aca identificamos que nuestro usuario que esta en $identify tiene el rol de administrador
                if ($identify->rol == 'admin') {
                    //creamos una session para el administrador si es o no es
                    $_SESSION['admin'] = true;
                }
            } else {
                //si el caso no sepueda logear creamos una session la cual tendra una cadena de advertencia
                $_SESSION['error_login'] = 'Identificacion fallida !!';
            }
        }
        //redirigimos a la ventana base_url 
        header('location:' . base_url);
    }

    //metodo para cerrar sesión
    public function logout() {
        //si existe una session
        if (isset($_SESSION['identity'])) {
            //con esta funcion destruimos la session
            unset($_SESSION['identity']);
            
        }
        //si existe una session
        if (isset($_SESSION['admin'])) {
            //con esta funcion destruimos la session
            unset($_SESSION['admin']);
        }
        header('location:' . base_url);
    }
}//fin clase principal
