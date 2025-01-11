<?php 
    class DB {
        private $user;
        private $pass;
        private $dbname;
        private $host;
        protected $connect;

        public function __construct(){
            $this->user = 'root';
            $this->pass = '';
            $this->dbname = 'dbtelas';
            $this->host = '127.0.0.1';
            try{
                $this->connect = new PDO('mysql:host='.$this->host.';dbname='.$this->dbname,$this->user,$this->pass);
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        } 

        public function close(){
            $this->connect = null;
        }

    }

?>