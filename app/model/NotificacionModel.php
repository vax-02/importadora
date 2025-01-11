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
        public function create($data){
            try{
                $temp = $this->CONEX->connect->prepare('INSERT INTO CARGO
                (DESCRIPCION) VALUES (:descri)');
                $temp->bindParam(':descri', $data['DESCRI']);
                $temp->execute();
                return true;
            }catch(PDOException $e){
                echo $e->getMessage();
            }
            return false;
        }
    
        public function getCargo($id){
            try {
                $temp = $this->CONEX->connect->prepare('SELECT * FROM CARGO WHERE CODCARGO = :id');
                $temp->bindParam(':id', $id);
                $temp->execute();
                return $temp->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
        public function update($data){
            try {
                $temp = $this->CONEX->connect->prepare('UPDATE CARGO SET
                    DESCRIPCION = :DESCRI WHERE id =:id');
                $temp->bindParam(':DESCRI', $data['DESCRI']);
                $temp->bindParam(':id', $data['ID']);
                $temp->execute();
                return true;
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            return false;
        }
    
        public function delete($id){
            try {
                $temp = $this->CONEX->connect->prepare('DELETE FROM CARGO WHERE CODCARGO = :id');
                $temp->bindParam(':id', $id);
                $temp->execute();
                return true;
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            return false;
        }

        
    }

?>