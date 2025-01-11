<?php
    class ProductoModel extends DB{
        private $CONEX; //pvariable conexion
        public function __construct()
        {
            $this->CONEX = new DB;
        }
    
        public function view()
        {
            try {
               
                $temp = $this->CONEX->connect->prepare('SELECT * FROM PRODUCTOS');
                $temp->execute();
                return $temp->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
        public function getProducto($id)
        {
            try {
               
                $temp = $this->CONEX->connect->prepare('SELECT * FROM PRODUCTOS WHERE ID = :id');
                $temp->bindParam(':id',$id);
                $temp->execute();
                return $temp->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function check($name)
        {
            try {
                $temp = $this->CONEX->connect->prepare('SELECT * FROM PRODUCTOS WHERE
                LOWER(nombre) = LOWER(:nom)');
                $temp->bindParam(':nom',$name);
                $temp->execute();

                if( $temp->rowCount() > 0 ){
                    return false;
                }
                return true;
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
        
        public function create($name){
            try{
                $temp = $this->CONEX->connect->prepare('INSERT INTO PRODUCTOS
                (NOMBRE) VALUES (:NOM)');
                $temp->bindParam(':NOM', $name);
                $temp->execute();
                return true;
            }catch(PDOException $e){
                echo $e->getMessage();
            }
            return false;
        }
    
        
        public function update($data){
            try {
                
                $temp = $this->CONEX->connect->prepare('SELECT * FROM productos WHERE ID = :id');
                $temp->bindParam(':id', $data['ID']);
                $temp->execute();
                $tela = $temp->fetch(PDO::FETCH_ASSOC);

                $temp = $this->CONEX->connect->prepare('UPDATE TELA SET NOMBRE = :NOM WHERE NOMBRE = :NOMORI');
                $temp->bindParam(':NOMORI', $tela['NOMBRE']);
                $temp->bindParam(':NOM', $data['NOMBRE']);
                $temp->execute();



                $temp = $this->CONEX->connect->prepare('UPDATE PRODUCTOS SET
                    NOMBRE = :NOM WHERE id =:id');
                $temp->bindParam(':NOM', $data['NOMBRE']);
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
                $temp = $this->CONEX->connect->prepare('DELETE FROM PRODUCTOS WHERE id = :id');
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