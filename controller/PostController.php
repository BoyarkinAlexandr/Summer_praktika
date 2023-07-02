<?php
    
    class PostController{
        protected $favoritModel;
        protected $clientModel;
        protected $cartModel;
        protected $productModel;

        public function __construct()
        {
            $this->favoritModel = new FavouritesModel();
            $this->clientModel = new ClientModel();
            $this->cartModel = new CartModel();
            $this->productModel = new ProductModel();
        }

        public function handleRequest($POSTarray){
            if(isset($POSTarray)){
                if(isset($POSTarray['action'])){
                    switch($POSTarray['action']){
                        case 'add_favourites':{
                            $userId = $_SESSION['id_client'];
                            $object = array(
                                'result_query' => $this->favoritModel->addToFavorietes($userId ,$POSTarray['id_product']),
                                'objects_products' => $this->productModel->getAllProducts($userId),
                            );
                            return json_encode($object);
                            exit();
                        }
                        case 'delete_favourites':{
                            $userId = $_SESSION['id_client'];
                            $object = array(
                                'result_query' => $this->favoritModel->deleteToFavorietes($userId ,$POSTarray['id_product']),
                                'objects_products' => $this->productModel->getAllProducts($userId),
                            );
                            return json_encode($object);
                            exit();
                        }
                        case 'add_cart': {
                            $userId = $_SESSION['id_client'];
                            $this->cartModel->initToCartProduct($userId, $POSTarray['id_product'], $POSTarray['count_product']);
                            $object = $this->productModel->getAllProducts($userId);
                            return json_encode($object);
                            exit();
                        }
                        case 'update_cart':{
                            $userId = $_SESSION['id_client'];
                            $this->cartModel->updateToCartProduct($userId, $POSTarray['id_product'], $POSTarray['count_product']);
                            $object = $this->productModel->getAllProducts($userId);
                            return json_encode($object);
                            exit();
                        }

                        case 'delete_all':{
                            $userId = $_SESSION['id_client'];
                            $this->cartModel->deleteAllProduct($userId);
                            $object = $this->productModel->getAllProducts($userId);
                            return json_encode($object);
                            exit();
                        }

                        case 'delete_by_id':{
                            $userId = $_SESSION['id_client'];
                            $this->cartModel->deleteProductById($userId, $POSTarray['id_product']);
                            $object = $this->productModel->getAllProducts($userId);
                            return json_encode($object);
                            exit();
                        }
                    }
                }
            }
        }
    }


?>