<?php
class PersonalModel extends DB
{
    private $CONEX; //pvariable conexion
    public function __construct()
    {
        $this->CONEX = new DB;
    }

    public function view()
    {
        try {
            error_reporting(0);
            session_start();

            $temp = $this->CONEX->connect->prepare('SELECT
                ID, CONCAT(p.NOMBRE,\' \',PATERNO,\' \',MATERNO) AS NOMBRE,CELULAR,
                USUARIO, CASE
                    WHEN CODCARGO = 1 THEN \'Administrador\'
                    WHEN CODCARGO = 2 THEN \'Supervisor\'
                    WHEN CODCARGO = 3 THEN \'Vendedor\'
                END AS CARGO,
                CASE
                    WHEN P.CODSUCURSAL = 0 THEN \'SIN SUCURSAL\'
                    ELSE S.NOMBRE
                END AS SUCURSAL, ESTADO
                
                FROM personal p, sucursal s
                WHERE ID != :id AND
                P.CODSUCURSAL = S.CODSUCURSAL OR P.CODSUCURSAL = 0
                ');
            $temp->bindParam(':id', $_SESSION['id']);
            $temp->execute();
            return $temp->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function viewMySucursal($id)
    {
        try {
            error_reporting(0);
            session_start();

            $temp = $this->CONEX->connect->prepare('SELECT
                ID, CONCAT(p.NOMBRE,\' \',PATERNO,\' \',MATERNO) AS NOMBRE,
                USUARIO, CASE
                    WHEN CODCARGO = 1 THEN \'Administrador\'
                    WHEN CODCARGO = 2 THEN \'Supervisor\'
                    WHEN CODCARGO = 3 THEN \'Vendedor\'
                END AS CARGO,
                CASE
                    WHEN P.CODSUCURSAL = 0 THEN \'SIN SUCURSAL\'
                    ELSE S.NOMBRE
                END AS SUCURSAL, ESTADO
                
                FROM personal p, sucursal s
                WHERE ID != :id AND
                P.CODSUCURSAL = S.CODSUCURSAL AND P.CODSUCURSAL = :IDSUC AND 
                p.CODCARGO = 3');

            $temp->bindParam(':IDSUC', $id);
            $temp->bindParam(':id', $_SESSION['id']);
            $temp->execute();
            return $temp->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function viewAll()
    {
        try {

            $temp = $this->CONEX->connect->prepare('SELECT *
                FROM PERSONAL ');
            $temp->execute();
            return $temp->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function create($data)
    {
        try {

            $temp = $this->CONEX->connect->prepare('INSERT INTO PERSONAL( NOMBRE,PATERNO,MATERNO,USUARIO,
                CONTRA,CELULAR,ESTADO,CODCARGO,CODSUCURSAL) VALUES 
                (:nom, :pa ,:ma, :user, :contr, :cel, :esta, :codcar, :codsu)');
            $temp->bindParam(':nom', $data['NOMBRE']);
            $temp->bindParam(':pa', $data['PATERNO']);
            $temp->bindParam(':ma', $data['MATERNO']);
            $temp->bindParam(':user', $data['USUARIO']);
            $temp->bindParam(':contr', $data['CONTRA']);
            $temp->bindParam(':cel', $data['CELULAR']);
            $temp->bindParam(':esta', $data['ESTADO']);
            $temp->bindParam(':codcar', $data['CARGO']);
            $temp->bindParam(':codsu', $data['SUCURSAL']);
            $temp->execute();

            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return false;
    }

    public function getPersona($id)
    {
        try {
            $temp = $this->CONEX->connect->prepare('SELECT 
                ID, p.NOMBRE ,PATERNO, MATERNO ,P.CELULAR,
                USUARIO, CASE
                    WHEN CODCARGO = 1 THEN \'Administrador\'
                    WHEN CODCARGO = 2 THEN \'Supervisor\'
                    WHEN CODCARGO = 3 THEN \'Vendedor\'
                END AS CARGO,CODCARGO,P.CODSUCURSAL,
                S.NOMBRE AS SUCURSAL, ESTADO
                
                FROM personal p, sucursal s
                WHERE ID = :id AND
                P.CODSUCURSAL = S.CODSUCURSAL
                ');

            $temp->bindParam(':id', $id);
            $temp->execute();
            return $temp->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function getPersonaException($id)
    {
        try {
            $temp = $this->CONEX->connect->prepare('SELECT 
                ID, CONCAT(NOMBRE,\' \',PATERNO,\' \',MATERNO) AS ENCARGADO
                FROM personal
                WHERE ID != :id');
            $temp->bindParam(':id', $id);
            $temp->execute();
            return $temp->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function update($data)
    {
        try {
            $temp = $this->CONEX->connect->prepare('UPDATE Personal SET
                    NOMBRE = :nom, PATERNO = :pa, MATERNO = :ma, USUARIO = :user,
                    CELULAR = :cel, CODCARGO = :codcar, 
                    CODSUCURSAL = :codsu WHERE ID =:id');

            $temp->bindParam(':nom', $data['NOMBRE']);
            $temp->bindParam(':pa', $data['PATERNO']);
            $temp->bindParam(':ma', $data['MATERNO']);
            $temp->bindParam(':user', $data['USUARIO']);
            $temp->bindParam(':cel', $data['CELULAR']);
            $temp->bindParam(':codcar', $data['CARGO']);
            $temp->bindParam(':codsu', $data['SUCURSAL']);
            $temp->bindParam(':id', $data['ID']);

            $temp->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function delete($id)
    {
        try {
            $temp = $this->CONEX->connect->prepare('DELETE FROM Personal WHERE id = :id');
            $temp->bindParam(':id', $id);
            $temp->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return false;
    }
    public function setCargo($id, $cargo)
    {
        try {
            $temp = $this->CONEX->connect->prepare('UPDATE Personal
                SET CODCARGO = :car
                WHERE ID = :ID');
            $temp->bindParam(':car', $cargo);
            $temp->bindParam(':ID', $id);
            $temp->execute();

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


    public function cantPersonal()
    {
        try {
            error_reporting(0);
            session_start();

            $temp = $this->CONEX->connect->prepare('SELECT COUNT(*) AS CANPERSONAL
                FROM PERSONAL');
            $temp->execute();
            return $temp->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getSucursalPersona($id)
    {
        try {
            $temp = $this->CONEX->connect->prepare('SELECT CODSUCURSAL FROM PERSONAL
            WHERE ID = :id');
            $temp->bindParam(':id', $id);

            $temp->execute();
            return $temp->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getPersonalTop(){
        try {
            $temp = $this->CONEX->connect->prepare('SELECT 
            CONCAT(P.NOMBRE,\' \',PATERNO,\' \',MATERNO) AS PERSONAL,
              -- Suponiendo que tienes un campo NOMBRE en la tabla PERSONAL
    COUNT(V.CODVENTA) AS VENTASR
FROM 
    PERSONAL P
LEFT JOIN 
    VENTA V ON P.ID = V.IDPERSONAL
GROUP BY 
    P.ID, P.NOMBRE
ORDER BY 
    VENTASR DESC 
LIMIT 5;

            ');

            $temp->execute();
            return $temp->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function getPersonalAllTop(){
        try {
            $temp = $this->CONEX->connect->prepare('SELECT 
            CONCAT(P.NOMBRE,\' \',PATERNO,\' \',MATERNO) AS PERSONAL, P.CELULAR, P.USUARIO, 
            CASE
                WHEN ESTADO = 1 THEN \'ACTIVO\'
                WHEN ESTADO = 0 THEN \'INACTIVO\'
            END AS ESTADO,
            COUNT(V.CODVENTA) AS VENTASR
            FROM PERSONAL P LEFT JOIN VENTA V ON P.ID = V.IDPERSONAL
            GROUP BY P.ID, P.NOMBRE ORDER BY VENTASR DESC ');

            $temp->execute();
            return $temp->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}

?>
