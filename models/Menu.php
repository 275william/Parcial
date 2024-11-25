<?php
class Menu extends Conectar {
    public function get_menu() {
        $sql = "SELECT * FROM menu";
        $stmt = parent::getConexion()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_menu_by_id($id) {
        $sql = "SELECT * FROM menu WHERE id = ?";
        $stmt = parent::getConexion()->prepare($sql);
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insert_menu($opcion, $url) {
        $sql = "INSERT INTO menu (opcion, url) VALUES (?, ?)";
        $stmt = parent::getConexion()->prepare($sql);
        $stmt->bindValue(1, $opcion);
        $stmt->bindValue(2, $url);
        return $stmt->execute();
    }

    public function update_menu($id, $opcion, $url) {
        $sql = "UPDATE menu SET opcion = ?, url = ? WHERE id = ?";
        $stmt = parent::getConexion()->prepare($sql);
        $stmt->bindValue(1, $opcion);
        $stmt->bindValue(2, $url);
        $stmt->bindValue(3, $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function delete_menu($id) {
        $sql = "DELETE FROM menu WHERE id = ?";
        $stmt = parent::getConexion()->prepare($sql);
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>
