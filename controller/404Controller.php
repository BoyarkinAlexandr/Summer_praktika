<?php 
    class ErrorController{
        public function Action(){
            $viewClass = new View();
            $view = './view/404.php';
            $data = array();

            $viewClass->render($data, $view, false);
        }
    }