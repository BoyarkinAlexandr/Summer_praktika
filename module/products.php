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
                return false;
                
            } catch (PDOException $e) {echo $e->getMessage();}
        }
    }