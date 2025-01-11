<?php
    class ProveedorModel extends DB{
        private $CONEX; //pvariable conexion
        public function __construct()
        {
            $this->CONEX = new DB;
        }
    
        public function view()
        {
            try {
               
                $temp = $this->CONEX->connect->prepare('SELECT * FROM PROVEEDOR');
                $temp->execute();
                return $temp->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
        
        public function getProveedor($id){
            try {
               
                $temp = $this->CONEX->connect->prepare('SELECT * FROM PROVEEDOR
                WHERE CODPROV = :ID');
                $temp->bindParam(':ID',$id);
                $temp->execute();
                return $temp->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
        public function create($data){
            try{
                $temp = $this->CONEX->connect->prepare('INSERT INTO PROVEEDOR
                (NOMBRE, DIRECCION, TELEFONO) VALUES (:nom, :direc, :tel)');
                $temp->bindParam(':nom', $data['NOMBRE']);
                $temp->bindParam(':direc', $data['DIREC']);
                $temp->bindParam(':tel', $data['TELEFONO']);
                $temp->execute();
                return true;
            }catch(PDOException $e){
                echo $e->getMessage();
            }
            return false;
        }
    
        public function update($data){
            try {
                $temp = $this->CONEX->connect->prepare('UPDATE PROVEEDOR SET
                NOMBRE = :nom, DIRECCION = :direc, TELEFONO = :tel
                WHERE CODPROV = :ID');
                $temp->bindParam(':nom', $data['NOMBRE']);
                $temp->bindParam(':direc', $data['DIREC']);
                $temp->bindParam(':tel', $data['TELEFONO']);
                $temp->bindParam(':ID', $data['ID']);

                $temp->execute();
                return true;
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            return false;
        }
    
        public function delete($id){
            try {
                $temp = $this->CONEX->connect->prepare('DELETE FROM PROVEEDOR WHERE CODPROV = :id');
                $temp->bindParam(':id', $id);
                $temp->execute();
                return true;
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            return false;
        }

        public function cantProveedor(){
            try{
                $temp = $this->CONEX->connect->prepare(
                    'SELECT COUNT(*) AS CANPROVEEDOR FROM PROVEEDOR');
                $temp->execute();
                return $temp->fetch(PDO::FETCH_ASSOC);
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }
    }

?>