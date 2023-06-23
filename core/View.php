<?php
    class View{
        public function render($data, $view, $footer=true){
            extract($data);
            require_once('./view/header.php');
            require_once($view);
            if($footer)
                require_once('./view/footer.php');
        }
    }

?>