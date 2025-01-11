<?php
class VentaModel extends DB
{
    private $CONEX; //pvariable conexion
    public function __construct()
    {
        $this->CONEX = new DB;
    }

    public function view()
    {
        try {

            $temp = $this->CONEX->connect->prepare('SELECT NOMBRE,
                CASE
                    WHEN CALIDAD = 1 THEN \'1RA\'
                    WHEN CALIDAD = 2 THEN \'2DA\'
                    WHEN CALIDAD = 3 THEN \'3RA\'
                    WHEN CALIDAD = 4 THEN \'4TA\'
                END AS CALIDAD,
                M.DESCRIPCION AS MARCA, T.CODTELA
                 FROM TELA T, MARCA M WHERE
                 T.CODMARCA = M.CODMARCA');
            $temp->execute();
            return $temp->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


    public function getCargo($id)
    {
        try {
            $temp = $this->CONEX->connect->prepare('SELECT * FROM CARGO WHERE CODCARGO = :id');
            $temp->bindParam(':id', $id);
            $temp->execute();
            return $temp->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function delete($id)
    {
        try {
            $temp = $this->CONEX->connect->prepare('DELETE FROM VENTA
                WHERE CODVENTA = :ID');
            $temp->bindParam(':ID', $id);
            $temp->execute();

            $temp = $this->CONEX->connect->prepare('DELETE FROM DETALLE_VENTA
                WHERE CODVENTA = :ID');
            $temp->bindParam(':ID', $id);
            $temp->execute();
            
            return true;
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

    public function create_venta($data)
    {
        try {
            $temp = $this->CONEX->connect->prepare('INSERT INTO VENTA
                (IDPERSONAL, CODCLIENTE, CODSUCURSAL) VALUES (:IDP, :CODCLI, :SUCU)');
            $temp->bindParam(':IDP', $data['IDP']);
            $temp->bindParam(':CODCLI', $data['CODCLI']);
            $temp->bindParam(':SUCU', $data['SUCU']);

            $temp->execute();
            return $this->CONEX->connect->lastInsertId();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return false;
    }

    public function create_detalle_venta($data)
    {
        try {
            $temp = $this->CONEX->connect->prepare('INSERT INTO DETALLE_VENTA
                (CODVENTA, CODTELA, CODCOLOR, PRECIO, CANTIDAD) VALUES 
                (:CODV, :CODT, :CODC, :PRE, :CANT)');

            $temp->bindParam(':CODV', $data['CODV']);
            $temp->bindParam(':CODT', $data['CODT']);
            $temp->bindParam(':CODC', $data['CODC']);
            $temp->bindParam(':PRE', $data['PRE']);
            $temp->bindParam(':CANT', $data['CANT']);

            $temp->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return false;
    }

    public function my_sells($id)
    {
        try {
            $temp = $this->CONEX->connect->prepare('SELECT CODVENTA, FECHA_VENTA, 
            (SELECT CONCAT(NOMBRE,\' \',PATERNO,\' \',MATERNO) FROM PERSONAL
            WHERE ID = V.IDPERSONAL) AS IDPERSONAL, 
            
            (SELECT NOMBRE FROM SUCURSAL WHERE CODSUCURSAL = V.CODSUCURSAL) 
            AS CODSUCURSAL 
            FROM VENTA V 
            WHERE IDPERSONAL = :ID');

            $temp->bindParam(':ID', $id);
            $temp->execute();
            return $temp->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return false;
    }

    public function all_sells()
    {
        try {
            $temp = $this->CONEX->connect->prepare('SELECT CODVENTA, FECHA_VENTA, (SELECT 
            CONCAT(NOMBRE,\' \',PATERNO,\' \',MATERNO) FROM PERSONAL
            WHERE ID = V.IDPERSONAL) AS IDPERSONAL, (SELECT NOMBRE FROM SUCURSAL WHERE CODSUCURSAL =
            V.CODSUCURSAL) AS CODSUCURSAL FROM VENTA V ORDER BY FECHA_VENTA DESC');
            $temp->execute();
            return $temp->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return false;
    }

    public function sells_sucursal($id)
    {
        try {
            $temp = $this->CONEX->connect->prepare('SELECT CODVENTA, FECHA_VENTA, (SELECT 
            CONCAT(NOMBRE,\' \',PATERNO,\' \',MATERNO) FROM PERSONAL
            WHERE ID = V.IDPERSONAL) AS IDPERSONAL, (SELECT NOMBRE FROM SUCURSAL WHERE CODSUCURSAL =
            V.CODSUCURSAL) AS CODSUCURSAL FROM VENTA V WHERE
            CODSUCURSAL = :CODS ');
            $temp->bindParam(':CODS', $id);

            $temp->execute();
            return $temp->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return false;
    }

    public function detail($id)
    {
        try {
            $temp = $this->CONEX->connect->prepare('SELECT CODVENTA, FECHA_VENTA, 
            (SELECT CONCAT(NOMBRE,\' \',PATERNO,\' \',MATERNO) FROM PERSONAL WHERE ID = V.IDPERSONAL) 
            AS IDPERSONAL, V.CODVENTA,
            
            (SELECT NOMBRE FROM SUCURSAL WHERE CODSUCURSAL = V.CODSUCURSAL) AS CODSUCURSAL,

            (SELECT RAZONSOCIAL FROM CLIENTE WHERE IDCLIENTE = V.CODCLIENTE) AS CLIENTE
            FROM VENTA V WHERE
            CODVENTA = :CODV ');
            $temp->bindParam(':CODV', $id);

            $temp->execute();
            return $temp->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return false;
    }
    
    
    public function detailProductsSells($id)
    {
        try {
            $temp = $this->CONEX->connect->prepare('SELECT DV.PRECIO, DV.CANTIDAD, T.NOMBRE, CASE
                WHEN CALIDAD = 1 THEN \'1RA\'
                WHEN CALIDAD = 2 THEN \'2DA\'
                WHEN CALIDAD = 3 THEN \'3RA\'
                WHEN CALIDAD = 4 THEN \'4TA\'
            END AS CALIDAD, CODCOLOR
            FROM DETALLE_VENTA DV, TELA T
            WHERE
            DV.CODVENTA = :CODV AND
            T.CODTELA = DV.CODTELA');
            
            $temp->bindParam(':CODV', $id);

            $temp->execute();
            return $temp->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return false;
    }

    public function totalProducts($id)
    {
        try {
            $temp = $this->CONEX->connect->prepare('SELECT SUM(DV.PRECIO*DV.CANTIDAD)
            AS TOTAL
            FROM DETALLE_VENTA DV, TELA T
            WHERE
            DV.CODVENTA = :CODV AND
            T.CODTELA = DV.CODTELA');
            $temp->bindParam(':CODV', $id);

            $temp->execute();
            return $temp->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return false;
    }
    public function totalMetros($id)
    {
        try {
            $temp = $this->CONEX->connect->prepare('SELECT SUM(DV.CANTIDAD)
            AS METROS
            FROM DETALLE_VENTA DV, TELA T
            WHERE
            DV.CODVENTA = :CODV AND
            T.CODTELA = DV.CODTELA');
            $temp->bindParam(':CODV', $id);

            $temp->execute();
            return $temp->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return false;
    }

    public function detailForContrat($id)
    {
        try {
            $temp = $this->CONEX->connect->prepare('SELECT CODVENTA, FECHA_VENTA, 
            CONCAT(P.NOMBRE,\' \',PATERNO,\' \',MATERNO) AS PERSONAL, P.CELULAR,
            V.CODVENTA,
            
            (SELECT NOMBRE FROM SUCURSAL WHERE CODSUCURSAL = V.CODSUCURSAL) AS CODSUCURSAL,

            RAZONSOCIAL AS CLIENTE, C.TELEFONO, CODTIPO

            FROM VENTA V, PERSONAL P, CLIENTE C WHERE
            CODVENTA = :CODV  AND
            P.ID = V.IDPERSONAL AND
            C.IDCLIENTE = V.CODCLIENTE');
            $temp->bindParam(':CODV', $id);

            $temp->execute();
            return $temp->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return false;
    }
  
    
    public function cantVentas()
    {
        try {
            $temp = $this->CONEX->connect->prepare('SELECT COUNT(*) AS TOTAL FROM VENTA');

            $temp->execute();
            return $temp->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return false;
    }

    
    public function ingresos()
    {
        try {
            $temp = $this->CONEX->connect->prepare('SELECT SUM(PRECIO*CANTIDAD) AS TOTAL FROM DETALLE_VENTA');
            $temp->execute();
            return $temp->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return false;
    }
}

?>