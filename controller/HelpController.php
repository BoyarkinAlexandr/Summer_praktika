<?php
    class HelpController{
        protected $View;

        public function __construct()
        {   
            $this->View = new View();
        }

        public function Action(){
            $view = './view/help.php';
            $this->View->render(array(), $view);
        }
    }

?>