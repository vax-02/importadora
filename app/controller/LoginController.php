<?php
class Login extends Controller
{
    public function __construct()
    {
    }
    public function index()
    {
        $this->view('Login');
    }

    public function check()
    {


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $modelo = $this->model('Usuario');
            $data = $modelo->findUser($_POST['user'], md5($_POST['pass']));
            session_start();

            if ($data != '') {
                if ($data['ESTADO']) {
                    error_reporting(0);

                    $_SESSION['id'] = $data['ID'];
                    $_SESSION['usuario'] = $data['USUARIO'];
                    $_SESSION['nombre'] =
                        ucwords($data['NOMBRE']) . ' ' .
                        ucwords($data['PATERNO']) . ' ' .
                        ucwords($data['MATERNO']);
                    $_SESSION['celular'] = $data['CELULAR'];
                    $_SESSION['cargo'] = $data['CARGO'];
                    $_SESSION['rol'] = $data['CODCARGO'];

                    $_SESSION['sucursal'] = $this->model('Notificacion')->getSucursalName($data['CODSUCURSAL'])['NOMBRE'];
                    $_SESSION['cod_sucursal'] = $data['CODSUCURSAL'];
                    switch ($data['CODCARGO']) {
                        case 1: //Admin
                            header('Location: /' . APP_NAME . '/Inicio');
                            return 0;
                        case 2: //Supervisor
                            header('Location: /' . APP_NAME . '/Sucursal/Inicio');
                            return 0;
                        case 3: //Vendedor
                            header('Location: /' . APP_NAME . '/Sucursal/Inicio');
                            return 0;
                    }

                } else {
                    $_SESSION['error'] = 'status';
                }
            } else {
                $_SESSION['error'] = 'not user';
            }
        }
        header('Location: /' . APP_NAME . '/login');

    }

    public function logout()
    {
        session_destroy();

        header('Location: /' . APP_NAME . '/login');
    }
}

?>