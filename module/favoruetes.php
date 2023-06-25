<?php

    class FavouritesModel extends Model{
        public function __construct()
        {
            parent::__construct();
        }

        public function getAllFavourites($idClient){
            try{
                $command = $this->db->prepare("
                SELECT `id_product`
                FROM `favourites`
                WHERE `id_client`=:idClient
                ORDER BY id_product DESC
                ");
                $command->bindParam(':idClient', $idClient);
                $command->execute();
                return $command->fetchAll(PDO::FETCH_ASSOC);
            } catch(PDOException $e) { echo $e->getMessage();}
            
        }
    }

?>