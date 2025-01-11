<?php
    class Controller {
        public function model($model_name){
            require_once '../app/model/'.$model_name.'Model.php';
            $Objmodel = $model_name. 'Model';
            return new $Objmodel();
        }

        public function view($view_name, $datos = [], $datos2 = [],$msg = []){
            if ( file_exists('../app/view/'.$view_name.'View.php'))
                require_once '../app/view/'.$view_name.'View.php';
            else
                die ('404 - NOT FOUND'); 
        }
        public function messageUpdate(){
            error_reporting(0);
            session_start();
            
            $_SESSION['title'] = 'MODIFICADO';
            $_SESSION['msg'] = 'Datos actualizados';
        }

        public function messageDelete(){
            error_reporting(0);
            session_start();
            $_SESSION['title'] = 'ELIMINADO';
            $_SESSION['msg'] = 'Datos eliminados correctamente';
        }

        public function messageNoDelete(){
            error_reporting(0);
            session_start();
            $_SESSION['icon'] = 'error';
            $_SESSION['title'] = 'ERROR';
            $_SESSION['msg'] = 'La información forma parte de registro, no puede ser eliminado';
        }
    }

?>
