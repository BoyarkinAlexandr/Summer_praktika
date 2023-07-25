<?php
    class ClientModel extends Model{
        public function __construct()
        {
            parent::__construct();
        }

        public function enterAtCab($loginClient, $passwordClient){
            if (isset($loginClient) && isset($passwordClient)){
                $command = $this->db->prepare("
                    SELECT *
                    FROM clients
                    WHERE login_client=:login AND password_client=:password
                ");
                $command->bindParam(':login', $loginClient);
                $command->bindParam(':password', $passwordClient);

                if ($command->execute()){
                    return true;
                } else {
                    return false;
                }
            }
            return false;
        }

        public function addLoginAndPassword($idClient, $loginClient, $passwordClient){
            if (isset($loginClient) && isset($passwordClient)){
                $command = $this->db->prepare("
                    UPDATE clients
                    SET login_client=:login, password_client=:password
                    WHERE id_client=:idClient
                ");
                $command->bindParam(':idClient', $idClient);
                $command->bindParam(':login', $loginClient);
                $command->bindParam(':password', $passwordClient);

                if ($command->execute()){
                    return true;
                } else {
                    return false;
                }
            }
            return false;
        }

        public function initClientSession($idSession){
            $command = $this->db->prepare('
                INSERT INTO clients(id_session)
                VALUES(:sessionID)
            ');
            $command->bindParam(':sessionID', $idSession);
            if ($command->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function getClientId($idSession){
            $command = $this->db->prepare('
                SELECT id_client
                FROM clients
                WHERE id_session=:sessionID');
            $command->bindParam(':sessionID', $idSession);
            $command->execute();
            return $command->fetchColumn();
        }

    }

?>