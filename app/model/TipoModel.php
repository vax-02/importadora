<?php
    class TipoModel extends DB{
        private $CONEX; //pvariable conexion
        public function __construct()
        {
            $this->CONEX = new DB;
        }
    
        public function view()
        {
            try {
               
                $temp = $this->CONEX->connect->prepare('SELECT * FROM TIPO_CLIENTE');
                $temp->execute();
                return $temp->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
        public function create($data){
            try{
                $temp = $this->CONEX->connect->prepare('INSERT INTO TIPO_CLIENTE
                (NOMBRE) VALUES (:nom)');
                $temp->bindParam(':nom', $data['NOMBRE']);
                $temp->execute();
                return true;
            }catch(PDOException $e){
                echo $e->getMessage();
            }
            return false;
        }
        public function update($data){
            try {
                $temp = $this->CONEX->connect->prepare('UPDATE TIPO_CLIENTE SET
                    NOMBRE = :nom WHERE CODTIPO =:id');
                $temp->bindParam(':nom', $data['NOMBRE']);
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
                $temp = $this->CONEX->connect->prepare('DELETE FROM TIPO_CLIENTE WHERE CODTIPO = :id');
                $temp->bindParam(':id', $id);
                $temp->execute();
                return true;
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            return false;
        }

        public function getTipoException($id){
            try {
                $temp = $this->CONEX->connect->prepare('SELECT * FROM TIPO_CLIENTE WHERE CODTIPO != :id');
                $temp->bindParam(':id', $id);
                $temp->execute();
                return $temp->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }

?>