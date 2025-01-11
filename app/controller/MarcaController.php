<?php
    class Marca extends Controller{
        public function index(){
            $model = $this->model('Marca');
            
            $this->view('marca/marca',$model->view());
        }

        public function form(){
            $this->view('Marca/form');
        }

        public function create()
        {
            $model = $this->model('Marca');
            $data = [
                'DESCRI'=> $_POST['descri']
            ];

            if ($model->create($data)) {
                header('Location: /' . APP_NAME . '/Marca');
            } else {
                header('Location: /' . APP_NAME . '/Marca/form');
            }
        }
    
    
        public function delete()
        {
            session_start();
            $model = $this->model('Marca');
            if($model->delete($_GET['id'])){
                $_SESSION['title'] = 'ELIMINADO';
                $_SESSION['msg'] = 'Marca eliminada correctamente';
            }else{
                $_SESSION['icon'] = 'error';
                $_SESSION['title'] = 'ERROR';
                $_SESSION['msg'] = 'La marca es parte de registro, no puede ser eliminado';
            }
        
            header('Location: /'.APP_NAME.'/Marca');
        }
    
        public function update(){
            $model = $this->model('Marca');
            $datos = $model->getMarca($_GET['id']);
            $this->view('marca/formUpdate',$datos);
        }
        public function save(){
            $data = [
                'ID' => $_POST['id'],
                'DESCRI' => $_POST['descri']
            ];
            $model = $this->model('Marca');
            $model->update($data);       
    
            $this->messageUpdate();
            header('Location: /' . APP_NAME . '/Marca');
        }
    }
?>