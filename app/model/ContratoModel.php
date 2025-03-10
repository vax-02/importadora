<?php
class ContratoModel extends DB
{
    private $CONEX; //pvariable conexion
    public function __construct()
    {
        $this->CONEX = new DB;
    }

    public function view()
    {
        try {

            $temp = $this->CONEX->connect->prepare('SELECT CODCONTRATO, SASTRE, (COSTO_TOTAL_TELA+COSTO_SASTRE) AS TOTAL,
            FECHA_INICIO, FECHA_ENTREGA, ESTADO FROM CONTRATO ORDER BY FECHA_INICIO DESC');

            $temp->execute();
            return $temp->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function create($data)
    {
        try {
            $temp = $this->CONEX->connect->prepare('INSERT INTO CONTRATO
                (`CODCLIENTE`, `CODEMPLEADO`, `SASTRE`, `CODTELA`,CODCOLOR,FRUNCIDO, `METROS_TELA`,
                `COSTO_TOTAL_TELA`, `COSTO_SASTRE`, `DESCRIPCION`, `FECHA_ENTREGA`)
                VALUES (:CODCLI , :CODEMP, :SAS, :CODTE,:CODCOL ,:FRUN,:M_TELA, 
                :COS_TELA , :COS_SAS , :DESCRI, :FECHA_E)');


            $temp->bindParam(':CODCLI', $data['CLIENTE']);
            $temp->bindParam(':CODEMP', $data['PERSONAL']);
            $temp->bindParam(':SAS', $data['SASTRE']);
            $temp->bindParam(':CODTE', $data['TELA']);
            $temp->bindParam(':CODCOL', $data['C_COLOR']);
            $temp->bindParam(':FRUN', $data['FRUNCIDO']);
            $temp->bindParam(':M_TELA', $data['M_TELA']);
            $temp->bindParam(':COS_TELA', $data['C_TELA']);
            $temp->bindParam(':COS_SAS', $data['C_SASTRE']);
            $temp->bindParam(':DESCRI', $data['DESCRI']);
            $temp->bindParam(':FECHA_E', $data['FECHA_ENTREGA']);

            $temp->execute();
            return $this->CONEX->connect->lastInsertId();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return false;
    }

    public function create_detalle($data)
    {
        try {
            $temp = $this->CONEX->connect->prepare('INSERT INTO DETALLE_CONTRATO
                (`CODCONTRATO`, `ALTO`, `ANCHO`, `CANTIDAD`)
                VALUES (:CODCONTRA , :AL, :AN, :CAN)');

            $temp->bindParam(':CODCONTRA', $data['CODCONTRATO']);
            $temp->bindParam(':AL', $data['ALTO']);
            $temp->bindParam(':AN', $data['ANCHO']);
            $temp->bindParam(':CAN', $data['CANT']);

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
            $temp = $this->CONEX->connect->prepare('DELETE FROM DETALLE_CONTRATO WHERE CODCONTRATO = :id');
            $temp->bindParam(':id', $id);
            $temp->execute();
            
            $temp = $this->CONEX->connect->prepare('DELETE FROM CONTRATO WHERE CODCONTRATO = :id');
            $temp->bindParam(':id', $id);
            $temp->execute();


            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return false;
    }

    public function setEstado($id)
    {
        try {
            $temp = $this->CONEX->connect->prepare('UPDATE CONTRATO 
            SET ESTADO = CASE
            WHEN ESTADO = 1 THEN 0
            WHEN ESTADO = 0 THEN 1
            END
            WHERE CODCONTRATO = :id');
            $temp->bindParam(':id', $id);
            $temp->execute();

            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return false;
    }
    public function contrato($id)
    {
        try {

            $temp = $this->CONEX->connect->prepare('SELECT 
            CON.CODCONTRATO,SASTRE,CON.FRUNCIDO,C_INSTALACION, C_TUBOS, CLI.RAZONSOCIAL, CLI.TELEFONO, CLI.CODTIPO,
            CONCAT(P.NOMBRE, \' \', PATERNO, \' \',MATERNO) AS EMPLEADO, P.CELULAR,
            T.NOMBRE, CON.ESTADO,
            CASE
                WHEN T.CALIDAD = 1 THEN \'1RA\'
                WHEN T.CALIDAD = 2 THEN \'2DA\'
                WHEN T.CALIDAD = 3 THEN \'3RA\'
                WHEN T.CALIDAD = 4 THEN \'4TA\'
            END AS CALIDAD, FECHA_INICIO, FECHA_ENTREGA, CON.DESCRIPCION, COSTO_SASTRE, METROS_TELA,COSTO_TOTAL_TELA,
            M.DESCRIPCION AS MARCA, (COSTO_TOTAL_TELA + COSTO_SASTRE) AS TOTAL 
             FROM CONTRATO CON, CLIENTE CLI, PERSONAL P, TELA T, MARCA M
             WHERE
             CON.CODEMPLEADO = P.ID AND
             CON.CODCLIENTE = CLI.IDCLIENTE AND
             CON.CODTELA = T.CODTELA AND
             T.CODMARCA = M.CODMARCA AND CON.CODCONTRATO = :ID');
            $temp->bindParam(':ID',$id);

            $temp->execute();
            return $temp->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    
    
    public function get_detalle_contrato($id)
    {
        try {

            $temp = $this->CONEX->connect->prepare('SELECT * FROM DETALLE_CONTRATO 
            WHERE CODCONTRATO = :ID');
            $temp->bindParam(':ID',$id);

            $temp->execute();
            return $temp->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function instalacion($id,$costo,$canti){
        try {
            $temp = $this->CONEX->connect->prepare('UPDATE FROM CONTRATO SET C_INSTALACION = :CI, C_TUBOS = :CT WHERE CODCONTRATO = :ID');
            $temp->bindParam(':ID',$id);
            $temp->bindParam(':CI',$costo);
            $temp->bindParam(':CT',$canti);

            $temp->execute();
            return $temp->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}

?>