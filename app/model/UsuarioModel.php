<?php
class UsuarioModel extends DB
{
    private $CONEX; //pvariable conexion
    public function __construct()
    {
        $this->CONEX = new DB;
    }

    public function findUser($user, $pass){ 
        try {
            $temp = $this->CONEX->connect->prepare('SELECT ID,USUARIO,NOMBRE,PATERNO, MATERNO,CELULAR,
             CODCARGO, 
             CASE
                WHEN CODCARGO = 1 THEN \'Adminstrador\'
                WHEN CODCARGO = 2 THEN \'Supervisor\'
                WHEN CODCARGO = 3 THEN \'Vendedor\'
             END AS CARGO, ESTADO, CODSUCURSAL
            FROM PERSONAL WHERE usuario = :user AND contra = :pass');
            $temp->bindParam(':user', $user);
            $temp->bindParam(':pass', $pass);
            $temp->execute();

            $usuario = $temp->fetch(PDO::FETCH_ASSOC);
            if ($usuario)
                return $usuario;

        } catch (PDOException $e) {
        }
        return '';
    }

    public function getRol($rol)
    {
        try {
            $temp = $this->CONEX->connect->prepare('SELECT * FROM rol WHERE id = :rol');
            $temp->bindParam(':rol', $rol);
            $temp->execute();
            return $temp->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return '';
        }
    }

    public function lock($id)
    {
        $v = 0;
        try {
            $temp = $this->CONEX->connect->prepare('UPDATE PERSONAL 
            SET ESTADO = :std WHERE ID = :ID');
            $temp->bindParam(':std', $v);
            $temp->bindParam(':ID', $id);
            $temp->execute();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function unlock($id)
    {
        $v = 1;
        try {
            $temp = $this->CONEX->connect->prepare('UPDATE PERSONAL 
            SET ESTADO = :std WHERE ID = :id');
            $temp->bindParam(':std', $v);
            $temp->bindParam(':id', $id);
            $temp->execute();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

}

?>