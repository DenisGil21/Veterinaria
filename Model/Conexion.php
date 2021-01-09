<?php  namespace Model; 

class Conexion {
    
    private $datos = array(
        'host' => "localhost",
        'user' => "root",
        'pass' => "",
        'db' => "veterinaria",
    );
    
    private $con;

    public function __construct() {
        $this->con = new \mysqli($this->datos['host'], $this->datos['user'], $this->datos['pass'], $this->datos['db']);
        $this->con->set_charset("utf8");
        
        if ($this->con->error){
            echo 'Error de conexion '.$this->con->error;
            exit();
        }
    }

    public function check($status){
        $st;
        if ($this->con->error){
            $st = false;
        }else{
            $st = true;
        }

        if($status == false){
            return false;
        }else{
            return $st;
        }
    }

    public function send($status){
        if ($status) {
            $this->con->commit();
            return true;
        } else {
            $this->con->rollback();
            return false;
        }
    }

    public function autocommit($status){
        $this->con->autocommit($status);
    }

    public function query($sql) {
        return $this->con->query($sql);
    }

    public function lastId() {
        return $this->con->insert_id;
    }

    public function getCon(){
        return $this->con;
    }

    public function __destruct() {
        $this->con->close();
    }
}
