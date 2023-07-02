<?php

    class ProductModel extends Model{
        public function __construct()
        {
           parent::__construct();
        }

        public function getAllProducts($userId){
            $command = $this->db->prepare('
                SELECT COALESCE(cart.count_product, NULL) AS count_product, product.*, COALESCE(favourites.id_product, NULL) AS is_favourites
                FROM product
                LEFT JOIN cart ON product.id_product = cart.id_product AND cart.id_client = :userId
                LEFT JOIN favourites ON product.id_product = favourites.id_product AND favourites.id_client = :userId
                ORDER BY product.id_product;');
            $command->bindParam(':userId', $userId);
            $command->execute();
            return $command->fetchAll(PDO::FETCH_ASSOC);
        }
        
        public function getProductsWithLimit($limit){
            try {
                $query = $this->db->query("
                SELECT * 
                FROM `product` 
                LIMIT $limit");
                return $query->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {echo $e->getMessage();}
        }

        public function getProductsWithLimitPeriod($Startlimit, $EndLimit){
            try {
                $query = $this->db->query("
                SELECT * 
                FROM `product` 
                LIMIT $Startlimit,$EndLimit");
                return $query->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {echo $e->getMessage();}
        }

        public function getCountProducts(){
            try {
                $query = $this->db->query("
                SELECT COUNT(*) 
                FROM `product`");
                return (int)$query->fetchAll(PDO::FETCH_BOTH)[0][0];
            } catch (PDOException $e) {echo $e->getMessage();}
        }

        public function getInitParamFavorietes($products, $favorietesProducts){
            if (!empty($favorietesProducts)) {
                foreach ($products as &$product) {
                    $found = false;
                    foreach ($favorietesProducts as $favoriteProduct) {
                        if ($product['id_product'] == $favoriteProduct['id_product']) {
                            $product['favourites'] = '1';
                            $found = true;
                            break;
                        }
                    }
                    if (!$found) {
                        $product['favourites'] = '';
                    }
                }
            } else {
                foreach ($products as &$product) {
                    $product['favourites'] = '';
                }
            }

            return $products;
        }


    }