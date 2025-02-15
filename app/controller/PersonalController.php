<?php
class Personal extends Controller
{
    public function index()
    {
        session_start();
        $model = $this->model('Personal');

        switch ($_SESSION['rol']) {
            case 1:
                $this->view('personal/personal', $model->view());
                break;
            case 2:
                $this->view('personal/personal', $model->viewMySucursal($_SESSION['cod_sucursal']));
                break;
            
        }

    }

    public function form()
    {
        $sucursal = $this->model('sucursal');
        //print_r($model->view());
        $this->view('personal/form', $sucursal->view());
    }
    public function formAdmin(){
        $sucursal = $this->model('sucursal');
        $this->view('personal/formAdmin', $sucursal->view());
    }
    public function create()
    {
        session_start();
        $data = [
            'CARGO' => $_POST['rol'],
            'NOMBRE' => $_POST['nombre'],
            'PATERNO' => $_POST['apeP'],
            'MATERNO' => $_POST['apeM'],
            'USUARIO' => $_POST['usuario'],
            'CONTRA' => md5($_POST['pass']),
            'CELULAR' => $_POST['cel'],
            'ESTADO' => 1,
            'SUCURSAL' => ($_POST['sucursal'] == 0) ? $_SESSION['cod_sucursal'] : $_POST['sucursal']
        ];

        $model = $this->model('Personal');

        if ($model->create($data)) {

            header('Location: /' . APP_NAME . '/Personal');
        } else {
            header('Location: /' . APP_NAME . '/Personal/form');
        }
    }

    public function delete()
    {
        session_start();
        $model = $this->model('Personal');
        if ($model->delete($_GET['id'])) {
            $_SESSION['title'] = 'ELIMINADO';
            $_SESSION['msg'] = 'Usuario eliminado correctamente';
        } else {
            $_SESSION['icon'] = 'error';
            $_SESSION['title'] = 'ERROR';
            $_SESSION['msg'] = 'El usuario forma parte de registro, no puede ser eliminado';
        }

        header('Location: /' . APP_NAME . '/Personal');
    }

    public function update()
    {
        $datos = $this->model('Personal')->getPersona($_GET['id']);
        $cargos = [
            '1' => 'Administrador',
            '3' => 'Vendedor'
        ];
        if ($datos['CODCARGO'] != 2) { //Supervisor
            $cargos = ($datos['CARGO'] == $cargos['1']) ? [3, 'Vendedor'] : [1, 'Administrador'];
        } else {
            $cargos = [];
        }
        $sucursal = $this->model('Sucursal')->getSucursalException($datos['CODSUCURSAL']);
        $this->view('personal/formUpdate', $datos, $sucursal, $cargos);
    }

    public function save()
    {
        $data = [
            'CARGO' => $_POST['rol'],
            'NOMBRE' => $_POST['nombre'],
            'PATERNO' => $_POST['apeP'],
            'MATERNO' => $_POST['apeM'],
            'USUARIO' => $_POST['usuario'],
            'CELULAR' => $_POST['cel'],
            'SUCURSAL' => $_POST['sucursal'],
            'ID' => $_POST['id']
        ];


        $model = $this->model('Personal');

        $model->update($data);

        $_SESSION['title'] = 'MODIFICADO';
        $_SESSION['msg'] = 'Datos del usuario actualizados';
        header('Location: /' . APP_NAME . '/Personal');
    }
    public function lock()
    {
        session_start();
        $m = $this->model('Usuario');
        $m->lock($_GET['id']);
        $_SESSION['title'] = 'BLOQUEADO';
        $_SESSION['msg'] = 'El personal ya no tendra acceso';
        header('Location: /' . APP_NAME . '/Personal');
    }

    public function unlock()
    {
        session_start();
        $m = $this->model('Usuario');
        $m->unlock($_GET['id']);
        $_SESSION['title'] = 'DESBLOQUEADO';
        $_SESSION['msg'] = 'El personal tiene acceso nuevamente';
        header('Location: /' . APP_NAME . '/Personal');
    }

}

?>