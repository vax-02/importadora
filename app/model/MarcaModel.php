<?php
    class MarcaModel extends DB{
        private $CONEX;
        public function __construct(){
            $this->CONEX = new DB();
        }
        public function view(){
            try{    
                $temp = $this->CONEX->connect->prepare('SELECT * FROM marca');
                $temp->execute();
                return $temp->fetchAll(PDO::FETCH_ASSOC);
            }catch(PDOException $e){
                echo $e->getMessage();
            }
            return '';
        }
        public function getMarca($id){
            try{    
                $temp = $this->CONEX->connect->prepare('SELECT * FROM marca
                where CODMARCA = :ID');
                $temp->bindParam(':ID',$id);
                $temp->execute();
                return $temp->fetch(PDO::FETCH_ASSOC);
            }catch(PDOException $e){
                echo $e->getMessage();
            }
            return '';
        }
        
        public function create($data){
            try{
                $temp = $this->CONEX->connect->prepare('INSERT INTO MARCA
                (DESCRIPCION) VALUES (:descri)');
                $temp->bindParam(':descri', $data['DESCRI']);
                $temp->execute();
                return true;
            }catch(PDOException $e){
                echo $e->getMessage();
            }
            return false;
        }
        public function update($data){
            try {
                $temp = $this->CONEX->connect->prepare('UPDATE MARCA SET
                    DESCRIPCION = :DESCRI WHERE CODMARCA =:id');
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
                $temp = $this->CONEX->connect->prepare('DELETE FROM MARCA WHERE CODMARCA = :id');
                $temp->bindParam(':id', $id);
                $temp->execute();
                return true;
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            return false;
        }
        
        public function cantMarca(){
            try{
                $temp = $this->CONEX->connect->prepare(
                    'SELECT COUNT(*) AS CANMARCA FROM MARCA');
                $temp->execute();
                return $temp->fetch(PDO::FETCH_ASSOC);
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }
        public function getSellMarcas(){
            try {
                $temp = $this->CONEX->connect->prepare('SELECT M.DESCRIPCION,
                    COALESCE( (SELECT SUM(CANTIDAD)
                                FROM DETALLE_VENTA DV, TELA T
                                WHERE DV.CODTELA = T.CODTELA AND T.CODMARCA = M.CODMARCA), 0
                            ) AS METROS
                    FROM MARCA M;');
                $temp->execute();
                return $temp->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
    
        }
    }

?>
