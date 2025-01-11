<?php
class SucursalModel extends DB
{
    private $CONEX; //pvariable conexion
    public function __construct()
    {
        $this->CONEX = new DB;
    }

    public function view()
    {
        try {

            $temp = $this->CONEX->connect->prepare('SELECT 
                S.CODSUCURSAL, S.NOMBRE, DESCRIPCION, DIRECCION, TELEFONO, 
                CONCAT(P.NOMBRE,\' \',PATERNO,\' \',MATERNO) AS ENCARGADO
                FROM sucursal S, personal p
                WHERE P.ID = ENCARGADO ');
            $temp->execute();
            return $temp->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function getSucursal($id)
    {
        try {

            $temp = $this->CONEX->connect->prepare('SELECT 
                S.CODSUCURSAL, S.NOMBRE, DESCRIPCION, DIRECCION, TELEFONO, 
                P.ID, CONCAT(P.NOMBRE,\' \',PATERNO,\' \',MATERNO) AS ENCARGADO
                FROM sucursal S, personal p
                WHERE P.ID = ENCARGADO AND
                S.CODSUCURSAL = :ID');
            $temp->bindParam(':ID', $id);
            $temp->execute();
            return $temp->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function create($data)
    {
        try {
            $temp = $this->CONEX->connect->prepare('INSERT INTO SUCURSAL
                (NOMBRE,DESCRIPCION,DIRECCION,TELEFONO,ENCARGADO) VALUES (:nom,
                :descri, :dir, :tel, :encar)');
            $temp->bindParam(':nom', $data['NOMBRE']);
            $temp->bindParam(':dir', $data['DIRECCION']);
            $temp->bindParam(':descri', $data['DESCRIPCION']);
            $temp->bindParam(':tel', $data['TELEFONO']);
            $temp->bindParam(':encar', $data['ENCARGADO']);
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
            $temp = $this->CONEX->connect->prepare('UPDATE SUCURSAL SET
                NOMBRE = :nom ,DESCRIPCION = :descri,
                DIRECCION = :dir, TELEFONO = :tel , ENCARGADO =:encar
                WHERE CODSUCURSAL = :ID');
            $temp->bindParam(':ID', $data['ID']);
            $temp->bindParam(':nom', $data['NOMBRE']);
            $temp->bindParam(':dir', $data['DIRECCION']);
            $temp->bindParam(':descri', $data['DESCRIPCION']);
            $temp->bindParam(':tel', $data['TELEFONO']);
            $temp->bindParam(':encar', $data['ENCARGADO']);

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
            $temp = $this->CONEX->connect->prepare('DELETE FROM SUCURSAL
                WHERE CODSUCURSAL = :id');
            $temp->bindParam(':id', $id);
            $temp->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return false;
    }

    public function getSucursalException($id)
    {
        try {

            $temp = $this->CONEX->connect->prepare('SELECT 
                CODSUCURSAL, NOMBRE
                FROM SUCURSAL
                WHERE CODSUCURSAL != :ID ');
            $temp->bindParam(':ID', $id);
            $temp->execute();
            return $temp->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function detail($id)
    {
        try {

            $temp = $this->CONEX->connect->prepare('SELECT 
                S.NOMBRE, S.DIRECCION, S.TELEFONO,S.DESCRIPCION,
                CONCAT(P.NOMBRE,\' \',PATERNO,\' \',MATERNO) AS ENCARGADO 
                FROM SUCURSAL S, PERSONAL P
                WHERE S.CODSUCURSAL = :ID AND
                ENCARGADO = P.ID');
            $temp->bindParam(':ID', $id);
            $temp->execute();
            return $temp->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function personalSucursal($id)
    {
        try {
            $temp = $this->CONEX->connect->prepare('SELECT
                CONCAT(NOMBRE,\' \',PATERNO,\' \',MATERNO) AS EMPLEADO, CELULAR, 
                CASE 
                    WHEN ESTADO = 1 THEN \'ACTIVO\'
                    WHEN ESTADO = 2 THEN \'RETIRADO\'
                END AS ESTADO
                FROM PERSONAL
                WHERE CODSUCURSAL = :ID');
            $temp->bindParam(':ID', $id);
            $temp->execute();
            return $temp->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getIdEncargado($id)
    {
        try {

            $temp = $this->CONEX->connect->prepare('SELECT 
                ID FROM personal P, SUCURSAL S 
                WHERE S.CODSUCURSAL = :ID AND
                ID = S.ENCARGADO');
            $temp->bindParam(':ID', $id);
            $temp->execute();
            return $temp->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function encargadosSucursal($id)
    {
        try {
            $temp = $this->CONEX->connect->prepare(
                'SELECT CONCAT(P.NOMBRE,\' \',PATERNO,\' \',MATERNO) AS NOMBRE,
                    CELULAR, INICIO,FIN 
                    FROM ENCARGADO_SUCURSAL ES, PERSONAL P
                    WHERE ES.IDPERSONAL = P.ID AND
                    ES.CODSUCURSAL = :ID
                    ORDER BY INICIO DESC'
            );
            $temp->bindParam(':ID', $id);
            $temp->execute();
            return $temp->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    }
    public function cantSucursal()
    {
        try {
            $temp = $this->CONEX->connect->prepare(
                'SELECT COUNT(*) AS CANSUCURSAL FROM SUCURSAL'
            );
            $temp->execute();
            return $temp->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getSucursalOfSupervisor($id)
    {
        try {
            $temp = $this->CONEX->connect->prepare(
                'SELECT * FROM SUCURSAL WHERE ENCARGADO = :ID'
            );
            $temp->bindParam(':ID',$id);
            $temp->execute();
            return $temp->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function getSucursales()
    {
        try {
            date_default_timezone_set('America/La_Paz');
            $fechaActual = date('Y-m-d');
            $temp = $this->CONEX->connect->prepare('SELECT 
            S.CODSUCURSAL, S.NOMBRE, COALESCE(SUM(dv.precio * dv.cantidad), 0) AS VENTAS
            FROM sucursal S
            LEFT JOIN venta v ON S.codsucursal = v.codsucursal AND DATE(v.fecha_venta) = :fv
            LEFT JOIN 
                detalle_venta dv ON v.codventa = dv.codventa
            GROUP BY 
                S.CODSUCURSAL, S.NOMBRE
            ORDER BY 
            S.CODSUCURSAL;');
            $temp->bindParam(':fv',$fechaActual);
            $temp->execute();
            return $temp->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
   
    public function getSucursalesForDate($date){
        try {
            $date = trim($date,'"');
            $temp = $this->CONEX->connect->prepare('SELECT 
            S.CODSUCURSAL, S.NOMBRE, SUM(dv.precio * dv.cantidad) AS VENTAS
            FROM sucursal S
            JOIN venta v ON v.codsucursal = S.codsucursal
            JOIN detalle_venta dv ON v.codventa = dv.codventa
            WHERE DATE(v.fecha_venta) = :fv
            GROUP BY S.CODSUCURSAL');
            
            $temp->bindParam(':fv',$date );
            $temp->execute();

            return $temp->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getSucursalForMonth($year, $month){
        try {
            //$date = trim($date,'"');
            $temp = $this->CONEX->connect->prepare('SELECT 
            S.CODSUCURSAL, S.NOMBRE, SUM(dv.precio * dv.cantidad) AS VENTAS
            FROM sucursal S
            JOIN venta v ON v.codsucursal = S.codsucursal
            JOIN detalle_venta dv ON v.codventa = dv.codventa
            WHERE year(v.fecha_venta) = :yearr and
            month(v.fecha_venta) = :monthh GROUP BY 
            S.CODSUCURSAL');
            
            $temp->bindParam(':yearr',$year );
            $temp->bindParam(':monthh',$month);
            $temp->execute();

            return( $temp->fetchAll(PDO::FETCH_ASSOC));

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getSucursalForWeek($inicio, $fin){
        try {
            $inicio = trim($inicio,'"');
            $fin = trim($fin,'"');
        
            $temp = $this->CONEX->connect->prepare('SELECT 
            S.CODSUCURSAL, S.NOMBRE, SUM(dv.precio * dv.cantidad) AS VENTAS
            FROM sucursal S
            JOIN venta v ON v.codsucursal = S.codsucursal
            JOIN detalle_venta dv ON v.codventa = dv.codventa
            WHERE DATE(v.fecha_venta) >= :inicio and
            DATE(v.fecha_venta) <= :fin GROUP BY 
            S.CODSUCURSAL');
            
            $temp->bindParam(':inicio',$inicio );
            $temp->bindParam(':fin',$fin);
            $temp->execute();

            return( $temp->fetchAll(PDO::FETCH_ASSOC));

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function getInfoSucursal(){
        try {
            //$date = trim($date,'"');
            $temp = $this->CONEX->connect->prepare('SELECT 
            S.CODSUCURSAL,S.NOMBRE, S.TELEFONO, CONCAT(P.NOMBRE,\' \',PATERNO, MATERNO) AS ENCARGADO
            FROM SUCURSAL S, PERSONAL P
            WHERE P.ID = S.ENCARGADO
            ');
            
            $temp->execute();

            return $temp->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function getVentaEmpleados($id, $date){
        try {
            $temp = $this->CONEX->connect->prepare('SELECT  CONCAT(P.NOMBRE,\' \',PATERNO, \' \',MATERNO) AS NOMBRE,
            DV.CANTIDAD, DV.PRECIO AS PRECIOV,T.PRECIO_REAL AS PRECIOR, 
            T.NOMBRE AS TELA, M.DESCRIPCION AS MARCA, (DV.PRECIO  - RT.PRECIO_METRO_REAL) AS GANANCIA
            FROM SUCURSAL S, PERSONAL P, VENTA V, DETALLE_VENTA DV, TELA T, MARCA M , ROLLO_TELA RT
            WHERE P.CODSUCURSAL = S.CODSUCURSAL AND
            P.ID = V.IDPERSONAL AND
            T.CODTELA = DV.CODTELA AND
            M.CODMARCA = T.CODMARCA AND
            DV.CODVENTA = V.CODVENTA AND
            RT.CODTELA = DV.CODTELA AND
            V.CODSUCURSAL = :CSU AND
            DATE(V.FECHA_VENTA) = :fv');
            $temp->bindParam(':CSU',$id);
            $temp->bindParam(':fv',$date);

            $temp->execute();

            return $temp->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function getVentaAllEmpleados($id){
        try {
            $temp = $this->CONEX->connect->prepare('SELECT  CONCAT(P.NOMBRE,\' \',PATERNO, \' \',MATERNO) AS NOMBRE,
            DV.CANTIDAD, DV.PRECIO AS PRECIOV,T.PRECIO_REAL AS PRECIOR, V.FECHA_VENTA AS FV,
            T.NOMBRE AS TELA, M.DESCRIPCION AS MARCA, (DV.PRECIO  - RT.PRECIO_METRO_REAL) AS GANANCIA
            FROM SUCURSAL S, PERSONAL P, VENTA V, DETALLE_VENTA DV, TELA T, MARCA M , ROLLO_TELA RT
            WHERE P.CODSUCURSAL = S.CODSUCURSAL AND
            P.ID = V.IDPERSONAL AND
            T.CODTELA = DV.CODTELA AND
            M.CODMARCA = T.CODMARCA AND
            DV.CODVENTA = V.CODVENTA AND
            RT.CODTELA = DV.CODTELA AND
            V.CODSUCURSAL = :CSU ORDER BY V.FECHA_VENTA DESC');
            $temp->bindParam(':CSU',$id);

            $temp->execute();

            return $temp->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function getVentasForEmpleadoInDate($date){
        try {
            $temp = $this->CONEX->connect->prepare('SELECT  
            DV.CANTIDAD, DV.PRECIO AS PRECIOV,
            T.NOMBRE AS TELA, M.DESCRIPCION AS MARCA
            from PERSONAL P, VENTA V, DETALLE_VENTA DV, TELA T, MARCA M
            WHERE P.ID = V.IDPERSONAL AND
            T.CODTELA = DV.CODTELA AND
            M.CODMARCA = T.CODMARCA AND
            DV.CODVENTA = V.CODVENTA AND
            DATE(V.FECHA_VENTA) = :fv');
            $temp->bindParam(':fv',$date);
            
            $temp->execute();

            return $temp->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}

?>
