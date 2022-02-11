<?php
 class Database {
    private $host = "ec2-34-195-69-118.compute-1.amazonaws.com";
    private $database_name = "db8d4lleo0o603"; //nombre de la base de datos
    private $username = "jzvvkuogvmbpjp"; //usuario de la base de datos
    private $password = "c2f9ce3a92395a7e3fd424dc94b1d7643cc3b1cdd1dc90fc26389ccef81255ce"; //clave del usuario
    private $port="5432";
    

    public $conn;

    public function getConnection(){
        $rutaServidor = $this->host;
        $puerto = $this->port;
        $nombreBaseDeDatos=$this->database_name;
        $usuario= $this->username;
        $contrasena =$this->password;

        $this->conn = null;
        try{
            $this->conn = new PDO("pgsql:host=ec2-34-195-69-118.compute-1.amazonaws.com;port=5432;dbname=db8d4lleo0o603;user=jzvvkuogvmbpjp;password=c2f9ce3a92395a7e3fd424dc94b1d7643cc3b1cdd1dc90fc26389ccef81255ce;sslmode=require");
            //$this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Database could not be connected: " . $exception->getMessage();
        }
        return $this->conn;
    }
}  
?>