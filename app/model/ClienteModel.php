<?php
    class ClienteModel extends DB{
        private $CONEX; //pvariable conexion
        public function __construct()
        {
            $this->CONEX = new DB;
        }
    
        public function view()
        {
            try {
               
                $temp = $this->CONEX->connect->prepare('SELECT IDCLIENTE,
                RAZONSOCIAL, CI_NIT, TELEFONO, codtipo AS TIPO 
                FROM cliente C
                ');
                $temp->execute();
                return $temp->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
        
        public function getCliente($id)
        {
            try {
               
                $temp = $this->CONEX->connect->prepare('SELECT IDCLIENTE,
                RAZONSOCIAL, CI_NIT, TELEFONO, CODTIPO AS TIPO, C.CODTIPO 
                FROM cliente C
                WHERE
                IDCLIENTE = :ID');
                $temp->bindParam(':ID',$id);
                $temp->execute();
                return $temp->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
        
        public function getClienteByCi($ci)
        {
            try {
                $temp = $this->CONEX->connect->prepare('SELECT IDCLIENTE AS ID FROM cliente 
                WHERE CI_NIT = :CI');
                $temp->bindParam(':CI',$ci);
                $temp->execute();
                return $temp->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
        public function create($data){
            try{
                $temp = $this->CONEX->connect->prepare('INSERT INTO CLIENTE
                (RAZONSOCIAL, CI_NIT, CODTIPO, TELEFONO) VALUES (:ra,:ni, :tip, :tel)');
                $temp->bindParam(':ra', $data['RAZON']);
                $temp->bindParam(':ni', $data['CINIT']);
                $temp->bindParam(':tip', $data['TIPO']);
                $temp->bindParam(':tel', $data['TELEFONO']);
                $temp->execute();
                return true;
            }catch(PDOException $e){
                echo $e->getMessage();
                return false;
            }
        }
    
        public function update($data){
            try {
                $temp = $this->CONEX->connect->prepare('UPDATE CLIENTE SET
                    RAZONSOCIAL = :ra, CI_NIT = :cinit ,CODTIPO = :tip, TELEFONO = :tel
                    WHERE IDCLIENTE =:id');
                $temp->bindParam(':ra', $data['RAZON']);
                $temp->bindParam(':cinit', $data['CINIT']);
                $temp->bindParam(':tip', $data['TIPO']);
                $temp->bindParam(':tel', $data['TELEFONO']);
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
                $temp = $this->CONEX->connect->prepare('DELETE FROM CLIENTE WHERE IDCLIENTE = :id');
                $temp->bindParam(':id', $id);
                $temp->execute();
                return true;
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            return false;
        }

        public function cantCliente(){
            try{
                $temp = $this->CONEX->connect->prepare(
                    'SELECT COUNT(*) AS CANCLIENTE FROM CLIENTE');
                $temp->execute();
                return $temp->fetch(PDO::FETCH_ASSOC);
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }
        public function verifyCliente($ci){
            try{
                $temp = $this->CONEX->connect->prepare(
                    'SELECT * from CLIENTE where ci_nit = :ci');
                $temp->bindParam(':ci',$ci);
                $temp->execute();
                if ($temp->rowCount() > 0){
                    return false;
                }
                return true;
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }
  
    }

?>
