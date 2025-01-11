<?php
    class Core{
        protected $controllerCurrent;
        protected $methodCurrent;
        protected $param = [];

        public function __construct(){
            $this->controllerCurrent = 'Login';
            $this->methodCurrent = 'index';
            $url = $this->getUrl();
            if(isset($url[0])){
                $file = '../app/controller/'.$url[0].'Controller.php';
                if (file_exists($file)){
                    $this->controllerCurrent = $url[0];
                    unset($url[0]);
                }
            }

            require_once '../app/controller/'.ucwords($this->controllerCurrent).'Controller.php';

            $this->controllerCurrent = new $this->controllerCurrent();

            if( isset($url[1])){
                if (method_exists($this->controllerCurrent, $url[1])){
                    $this->methodCurrent = $url[1];
                    unset($url[1]);
                }
            }
            $this->param = $url ? array_values($url) : [];

            call_user_func([$this->controllerCurrent, $this->methodCurrent], $this->param);
        }
        
        public function getUrl(){
            if(isset($_GET['url'])){
                $url = rtrim($_GET['url'],'/');
                $url = filter_var($url, FILTER_SANITIZE_URL);
                $url = explode('/', $url);
                return $url;
            }
        }
    }
?>