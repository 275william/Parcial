<?php 
    class SocialMedia extends Conectar{
        public function get_socialMedia(){
            $social = parent::getConexion();
            parent::set_names();
            $sql = "SELECT * FROM socialmedia WHERE est = 1";
            $sql=$social->prepare($sql);
            $sql->execute();
            return  $sql->fetchAll(PDO::FETCH_ASSOC);

        }

        public function get_socialMediaxid($socmed_id) {
            $social = parent::getConexion();
            parent::set_names();
            
            $sql = "SELECT * FROM socialmedia WHERE socmed_id = ?";
            $stmt = $social->prepare($sql);
            $stmt->bindValue(1, $socmed_id);
            $stmt->execute();
            
            return $stmt->fetch(PDO::FETCH_ASSOC); // Retorna un único registro como array asociativo
        }
        

        public function insert_socialMedia($socmed_icono, $socmed_url) {
            $social = parent::getConexion();
            parent::set_names();
        
            $sql = "INSERT INTO socialmedia (socmed_icono, socmed_url, est) VALUES (?, ?, 1)";
            $stmt = $social->prepare($sql);
            $stmt->bindValue(1, $socmed_icono);
            $stmt->bindValue(2, $socmed_url);
        
            return $stmt->execute(); // Retorna true si la inserción fue exitosa
        }
        
        public function update_socialMedia($socmed_id, $socmed_icono, $socmed_url) {
            $social = parent::getConexion();
            parent::set_names();
        
            $sql = "UPDATE socialmedia SET socmed_icono=?, socmed_url=? WHERE socmed_id=?";
            $stmt = $social->prepare($sql);
            $stmt->bindValue(1, $socmed_icono);
            $stmt->bindValue(2, $socmed_url);
            $stmt->bindValue(3, $socmed_id);
        
            return $stmt->execute(); // Retorna true si la actualización fue exitosa
        }
        
        public function delete_socialMedia($socmed_id){
            // Obtiene la conexión
            $social = parent::getConexion();
            parent::set_names();
        
            $sql = "UPDATE socialmedia 
                    SET est=0 
                    WHERE socmed_id=?";
        
            $sql = $social->prepare($sql);
        
            $sql->bindValue(1, $socmed_id, PDO::PARAM_INT);
        
            $sql->execute();

            if ($sql->rowCount() > 0) {
                return 'success';
            }else{
                return 'error';
            }
        }
        
    }
?>
