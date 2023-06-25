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

        public function addToFavorietes($clientId, $productId){
            try{
                $command = $this->db->prepare(`
                    DELETE FROM favourites
                    WHERE id_client=:clientId`);
                $command->bindParam(':clientId', $clientId);
                if ($command->execute()){
                    return array('result' => true, 'action' => 'delete');
                } else {
                    $command = $this->db->prepare(`
                    INSERT INTO favourites (id_client, id_product)
                    VALUES (:clientId, :productId)`);
                    $command->bindParam(':clientId', $clientId);
                    $command->bindParam(':clientId', $productId);
                    if ($command->execute()){
                        return array('result' => true, 'action' => 'update');
                    }
                }
                
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

        public function getFavouritesProduct($clientId){
            try{
                $command= $this->db->query("
                SELECT *
                FROM `favourites`
                WHERE 'id_client'=:clientId
                ");
                $command->bindParam(':clientId', $clientId);
                $command->execute();
                return $command->fetchAll(PDO::FETCH_ASSOC);
                
            } catch (PDOException $e) {echo $e->getMessage();}
        }

        public function getInitParamFavorietes($products, $favorietesProducts){
            if(!empty($favorietesProducts)){
                $index = 0;
                foreach($products as $product){
                    if($product['id_product'] == $favorietesProducts[$index]['id_product']){
                        $product['favourites'] = '1';
                        $index += 1;
                    } else {
                        $product['favourites'] = '';
                    }
                    array_shift($products);
                    array_pop($product);
                }
            } else {
                foreach($products as $product){
                    $product['favourites'] = '';
                    array_shift($products);
                    array_push($products, $product);
                }
            }
            return $products;
        }
    }