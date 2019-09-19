<?php
class Conexion extends PDO {
    
      private $db ;
      private $user;
      private $pass;
      private $type;
      private $host;
      private $cadena;
    
    public function __construct($n) {

           switch ($n) {
            case 1:
              
              $this->db = 'bdcsjla';
              $this->user = 'postgres';
              $this->type = 'pgsql';
              $this->pass = '123';              
              $this->host = 'localhost';
              $this->cadena = $this->type . ':host=' . $this->host . ';dbname=' . $this->db;
               break;
            case 2:
              
              $this->dsn = 'sij_expedientes';
              $this->user = 'dba';
              $this->pass = 'sql';
              $this->type = 'odbc';              
              $this->cadena = $this->type.':DSN='.$this->dsn.';Uid='.$this->user.';Pwd='.$this->pass;             
              break;
            case 3:
              
              $this->db = 'sapj';
              $this->user = 'root';
              $this->type = 'mysql';
              $this->pass = '';              
              $this->host = 'localhost';
              $this->cadena = $this->type . ':host=' . $this->host . ';dbname=' . $this->db;             
              break;       
           }
        try {
            parent::__construct($this->cadena, $this->user, $this->pass);
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Ha surgido un error y no se puede conectar a la base de datos. Detalle: ' . $e->getMessage();
            exit;
        }
    }
}
