<?php
    class ClientModel extends Model{
        public function __construct()
        {
            parent::__construct();
        }

        public function initClient($idSession, $loginClient, $passwordClient){
            if (isset($loginClient) && isset($passwordClient)){
                $command = $this->db->prepare('
                    UPDATE clients
                    SET login_client=:login, password_client=:password
                    WHERE id_session=:sessionID
                ');
                $command->bindParam(':sessionID', $idSession);
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

    }

?>