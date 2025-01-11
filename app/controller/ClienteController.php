<?php
    class Cliente extends Controller{

        public function index(){
            $model = $this->model('Cliente');
            $this->view('cliente/cliente',$model->view());
        }
        public function form(){
            $this->view('cliente/form');
        }
        
        public function formVenta(){
            $this->view('cliente/formVenta');
        }
        public function formVentaCortina(){
            $this->view('cliente/formVentaTela');
        }
        public function create()
        {
            $model = $this->model('Cliente');
            $data = [
                'RAZON'=> $_POST['nombre'],
                'TIPO'=> $_POST['tipo'],
                'TELEFONO'=> $_POST['cel'],
                'CINIT'=> $_POST['cinit']
            ];

            if ($model->create($data)) {
                header('Location: /' . APP_NAME . '/Cliente');
            } else {
                header('Location: /' . APP_NAME . '/Cliente/form');
            }
        }
        
        public function createVenta()
        {
            $model = $this->model('Cliente');
            
            $data = [
                'RAZON'=> $_POST['nombre'],
                'TIPO'=> $_POST['tipo'],
                'TELEFONO'=> $_POST['cel'],
                'CINIT'=> $_POST['cinit']

            ];

            if ($model->create($data)) {
                header('Location: /' . APP_NAME . '/Venta/Cortina');
            } else {
                header('Location: /' . APP_NAME . '/Cliente/formVenta');
            }
        }
        public function createVentaTela()
        {
            $model = $this->model('Cliente');
            
            $data = [
                'RAZON'=> $_POST['nombre'],
                'TIPO'=> $_POST['tipo'],
                'TELEFONO'=> $_POST['cel'],
                'CINIT'=> $_POST['cinit']

            ];

            if ($model->create($data)) {
                header('Location: /' . APP_NAME . '/Venta/form');
            } else {
                header('Location: /' . APP_NAME . '/Cliente/formVentaTela');
            }
        }
        
        public function delete()
        {
            session_start();
            $model = $this->model('Cliente');
            if($model->delete($_GET['id'])){
                $this->messageDelete();
            }else{
                $this->messageNoDelete();
            }
        
            header('Location: /'.APP_NAME.'/Cliente');
        }
        
        public function update(){
            $model = $this->model('Cliente');
            $this->view('cliente/formUpdate',$model->getCliente($_GET['id']));
        }
        public function save(){
            $data = [
                'RAZON'=> $_POST['nombre'],
                'TIPO'=> $_POST['tipo'],
                'TELEFONO'=> $_POST['cel'],
                'CINIT'=> $_POST['cinit'],
                'ID'=> $_POST['id'],
            ];
            $model = $this->model('Cliente');
            $model->update($data);
            $this->messageUpdate();
            header('Location: /'.APP_NAME.'/Cliente');
            
        }      
        public function verificarCI(){
            if(isset($_POST['ci'])){
                $model = $this->model('Cliente');
                echo json_encode($model->verifyCliente($_POST['ci']));
            }
        }
        public function saveClientModal(){
            $model = $this->model('Cliente');
            $data = [
                'RAZON'=> $_POST['name'],
                'TIPO'=> $_POST['tipo'],
                'TELEFONO'=> $_POST['cel'],
                'CINIT'=> $_POST['ci']
            ];
            $model->create($data);
            $data['ID'] = $model->getClienteByCi( $data['CINIT'])['ID'];

            echo json_encode($data);
        }
    }
?>
