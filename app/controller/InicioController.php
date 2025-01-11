<?php
    class Inicio extends Controller{
        public function index(){
            $model = $this->model('Tela');
            $telas = $model->view();
            foreach ($telas as &$row) {
                $row['rollos'] = $model->getInfoRollos($row['CODTELA']);
            }
            $this->view('Inicio',$telas);
        }
    }
?>