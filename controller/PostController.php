<?php
    
    class PostController{
        protected $favoritModel;
        protected $clientModel;

        public function __construct()
        {
            $this->favoritModel = new FavouritesModel();
            $this->clientModel = new ClientModel();
        }

        public function handleRequest($POSTarray){
            if(isset($POSTarray)){
                if(isset($POSTarray['action'])){
                    switch($POSTarray['action']){
                        case 'add_favourites':{
                            $userId = $this->clientModel->getClientId($_SESSION['id_session']);
                            $object = array(
                                'result_query' => $this->favoritModel->addToFavorietes($userId ,$POSTarray['id_product']),
                                'objects_products' => $this->favoritModel->getFavofProducts($userId),
                            );
                            return json_encode($object);
                            exit();
                        }
                        case 'delete_favourites':{
                            $userId = $this->clientModel->getClientId($_SESSION['id_session']);
                            $object = array(
                                'result_query' => $this->favoritModel->deleteToFavorietes($userId ,$POSTarray['id_product']),
                                'objects_products' => $this->favoritModel->getFavofProducts($userId),
                            );
                            return json_encode($object);
                            exit();
                        }
                    }
                }
            }
        }
    }


?>