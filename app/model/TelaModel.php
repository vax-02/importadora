<?php
class TelaModel extends DB
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
                T.CODTELA, T.NOMBRE,
                CASE 
                    WHEN CALIDAD = 1 THEN \'1RA\'
                    WHEN CALIDAD = 2 THEN \'2DA\'
                    WHEN CALIDAD = 3 THEN \'3RA\'
                    WHEN CALIDAD = 4 THEN \'4TA\'
                END AS CALIDAD,
                (
                    SELECT SUM(NUMROLLOS) 
                    FROM ROLLO_TELA
                    WHERE CODTELA = T.CODTELA
                ) AS ROLLOS,
                M.DESCRIPCION AS MARCA, METROS, PRECIO, PRECIO_REAL
                
                FROM Tela T, MARCA M
                WHERE T.CODMARCA = M.CODMARCA
                ');
            $temp->execute();
            return $temp->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function viewName()
    {
        try {

            $temp = $this->CONEX->connect->prepare('SELECT
                NOMBRE FROM Tela');
            $temp->execute();
            return $temp->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function delete($id)
    {
        try {
            $temp = $this->CONEX->connect->prepare('DELETE FROM TELA
            WHERE CODTELA = :CODT');
            $temp->bindParam(':CODT', $id);
            $temp->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return false;
    }
    public function viewMySucursal($id)
    {
        try {

            $temp = $this->CONEX->connect->prepare('SELECT
                T.CODTELA, T.NOMBRE,
                CASE 
                    WHEN CALIDAD = 1 THEN \'1RA\'
                    WHEN CALIDAD = 2 THEN \'2DA\'
                    WHEN CALIDAD = 3 THEN \'3RA\'
                    WHEN CALIDAD = 4 THEN \'4TA\'
                END AS CALIDAD,
                (
                    SELECT SUM(NUMROLLOS) 
                    FROM ROLLO_TELA
                    WHERE CODTELA = T.CODTELA
                ) AS ROLLOS,
                M.DESCRIPCION AS MARCA, METROS, PRECIO, PRECIO_REAL
                
                FROM Tela T, MARCA M
                WHERE T.CODMARCA = M.CODMARCA and 
                CODSUCURSAL = :CODS');
            $temp->bindParam(':CODS',$id);
            $temp->execute();
            return $temp->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function create($data)
    {
        try {
            $temp = $this->CONEX->connect->prepare('INSERT INTO TELA
                (NOMBRE, CALIDAD, CODMARCA, METROS, PRECIO, PRECIO_REAL, CODSUCURSAL)
                VALUES (:nom, :cali, :codma, :metr, :prec, :precr, :codsu)');

            $temp->bindParam(':nom', $data['NOMBRE']);
            $temp->bindParam(':cali', $data['CALIDAD']);
            $temp->bindParam(':codma', $data['MARCA']);
            $temp->bindParam(':metr', $data['METROS']);
            $temp->bindParam(':prec', $data['PRECIOMETRO']);
            $temp->bindParam(':precr', $data['PRECIOMETROREAL']);
            $temp->bindParam(':codsu', $data['SUCURSAL']);

            $temp->execute();
            
            $codtela = $this->CONEX->connect->lastInsertId();

            $temp = $this->CONEX->connect->prepare('INSERT INTO ROLLO_TELA
                (CODTELA, CODCOLOR, NUMROLLOS, METROLLO, PRECIOROLLO, PRECIOROLLOREAL, MROLLOCOMPLETO) 
                VALUES (:codtela, :codcolor, :numrollos, :metrol, :prerl, :prerlreal, :mrollocom)');
            $temp->bindParam(':codtela', $codtela);
            $temp->bindParam(':metrol', $data['METROS']);
            $temp->bindParam(':prerl', $data['PROLLO']);
            $temp->bindParam(':prerlreal', $data['PROLLOREAL']);
            $temp->bindParam(':mrollocom', $data['METROS']);


            for ($i = 0; $i < $data['TCOLORES']; $i++) {
                $color = $data['color' . $i];
                $cant = $data['cantidad' . $i];
                $temp->bindParam(':codcolor', $color);
                $temp->bindParam(':numrollos', $cant);
                $temp->execute();

            }

            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return false;
    }

    public function createDeStock($data)
    {
        try {
            $temp = $this->CONEX->connect->prepare('INSERT INTO TELA
                (NOMBRE, CALIDAD, CODMARCA, METROS, PRECIO, PRECIO_REAL, CODSUCURSAL)
                VALUES (:nom, :cali, :codma, :metr, :prec, :precr, :codsu)');

            $temp->bindParam(':nom', $data['NOMBRE']);
            $temp->bindParam(':cali', $data['CALIDAD']);
            $temp->bindParam(':codma', $data['MARCA']);
            $temp->bindParam(':metr', $data['METROS']);
            $temp->bindParam(':prec', $data['PRECIOMETRO']);
            $temp->bindParam(':precr', $data['PRECIOMETROREAL']);
            $temp->bindParam(':codsu', $data['SUCURSAL']);

            $temp->execute();
            
            $codtela = $this->CONEX->connect->lastInsertId();

            $temp = $this->CONEX->connect->prepare('INSERT INTO ROLLO_TELA
                (CODTELA, CODCOLOR, NUMROLLOS, METROLLO, PRECIOROLLO, PRECIOROLLOREAL, MROLLOCOMPLETO) 
                VALUES (:codtela, :codcolor, :numrollos, :metrol, :prerl, :prerlreal, :mrollocom)');
            $temp->bindParam(':codtela', $codtela);
            $temp->bindParam(':metrol', $data['METROS']);
            $temp->bindParam(':prerl', $data['PROLLO']);
            $temp->bindParam(':prerlreal', $data['PROLLOREAL']);
            $temp->bindParam(':mrollocom', $data['METROS']);
            $temp->bindParam(':codcolor', $data['COLOR']);
            $temp->bindParam(':numrollos', $data['CANTIDAD']);
            $temp->execute();

            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return false;
    }
    public function checkStockOrNew($data){
        try {
            $temp = $this->CONEX->connect->prepare('SELECT * FROM TELA
            WHERE NOMBRE =:nom and CALIDAD = :cali AND CODMARCA  = :codma AND CODSUCURSAL = :codsu');

            $temp->bindParam(':nom', $data['NOMBRE']);
            $temp->bindParam(':cali', $data['CALIDAD']);
            $temp->bindParam(':codma', $data['MARCA']);
            $temp->bindParam(':codsu', $data['SUCURSAL']);

            $temp->execute();

            if($temp->rowCount() <= 0)
                return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return false;
    }
    public function getColors($id)
    {
        try {
            $temp = $this->CONEX->connect->prepare('SELECT CODCOLOR FROM ROLLO_TELA
            WHERE CODTELA = :CODT AND METROLLO > 0');
            $temp->bindParam(':CODT', $id);
            $temp->execute();
            return $temp->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    
    public function getInfoRollos($id)
    {
        try {
            $temp = $this->CONEX->connect->prepare('SELECT CODCOLOR,NUMROLLOS,PRECIOROLLOREAL,PRECIOROLLO, METROLLO FROM ROLLO_TELA
            WHERE CODTELA = :CODT ');
            $temp->bindParam(':CODT', $id);
            $temp->execute();
            return $temp->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getMetros($id)
    {
        try {
            $temp = $this->CONEX->connect->prepare('SELECT METROS FROM TELA
            WHERE CODTELA = :CODT');
            $temp->bindParam(':CODT', $id);
            $temp->execute();
            return $temp->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function getColorsAndStock($id)
    {
        try {
            $temp = $this->CONEX->connect->prepare('SELECT CODCOLOR, NUMROLLOS,METROLLO FROM ROLLO_TELA
            WHERE CODTELA = :CODT');
            $temp->bindParam(':CODT', $id);
            $temp->execute();
            return $temp->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function getTelas()
    {
        try {

            $temp = $this->CONEX->connect->prepare('SELECT
                T.CODTELA, T.NOMBRE,
                CASE 
                    WHEN CALIDAD = 1 THEN \'1RA\'
                    WHEN CALIDAD = 2 THEN \'2DA\'
                    WHEN CALIDAD = 3 THEN \'3RA\'
                    WHEN CALIDAD = 4 THEN \'4TA\'
                END AS CALIDAD,
                (
                    SELECT SUM(NUMROLLOS) 
                    FROM ROLLO_TELA
                    WHERE CODTELA = T.CODTELA
                ) AS ROLLOS,
                M.DESCRIPCION AS MARCA, METROS, PRECIO, PRECIO_REAL
                FROM Tela T, MARCA M
                WHERE T.CODMARCA = M.CODMARCA
                ');
            $temp->execute();
            return $temp->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getTela_idColor($id, $color)
    {
        try {

            $temp = $this->CONEX->connect->prepare('SELECT
                T.CODTELA, T.NOMBRE,
                CASE 
                    WHEN CALIDAD = 1 THEN \'1RA\'
                    WHEN CALIDAD = 2 THEN \'2DA\'
                    WHEN CALIDAD = 3 THEN \'3RA\'
                    WHEN CALIDAD = 4 THEN \'4TA\'
                END AS CALIDAD,
                (
                    SELECT NUMROLLOS 
                    FROM ROLLO_TELA
                    WHERE CODTELA = T.CODTELA
                    AND CODCOLOR = :color
                ) AS ROLLOS,
                (
                    SELECT CODCOLOR 
                    FROM ROLLO_TELA
                    WHERE CODTELA = T.CODTELA
                    AND CODCOLOR = :color
                ) AS CODCOLOR,
                M.DESCRIPCION AS MARCA, 
                (
                    SELECT METROLLO FROM ROLLO_TELA WHERE CODTELA = T.CODTELA AND
                    CODCOLOR = :color
                ) as METROS, 
                PRECIO, PRECIO_REAL
                FROM Tela T, MARCA M
                WHERE T.CODMARCA = M.CODMARCA AND
                T.CODTELA = :id 
                ');
            $temp->bindParam(':id', $id);
            $temp->bindParam(':color', $color);

            $temp->execute();

            $result = $temp->fetch(PDO::FETCH_ASSOC);

            // Verificar si se obtuvo algún resultado
            if ($result === false) {
                return array('status' => 'error', 'message' => 'No data found');
            }

            return array('status' => 'success', 'data' => $result);

            //return $temp->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return array('status' => 'error', 'message' => $e->getMessage());
        }
    }

    public function getTela($id)
    {
        try {

            $temp = $this->CONEX->connect->prepare('SELECT
                T.CODTELA, T.NOMBRE,CALIDAD AS CODCALIDAD, M.CODMARCA,
                CASE 
                    WHEN CALIDAD = 1 THEN \'1RA\'
                    WHEN CALIDAD = 2 THEN \'2DA\'
                    WHEN CALIDAD = 3 THEN \'3RA\'
                    WHEN CALIDAD = 4 THEN \'4TA\'
                END AS CALIDAD,
               
               
                M.DESCRIPCION AS MARCA, METROS, PRECIO, PRECIO_REAL
                FROM Tela T, MARCA M
                WHERE T.CODMARCA = M.CODMARCA AND
                T.CODTELA = :id 
                ');
            $temp->bindParam(':id', $id);

            $temp->execute();

            $result = $temp->fetch(PDO::FETCH_ASSOC);

            return $result;
        } catch (PDOException $e) {
        }
        return false;
    }
    public function getAll()
    {
        try {

            $temp = $this->CONEX->connect->prepare('SELECT T.CODTELA, T.NOMBRE,CASE 
                WHEN CALIDAD = 1 THEN \'1RA\'
                WHEN CALIDAD = 2 THEN \'2DA\'
                WHEN CALIDAD = 3 THEN \'3RA\'
                WHEN CALIDAD = 4 THEN \'4TA\'
                END AS CALIDAD,
                        (SELECT SUM(NUMROLLOS) 
                            FROM ROLLO_TELA
                            WHERE CODTELA = T.CODTELA
                        ) AS ROLLOS, 
                      
                        (SELECT DESCRIPCION FROM MARCA 
                        WHERE CODMARCA = T.CODMARCA )  AS MARCA,
                        
                        METROS, PRECIO, PRECIO_REAL, CODCOLOR, CODSUCURSAL
                        FROM Tela T
                        RIGHT JOIN ROLLO_TELA RT 
                        ON T.CODTELA = RT.CODTELA
                ');
            $temp->execute();
            return $temp->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getTop()
    {
        try {

            $temp = $this->CONEX->connect->prepare('SELECT T.CODTELA, T.NOMBRE,
            CASE 
                WHEN T.CALIDAD = 1 THEN \'1RA\'
                WHEN T.CALIDAD = 2 THEN \'2DA\'
                WHEN T.CALIDAD = 3 THEN \'3RA\'
                WHEN T.CALIDAD = 4 THEN \'4TA\'
            END AS CALIDAD, 
            (SELECT DESCRIPCION FROM MARCA WHERE CODMARCA = T.CODMARCA) AS MARCA,
            T.PRECIO, 
            T.PRECIO_REAL, 
    T.CODSUCURSAL,
    SUM(DV.CANTIDAD) AS TOTAL_CANTIDAD
FROM 
    Tela T
JOIN 
    DETALLE_VENTA DV ON T.CODTELA = DV.CODTELA
GROUP BY 
    T.CODTELA, 
    T.NOMBRE, 
    T.CALIDAD, 
    T.CODMARCA, 
    T.PRECIO, 
    T.PRECIO_REAL, 
    T.CODSUCURSAL
ORDER BY 
    TOTAL_CANTIDAD DESC limit 3');
            $temp->execute();
            return $temp->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }




    public function getSellTelas()
    {
        try {
            $temp = $this->CONEX->connect->prepare('SELECT T.NOMBRE,
                COALESCE( (SELECT SUM(CANTIDAD)
                            FROM DETALLE_VENTA DV
                            WHERE DV.CODTELA = T.CODTELA), 0
                        ) AS METROS
                FROM Tela T;');
        $temp->execute();
        return $temp->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

    public function getInfoSellTelas(){
        try {
            $temp = $this->CONEX->connect->prepare('SELECT T.NOMBRE,
            COALESCE( (SELECT SUM(CANTIDAD)
                FROM DETALLE_VENTA DV
                WHERE DV.CODTELA = T.CODTELA), 0) AS METROSV,
                CASE 
                    WHEN CALIDAD = 1 THEN \'1RA\'
                    WHEN CALIDAD = 2 THEN \'2DA\'
                    WHEN CALIDAD = 3 THEN \'3RA\'
                    WHEN CALIDAD = 4 THEN \'4TA\'
                END AS CALIDAD,
                M.DESCRIPCION AS MARCA,
                T.PRECIO AS PRECIO_METRO,T.PRECIO_REAL AS PRECIO_METRO_REAL, SUM(NUMROLLOS) AS TOTAL_ROLLOS

            FROM Tela T, Marca as M, ROLLO_TELA RT
            WHERE T.CODMARCA = M.CODMARCA AND
            T.CODTELA = RT.CODTELA
            GROUP BY METROS, MARCA, PRECIO_METRO, PRECIO_METRO_REAL, CALIDAD
            ORDER BY METROSV DESC');
            $temp->execute();
            return $temp->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) { echo $e->getMessage(); }
    }

    public function update($data)
    {
        try {
            $temp = $this->CONEX->connect->prepare('UPDATE TELA
                 SET PRECIO = :prec, PRECIO_REAL = :precr
                 WHERE CODTELA = :codt');

            $temp->bindParam(':prec', $data['PRECIOMETRO']);
            $temp->bindParam(':precr', $data['PRECIOMETROREAL']);
            $temp->bindParam(':codt', $data['id']);

            $temp->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return false;
    }
    public function updateForRollo($data)
    {
        try {
            $temp = $this->CONEX->connect->prepare('UPDATE ROLLO_TELA
                 SET PRECIOROLLO = :prer, PRECIOROLLOREAL = :prereal
                 WHERE CODTELA = :id');

            $temp->bindParam(':prer', $data['PRECIOROLLO']);
            $temp->bindParam(':prereal', $data['PRECIOROLLOREAL']);
            $temp->bindParam(':id', $data['id']);

            $temp->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return false;
    }

    public function updateRollos($data) {
        try {
            $temp = $this->CONEX->connect->prepare('UPDATE ROLLO_TELA
                SET NUMROLLOS = :numRollos
                WHERE CODTELA = :id AND CODCOLOR = :codc');
    
            $temp->bindParam(':id', $data['ID']);
            
            for ($i = 0; $i < $data['TOTAL']; $i++) {
                $VALIDAR = $this->CONEX->connect->prepare('SELECT * FROM ROLLO_TELA
                WHERE CODTELA = :id AND CODCOLOR = :codc');
                $color = $data['ALLCOLORS']['CODC' . $i];
                $cant = $data['ALLCOLORS']['NUMROLLOS' . $i];
                
                $VALIDAR->bindParam(':id', $data['ID']);
                $VALIDAR->bindParam(':codc', $color);
                $VALIDAR->execute();
                
                //print_r($VALIDAR->fetch());
                if ($VALIDAR->rowCount() == 0){
                    echo 'noha';
                    $base = $this->CONEX->connect->prepare('SELECT * FROM ROLLO_TELA WHERE CODTELA = :id LIMIT 1');
                    $base->bindParam(':id', $data['ID']);
                    $base->execute();
                    $base = $base->fetch(PDO::FETCH_ASSOC);
    
                    $new = $this->CONEX->connect->prepare('INSERT INTO ROLLO_TELA
                    (CODTELA, CODCOLOR, NUMROLLOS, METROLLO, MROLLOCOMPLETO, PRECIOROLLO,
                    PRECIOROLLOREAL, PRECIO_METRO, PRECIO_METRO_REAL)
                    VALUES 
                    (:id, :codc, :numrol, :metrol, :metrolcom, :precioro, 
                    :preciororeal,:preciome, :preciomereal)');
    
                    $new->bindParam(':id',$data['ID']);
                    $new->bindParam(':codc',$color);
                    $new->bindParam(':numrol',$cant);
                    $new->bindParam(':metrol',$base['METROLLO']);
                    $new->bindParam(':metrolcom',$base['MROLLOCOMPLETO']);
                    $new->bindParam(':precioro',$base['PRECIOROLLO']);
                    $new->bindParam(':preciororeal',$base['PRECIOROLLOREAL']);
                    $new->bindParam(':preciome',$base['PRECIO_METRO']);
                    $new->bindParam(':preciomereal',$base['PRECIO_METRO_REAL']);
                    $new->execute();
                   
                }else{
                    $temp->bindParam(':codc', $color);
                    $temp->bindParam(':numRollos', $cant);
        
                    $temp->execute();

                }   
            }        
            return true;
        } catch (PDOException $e) {
            return false; 
        }
    }

}
?>
