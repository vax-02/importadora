<?php
class Productos extends Controller
{
    public function index()
    {
        $model = $this->model('Producto');
        $telas = $model->view();
        $this->view('producto/producto', $telas);
    }

    public function form()
    {
        $this->view('producto/form');
    }

    public function create()
    {        
        $model = $this->model('Producto');

        if($model->check($_POST['nombre'])){
            $model->create($_POST['nombre']);
            header('Location: /' . APP_NAME . '/Productos');
        }else{
            $this->view('producto/form','error');
        }
    }


    public function delete()
    {
        session_start();
        $model = $this->model('Producto');

        if ($model->delete($_GET['id'])) {
            $_SESSION['title'] = 'ELIMINADO';
            $_SESSION['msg'] = 'Tela eliminado correctamente';
        } else {
            $_SESSION['icon'] = 'error';
            $_SESSION['title'] = 'ERROR';
            $_SESSION['msg'] = 'La tela forma parte de registro, no puede ser eliminado';
        }

        header('Location: /' . APP_NAME . '/Productos');
    }

    public function edit(){
        $this->view('producto/formUpdate','',$this->model('Producto')->getProducto($_GET['id']));
    }
    
    public function save()
    {
        session_start();
        $model = $this->model('Producto');

        $data = [
            'ID' => $_POST['id'],
            'NOMBRE' => $_POST['nombre']
        ];

        if($model->check($_POST['nombre'])){
            $model->update($data);

            

            $_SESSION['title'] = 'MODIFICADO';
            $_SESSION['msg'] = 'Producto actualizados';
            
            header('Location: /' . APP_NAME . '/Productos');
        }else{
            $this->view('producto/form','error');
        }
        
        
    }
}
?>
