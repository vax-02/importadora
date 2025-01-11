<?php
    class EncargadoSucursalModel extends DB{
        private $CONEX; //pvariable conexion
        public function __construct()
        {
            $this->CONEX = new DB;
        }
    
        public function view()
        {
            try {
               
                $temp = $this->CONEX->connect->prepare('SELECT * FROM cargo');
                $temp->execute();
                return $temp->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
        public function create($data){
            try{
                $temp = $this->CONEX->connect->prepare('INSERT INTO ENCARGADO_SUCURSAL
                (CODSUCURSAL, IDPERSONAL) VALUES (:CODSU, :IDPE)');
                $temp->bindParam(':CODSU', $data['CODSUCURSAL']);
                $temp->bindParam(':IDPE', $data['IDPERSONAL']);
                $temp->execute();
                return true;
            }catch(PDOException $e){
                echo $e->getMessage();
            }
            return false;
        }
    
        public function buscarCargo($data){
            try {
                $temp = $this->CONEX->connect->prepare('SELECT COD FROM
                ENCARGADO_SUCURSAL 
                WHERE CODSUCURSAL = :CODSU AND 
                IDPERSONAL = :IDPE AND
                FIN IS NULL');
                $temp->bindParam(':CODSU',$data['CODSU']);
                $temp->bindParam(':IDPE',$data['IDPE']);
                $temp->execute();
                return $temp->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            return 0;
        }
    
        public function update($data){
            try {
                $temp = $this->CONEX->connect->prepare('UPDATE ENCARGADO_SUCURSAL
                SET FIN = :fin
                WHERE COD = :cod');
                $temp->bindParam(':fin',$data['FIN']);
                $temp->bindParam(':cod',$data['COD']);
                $temp->execute();
                
                return true;
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            return false;
        }

        
    }

?>