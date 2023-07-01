<?php

    class ProductModel extends Model{
        public function __construct()
        {
           parent::__construct();
        }

        public function getAllProducts(){
            try {
                $query = $this->db->query("SELECT * FROM product");
                return $query->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {echo $e->getMessage();}
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