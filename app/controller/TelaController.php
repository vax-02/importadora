<?php
class Tela extends Controller
{
    public function index()
    {
        $model = $this->model('Tela');
        $telas = $model->view();
        foreach ($telas as &$row) {
            $row['colores'] = $model->getColors($row['CODTELA']);
        }
        
        $this->view('tela/tela', $telas);
    }

    public function form()
    {
        $model = $this->model('MarCa');
        $this->view('tela/form', $model->view(),$this->model('Producto')->view());
    }

    public function create()
    {        
        /*
        session_start();
        $model = $this->model('Personal');
        $personal = $model->getSucursalPersona($_SESSION['id']);

        $model = $this->model('Tela');
        $data = [
            'NOMBRE' => $_POST['nombre'],
            'CALIDAD' => $_POST['calidad'],
            'MARCA' => $_POST['marca'],
            'PROLLOREAL' => $_POST['pVentaRolloReal'],
            'PROLLO' => $_POST['pVentaRollo'],
            'CANTIDAD' => $_POST['cantidad'],
            'METROS' => $_POST['metros'],
            'PRECIOMETRO' => $_POST['precioMetro'],
            'PRECIOMETROREAL' => (int) ($_POST['pVentaRollo'] / (int) $_POST['metros']),
            'TOTALR' => $_POST['totalr'],
            'SUCURSAL' => $personal['CODSUCURSAL'],
            'TCOLORES' => $_POST['tcolores']
        ];

        

        for ($i = 0; $i < $_POST['tcolores']; $i++) {
            $data['color' . $i] = $_POST['color' . $i];
            $data['cantidad' . $i] = $_POST['cant' . $i];
        }

        if ($model->create($data)) {
            header('Location: /' . APP_NAME . '/Tela');
        } else {
            header('Location: /' . APP_NAME . '/Tela/form');
        }
            */
    }


    public function delete()
    {
        session_start();
        $model = $this->model('Tela');

        if ($model->delete($_GET['id'])) {
            $_SESSION['title'] = 'ELIMINADO';
            $_SESSION['msg'] = 'Tela eliminado correctamente';
        } else {
            $_SESSION['icon'] = 'error';
            $_SESSION['title'] = 'ERROR';
            $_SESSION['msg'] = 'La tela forma parte de registro, no puede ser eliminado';
        }

        header('Location: /' . APP_NAME . '/Tela');
    }

    public function addStock(){
        $model = $this->model('Tela');
        $tela = $model->getTela($_GET['id']);
        $tela['rollos'] = $model->getInfoRollos($tela['CODTELA']);
        $this->view('tela/addStock',$tela);
    }
    public function save()
    {
        session_start();
        $data = [
            'ID' => $_POST['id'],
            'DESCRI' => $_POST['descri']
        ];
        $model = $this->model('Cargo');
        $model->update($data);

        $_SESSION['title'] = 'MODIFICADO';
        $_SESSION['msg'] = 'Datos del usuario actualizados';
        header('Location: /' . APP_NAME . '/usuario');
    }
    public function addStockSave(){
        $tela = $this->model('Tela');
        print_r( $_POST);

        $tela->update(
            [
                'PRECIOMETRO' =>  $_POST['precioMetroVenta'],
                'PRECIOMETROREAL' => $_POST['precioMetro'],
                'id' => $_POST['id']
            ]
        );
        $tela->updateForRollo([
            'PRECIOROLLO' => $_POST['precioRollo'],
            'PRECIOROLLOREAL' => $_POST['precioRolloReal'],
            'id' => $_POST['id']
        ]);
        for($i = 0 ;$i<$_POST['tcolores']; $i++){
            $colores['CODC'.$i] = trim( $_POST['color'.$i]); 
            $colores['NUMROLLOS'.$i] = $_POST['cant'.$i];
        }
        
        $tela->updateRollos(
            [
                'ID' => $_POST['id'],
                'ALLCOLORS' => $colores,
                'TOTAL' => $_POST['tcolores']
            ]
        );

        header('Location: /' . APP_NAME . '/tela');
    }
}
?>
