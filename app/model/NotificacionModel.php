<?php
    class NotificacionModel extends DB{
        private $CONEX; //pvariable conexion
        public function __construct()
        {
            $this->CONEX = new DB;
        }
    
        public function getSucursalName($id)
        {
            try {
               
                $temp = $this->CONEX->connect->prepare('SELECT NOMBRE FROM SUCURSAL
                WHERE CODSUCURSAL = :CODSU');
                $temp->bindParam(':CODSU',$id);
                $temp->execute();
                return $temp->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
        
        
        
    }

?>