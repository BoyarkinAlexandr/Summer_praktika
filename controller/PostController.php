<?php
    
    class PostController{
        protected $favoritModel;

        public function __construct()
        {
            $this->favoritModel = new FavouritesModel();
        }

        public function handleRequest($POSTarray){
            if(isset($POSTarray)){
                if(isset($POSTarray['action'])){
                    switch($POSTarray['action']){
                        case 'favorite':{
                            $this->favoritModel->getAllFavourites();
                        }
                    }
                }
            }
        }
    }


?>