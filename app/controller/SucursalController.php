<?php
class Sucursal extends Controller
{
    public function index()
    {
        $model = $this->model('Sucursal');

        $this->view('sucursal/sucursal', $model->view());
    }
    public function inicio()
    {
        session_start();
        $model = $this->model('Tela');
        
        $telas = $model->viewMySucursal($_SESSION['cod_sucursal']);
        foreach ($telas as &$row) {
            $row['rollos'] = $model->getInfoRollos($row['CODTELA']);
        }
        $this->view('sucursal/inicio',$telas);
    }

    public function form()
    {
        $encargado = $this->model('Personal');
        $this->view('sucursal/form', $encargado->viewAll());
    }

    public function create()
    {
        $model = $this->model('Sucursal');
        $data = [
            'NOMBRE' => $_POST['nombre'],
            'DIRECCION' => $_POST['direccion'],
            'DESCRIPCION' => $_POST['descripcion'],
            'TELEFONO' => $_POST['cel'],
            'ENCARGADO' => $_POST['encargado']
        ];

        $result = $model->create($data);
        if (!$result) {
            //ERRPR PORQUE DIO FALSE
            //echo 'No se registro';
            header('Location: /' . APP_NAME . '/Sucursal/form');
        } else {
            //modificar el rol del personal
            $model = $this->model('Personal');
            $model->setCargo($data['ENCARGADO'], 2); //Supervisor
            $model->setSucursal($data['ENCARGADO'],$result);
            //Iniciar control de fecha EN ENCARGADO_SUCURSAL
            $model = $this->model('EncargadoSucursal');
            $model->create(
                [
                    'CODSUCURSAL' => $result,
                    'IDPERSONAL' => $data['ENCARGADO']
                ]
            );
            header('Location: /' . APP_NAME . '/Sucursal');
        }
    }


    public function delete()
    {
        session_start();
        $model = $this->model('Sucursal');
        if ($model->delete($_GET['id'])) {
            $this->messageDelete();
        } else {
            $this->messageNoDelete();
        }

        header('Location: /' . APP_NAME . '/Sucursal');
    }

    public function update()
    {
        $model = $this->model('Sucursal');
        $datos = $model->getSucursal($_GET['id']);
        $personal = $this->model('Personal')->getPersonaException($datos[0]['ID']);
        $this->view('sucursal/formUpdate', $datos, $personal);
    }
    public function save()
    {
        $data = [
            'ID' => $_POST['id'],
            'NOMBRE' => $_POST['nombre'],
            'DIRECCION' => $_POST['direccion'],
            'DESCRIPCION' => $_POST['descripcion'],
            'TELEFONO' => $_POST['cel'],
            'ENCARGADO' => $_POST['encargado']
        ];
        $model = $this->model('Sucursal');
        $actEncargado = $model->getIdEncargado($data['ID']);
        if ($actEncargado != $data['ENCARGADO']) {
            //Poner rol de vendedor al anterior
            $this->model('Personal')->setCargo($actEncargado['ID'], 3);
            $this->model('Personal')->setCargo((int) $data['ENCARGADO'], 2);


            //COMO ES DIF PONER FECHA DE FIN AL SUPERVISOR
            $model = $this->model('EncargadoSucursal');
            $cod = $model->buscarCargo(
                [
                    'CODSU' => $data['ID'],
                    'IDPE' => $actEncargado['ID']
                ]
            );

            date_default_timezone_set('America/La_Paz');
            $model->update(
                [
                    'COD' => $cod['COD'],
                    'FIN' => date('Y-m-d')
                ]
            );


            //CREAMOS REGISTRO DE NUEVO ENCARGADO
            $model->create(
                [
                    'CODSUCURSAL' => $data['ID'],
                    'IDPERSONAL' => $data['ENCARGADO']
                ]
            );
        }

        $this->model('Sucursal')->update($data);
        $this->messageUpdate();
        header('Location: /' . APP_NAME . '/Sucursal');
    }

    public function detail()
    {
        $model = $this->model('Sucursal');
        $this->view(
            'sucursal/detail',
            $model->detail($_GET['id']),
            $model->personalSucursal($_GET['id']),
            $model->encargadosSucursal($_GET['id'])
        );
    }

    public function getSucursal()
    {
        $model = $this->model('Sucursal');

        $sucursal = $model->detail($_POST['id']);


        $data = array(
            "status" => "success",
            "message" => "Data fetched successfully ",
            "data" => array(
                "NOMBRE" => $sucursal['NOMBRE'],
                "DIRECCION" => $sucursal['DIRECCION'],
                "TELEFONO" => $sucursal['TELEFONO']
            )
        );

        header('Content-Type: application/json');

        // Enviar la respuesta
        echo json_encode($data);


    }
    public function supervisar(){
        session_start();
        $model = $this->model('Sucursal');
        if($_SESSION['rol']==1){
            $this->view('sucursal/supervisar', $model->view());
        }else{
            $this->view('sucursal/supervisar', $model->getSucursalOfSupervisor($_SESSION['id']));
        }
    }
    public function selectSucursal(){
        session_start();
        $_SESSION['cod_sucursal'] = $_POST['idS'];
        $_SESSION['sucursal'] = $_POST['nombre'];

        $model = $this->model('Sucursal');
        if($_SESSION['rol']==1){
          $this->view('sucursal/supervisar', $model->view());
        }else{
        $this->view('sucursal/supervisar', $model->getSucursalOfSupervisor($_SESSION['id']));
        }
    }
}
?>