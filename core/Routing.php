<?php
    function SPLIT(){
        if(!empty($_GET)){
            $key = array_keys($_GET)[0];
            return explode('/', $_GET[$key]);
        } else {
            return array(0 => 'main');
        }
    }
    $SPLIT = SPLIT();
?>