<?php
    class Proveedor extends Controller{

        public function index(){
            $model = $this->model('proveedor');
            $this->view('proveedor/proveedor',$model->view());
        }
        public function form(){
            $this->view('proveedor/form');
        }

        public function create()
        {
            $model = $this->model('Proveedor');
            
            $data = [
                'NOMBRE'=> $_POST['nombre'],
                'DIREC'=> $_POST['direc'],
                'TELEFONO'=> $_POST['cel']
            ];

            if ($model->create($data)) {
                header('Location: /' . APP_NAME . '/Proveedor');
            } else {
                header('Location: /' . APP_NAME . '/Proveedor/form');
            }
        }
        
        public function delete()
        {
            session_start();
            $model = $this->model('Proveedor');
            if($model->delete($_GET['id'])){
                $this->messageDelete();
            }else{
                $this->messageNoDelete();
            }
        
            header('Location: /'.APP_NAME.'/Proveedor');
        }
    
        public function update(){
            $model = $this->model('Proveedor');
            $datos = $model->getProveedor($_GET['id']);
            $this->view('proveedor/formUpdate',$datos);
        }      
        
        public function save()
        {
            $model = $this->model('Proveedor');
            
            $data = [
                'NOMBRE'=> $_POST['nombre'],
                'DIREC'=> $_POST['direc'],
                'TELEFONO'=> $_POST['cel'],
                'ID' => $_POST['id']
            ];

            $model->update($data);

            $this->messageUpdate();
            header('Location: /' . APP_NAME . '/Proveedor');
        }
        
    }
?>
