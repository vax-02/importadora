<?php
class CompraModel extends DB
{
    private $CONEX; //pvariable conexion
    public function __construct()
    {
        $this->CONEX = new DB;
    }

    public function view()
    {
        try {

            $temp = $this->CONEX->connect->prepare('SELECT CODCOMPRA,C.ESTADO, FECHA, 
            CONCAT(P.NOMBRE,\' \',PATERNO,\' \', MATERNO) AS COMPRADOR , 
            PR.NOMBRE AS PROVEEDOR

            FROM COMPRA C, PERSONAL P, PROVEEDOR PR
            WHERE C.CODPERSONAL = P.ID AND
            PR.CODPROV = C.CODPROV ORDER BY FECHA DESC');

            $temp->execute();
            return $temp->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    }

    public function viewMyContracts($id)
    {
        try {

            $temp = $this->CONEX->connect->prepare('SELECT CODCOMPRA,C.ESTADO, FECHA, 
            CONCAT(P.NOMBRE,\' \',PATERNO,\' \', MATERNO) AS COMPRADOR , 
            PR.NOMBRE AS PROVEEDOR

            FROM COMPRA C, PERSONAL P, PROVEEDOR PR
            WHERE C.CODPERSONAL = P.ID AND
            PR.CODPROV = C.CODPROV AND P.CODSUCURSAL = :CODSU');
            $temp->bindParam(':CODSU', $id);
            $temp->execute();
            return $temp->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    }
    public function create($data)
    {
        try {

            $temp = $this->CONEX->connect->prepare('INSERT INTO COMPRA
                (CODPERSONAL,CODPROV) VALUES (:codp, :codpro )');

            $temp->bindParam(':codp', $data['PERSONAL']);
            $temp->bindParam(':codpro', $data['PROVEE']);

            $temp->execute();
            return $this->CONEX->connect->lastInsertId();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return false;
    }


    public function update($data)
    {
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

    public function delete($id)
    {
        try {

            $temp = $this->CONEX->connect->prepare('DELETE FROM DETALLE_COMPRA WHERE CODCOMPRA = :id');
            $temp->bindParam(':id', $id);
            $temp->execute();

            $temp = $this->CONEX->connect->prepare('DELETE FROM COMPRA WHERE CODCOMPRA = :id');
            $temp->bindParam(':id', $id);
            $temp->execute();

            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return false;
    }


    public function create_detalle_compra($data)
    {
        try {

            $temp = $this->CONEX->connect->prepare('INSERT INTO DETALLE_COMPRA
                (CODCOMPRA,NOMBRE, CODCOLOR, CODMARCA, CALIDAD, CANTIDAD ) 
                VALUES (:CODC, :NOM, :CODCOL, :CODMAR, :CALID, :CANTI)');

            $temp->bindParam(':CODC', $data['CODCOMPRA']);
            $temp->bindParam(':NOM', $data['NOMBRE']);
            $temp->bindParam(':CODCOL', $data['CODCOLOR']);
            $temp->bindParam(':CODMAR', $data['CODMARCA']);
            $temp->bindParam(':CALID', $data['CALIDAD']);
            $temp->bindParam(':CANTI', $data['CANTIDAD']);
            $temp->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return false;
    }

    public function detail($id)
    {
        try {

            $temp = $this->CONEX->connect->prepare('SELECT CODCOMPRA,C.ESTADO, FECHA, 
            CONCAT(P.NOMBRE,\' \',PATERNO,\' \', MATERNO) AS COMPRADOR , 
            PR.NOMBRE AS PROVEEDOR

            FROM COMPRA C, PERSONAL P, PROVEEDOR PR
            WHERE C.CODPERSONAL = P.ID AND
            PR.CODPROV = C.CODPROV AND C.CODCOMPRA = :id');
            $temp->bindParam(':id', $id);
            $temp->execute();
            return $temp->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function detail_compra($id)
    {
        try {

            $temp = $this->CONEX->connect->prepare('SELECT CODDCOMPRA, NOMBRE, CODCOLOR, 
            CASE 
               WHEN CALIDAD = 1 THEN \'1RA\'
               WHEN CALIDAD = 2 THEN \'2DA\'
               WHEN CALIDAD = 3 THEN \'3RA\'
               WHEN CALIDAD = 4 THEN \'4TA\'
            END AS CALIDAD,
            CANTIDAD,CALIDAD AS CODCALIDAD, M.CODMARCA AS CODMARCA, 
            M.DESCRIPCION AS MARCA
             FROM DETALLE_COMPRA DC, MARCA M
            WHERE CODCOMPRA = :id AND
            DC.CODMARCA = M.CODMARCA');
            $temp->bindParam(':id', $id);
            $temp->execute();
            return $temp->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    
    

    public function changeStatus($id)
    {
        try {

            $temp = $this->CONEX->connect->prepare('UPDATE COMPRA SET ESTADO = 0 WHERE CODCOMPRA = :ID');
            $temp->bindParam(':ID', $id);
            $temp->execute();
            return $temp->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

}

?>