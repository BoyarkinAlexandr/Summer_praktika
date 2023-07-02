<?php
    
    class PostController{
        protected $favoritModel;
        protected $clientModel;
        protected $cartModel;

        public function __construct()
        {
            $this->favoritModel = new FavouritesModel();
            $this->clientModel = new ClientModel();
            $this->cartModel = new CartModel();
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
                        case 'add_cart': {
                            $userId = $_SESSION['id_client'];
                            $object = $this->cartModel->initToCartProduct($userId, $POSTarray['id_product'], $POSTarray['count_product']);
                            return json_encode($object);
                            exit();
                        }
                        case 'update_cart':{
                            $userId = $_SESSION['id_client'];
                            $object = $this->cartModel->updateToCartProduct($userId, $POSTarray['id_product'], $POSTarray['count_product']);
                            return json_encode($object);
                            exit();
                        }
                    }
                }
            }
        }
    }


?>