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
        public function getComprasCliente()
        {
            try {
                date_default_timezone_set('America/La_Paz');
                $fechaActual = date('Y-m-d');
                $temp = $this->CONEX->connect->prepare('SELECT C.IDCLIENTE,
                 UPPER(CONCAT(C.RAZONSOCIAL, " " )) AS NOMBRE, ROUND(
                SUM(
                    CASE 
                        WHEN v.TIPO_VENTA = 0 THEN 
                            dv.PRECIO * dv.CANTIDAD - ((dv.PRECIO * dv.CANTIDAD) * (V.DESCUENTO/100))
    
                        WHEN v.TIPO_VENTA = 1 THEN dv.PRECIO * (dv.CANTIDAD / RT.MROLLOCOMPLETO) - ((dv.CANTIDAD / RT.MROLLOCOMPLETO) * (V.DESCUENTO/100))
                        ELSE 0
                    END),1) as VENTAS
                FROM CLIENTE C
                LEFT JOIN venta v ON C.idcliente = v.codcliente  AND DATE(v.fecha_venta) = :fv
                LEFT JOIN 
                    detalle_venta dv ON v.codventa = dv.codventa
                    left JOIN
                    rollo_tela rt on dv.CODTELA = rt.CODTELA and dv.CODCOLOR = rt.CODCOLOR
                GROUP BY 
                c.IDCLIENTE
                ORDER BY VENTAS DESC LIMIT 5');
    
                $temp->bindParam(':fv',$fechaActual);
                $temp->execute();
                return $temp->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
        
    public function getClientesForDate($date){
        try {
            $temp = $this->CONEX->connect->prepare('SELECT 
            C.IDCLIENTE, UPPER( C.RAZONSOCIAL) AS NOMBRE, ROUND(
            SUM(
                CASE 
                	WHEN v.TIPO_VENTA = 0 THEN 
                		dv.PRECIO * dv.CANTIDAD - ((dv.PRECIO * dv.CANTIDAD) * (V.DESCUENTO/100))

                	WHEN v.TIPO_VENTA = 1 THEN dv.PRECIO * (dv.CANTIDAD / RT.MROLLOCOMPLETO) - ((dv.CANTIDAD / RT.MROLLOCOMPLETO) * (V.DESCUENTO/100))
                	ELSE 0
                END),1) as VENTAS
            FROM CLIENTE C
            LEFT JOIN venta v ON C.IDCLIENTE = v.CODCLIENTE  AND DATE(v.fecha_venta) = :fv
            LEFT JOIN 
                detalle_venta dv ON v.codventa = dv.codventa
                left JOIN
                rollo_tela rt on dv.CODTELA = rt.CODTELA and dv.CODCOLOR = rt.CODCOLOR
            GROUP BY 
                C.IDCLIENTE, NOMBRE
            ORDER BY VENTAS DESC LIMIT 5');

            $temp->bindParam(':fv',$date);
            $temp->execute();
            return $temp->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    
    public function getClienteForMonth($year, $month){
        try {
            $temp = $this->CONEX->connect->prepare('SELECT 
            C.IDCLIENTE, UPPER( C.RAZONSOCIAL) AS NOMBRE, ROUND(
            SUM(
                CASE 
                	WHEN v.TIPO_VENTA = 0 THEN 
                		dv.PRECIO * dv.CANTIDAD - ((dv.PRECIO * dv.CANTIDAD) * (V.DESCUENTO/100))

                	WHEN v.TIPO_VENTA = 1 THEN dv.PRECIO * (dv.CANTIDAD / RT.MROLLOCOMPLETO) - ((dv.CANTIDAD / RT.MROLLOCOMPLETO) * (V.DESCUENTO/100))
                	ELSE 0
                END),1) as VENTAS
            FROM CLIENTE C
            LEFT JOIN venta v ON C.IDCLIENTE = V.CODCLIENTE  AND YEAR(v.fecha_venta) = :yearr AND MONTH(v.fecha_venta) = :monthh
            LEFT JOIN 
                detalle_venta dv ON v.codventa = dv.codventa
                left JOIN
                rollo_tela rt on dv.CODTELA = rt.CODTELA and dv.CODCOLOR = rt.CODCOLOR
            GROUP BY 
                C.IDCLIENTE, NOMBRE
            ORDER BY VENTAS DESC');
            
            $temp->bindParam(':yearr',$year );
            $temp->bindParam(':monthh',$month);
            $temp->execute();

            return( $temp->fetchAll(PDO::FETCH_ASSOC));

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    
    public function getClienteForWeek($inicio, $fin){
        try {
            $inicio = trim($inicio,'"');
            $fin = trim($fin,'"');
        
            $temp = $this->CONEX->connect->prepare('SELECT 
            C.IDCLIENTE, UPPER( C.RAZONSOCIAL) AS NOMBRE, ROUND(
            SUM(
                CASE 
                	WHEN v.TIPO_VENTA = 0 THEN 
                		dv.PRECIO * dv.CANTIDAD - ((dv.PRECIO * dv.CANTIDAD) * (V.DESCUENTO/100))

                	WHEN v.TIPO_VENTA = 1 THEN dv.PRECIO * (dv.CANTIDAD / RT.MROLLOCOMPLETO) - ((dv.CANTIDAD / RT.MROLLOCOMPLETO) * (V.DESCUENTO/100))
                	ELSE 0
                END),1) as VENTAS
            FROM CLIENTE C
            LEFT JOIN venta v ON C.IDCLIENTE = v.CODCLIENTE  AND DATE(v.fecha_venta) >= :inicio AND DATE(v.fecha_venta) <= :fin
            LEFT JOIN 
                detalle_venta dv ON v.codventa = dv.codventa
                left JOIN
                rollo_tela rt on dv.CODTELA = rt.CODTELA and dv.CODCOLOR = rt.CODCOLOR
            GROUP BY 
                C.IDCLIENTE, NOMBRE
            ORDER BY VENTAS DESC LIMIT 5');
            
            $temp->bindParam(':inicio',$inicio );
            $temp->bindParam(':fin',$fin);
            $temp->execute();

            return( $temp->fetchAll(PDO::FETCH_ASSOC));

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    
    public function getInfoClientes(){
        try {
            //$date = trim($date,'"');
            $temp = $this->CONEX->connect->prepare('SELECT * FROM CLIENTE');
            
            $temp->execute();

            return $temp->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    
    public function getComprasClienteForReport($id, $date){
        try {

            $temp = $this->CONEX->connect->prepare('SELECT  CONCAT(P.NOMBRE, " ", P.PATERNO, " ", P.MATERNO) AS NOMBRE,
                TIME( V.FECHA_VENTA) AS HORA_VENTA, V.DESCUENTO, V.TIPO_VENTA, V.CODVENTA, V.CODCLIENTE, (SELECT NOMBRE FROM SUCURSAL S
                WHERE S.CODSUCURSAL = V.CODSUCURSAL) AS SUCURSAL
                FROM VENTA V
                INNER JOIN CLIENTE C ON C.IDCLIENTE = V.CODCLIENTE
                LEFT JOIN PERSONAL P ON V.IDPERSONAL = P.ID
                WHERE V.CODCLIENTE = :CSU
                AND DATE(V.FECHA_VENTA) = :fv;');
            $temp->bindParam(':CSU',$id);
            $temp->bindParam(':fv', $date);

            $temp->execute();

            return $temp->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    
    public function getComprasClientesForWeek($id, $inicio, $fin){
        try {

            $temp = $this->CONEX->connect->prepare('SELECT  CONCAT(P.NOMBRE, " ", P.PATERNO, " ", P.MATERNO) AS NOMBRE,
                TIME( V.FECHA_VENTA) AS HORA_VENTA,V.FECHA_VENTA, V.DESCUENTO, V.TIPO_VENTA, V.CODVENTA, V.CODCLIENTE, (SELECT NOMBRE FROM SUCURSAL S
                WHERE S.CODSUCURSAL = V.CODSUCURSAL) AS SUCURSAL
                FROM VENTA V
                INNER JOIN CLIENTE C ON C.IDCLIENTE = V.CODCLIENTE
                LEFT JOIN PERSONAL P ON V.IDPERSONAL = P.ID
                WHERE V.CODCLIENTE = :CSU
                AND DATE(V.FECHA_VENTA) >= :fi AND
                DATE(V.FECHA_VENTA) <= :ff;');
            $temp->bindParam(':CSU',$id);
            $temp->bindParam(':fi', $inicio);
            $temp->bindParam(':ff', $fin);


            $temp->execute();

            return $temp->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    
    public function getComprasClienteForMonth($id, $year, $month){
        try {

            $temp = $this->CONEX->connect->prepare('SELECT  CONCAT(P.NOMBRE, " ", P.PATERNO, " ", P.MATERNO) AS NOMBRE,
                TIME( V.FECHA_VENTA) AS HORA_VENTA ,V.FECHA_VENTA, V.DESCUENTO, V.TIPO_VENTA, V.CODVENTA, V.CODCLIENTE, (SELECT NOMBRE FROM SUCURSAL S
                WHERE S.CODSUCURSAL = V.CODSUCURSAL) AS SUCURSAL
                FROM VENTA V
                INNER JOIN CLIENTE C ON C.IDCLIENTE = V.CODCLIENTE
                LEFT JOIN PERSONAL P ON V.IDPERSONAL = P.ID
                WHERE V.CODCLIENTE = :CSU
                AND YEAR(V.FECHA_VENTA) = :y AND
                MONTH(V.FECHA_VENTA) = :m;');
            $temp->bindParam(':CSU',$id);
            $temp->bindParam(':y', $year);
            $temp->bindParam(':m', $month);


            $temp->execute();

            return $temp->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
?>
