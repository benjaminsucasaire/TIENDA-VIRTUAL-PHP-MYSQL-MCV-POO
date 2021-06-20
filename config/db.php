<?php
//creamos una clase 
class Database{
    //creamos un metodo estatico o tambien conocido como una funcion
    public static function connect(){
        $db = new mysqli('localhost','root','','tienda_master');
        //ejecutamos una consulta que va permitir que los resultados que saque de la base de datos sean en castellano totalmente(tildes,eñe,etc) 
        $db->query("SET NAMES 'utf8'");
        return $db;
    }
}