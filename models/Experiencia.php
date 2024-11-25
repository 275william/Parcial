<?php
class Experiencia extends Conectar {
    public function get_experiencia() {
        $sql = "SELECT * FROM experiencia ORDER BY fecha_inicio DESC";
        $stmt = parent::getConexion()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_experiencia_by_id($id) {
        $sql = "SELECT * FROM experiencia WHERE id = ?";
        $stmt = parent::getConexion()->prepare($sql);
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insert_experiencia($empresa, $puesto, $fecha_inicio, $fecha_fin, $descripcion) {
        $sql = "INSERT INTO experiencia (empresa, puesto, fecha_inicio, fecha_fin, descripcion) VALUES (?, ?, ?, ?, ?)";
        $stmt = parent::getConexion()->prepare($sql);
        $stmt->bindValue(1, $empresa);
        $stmt->bindValue(2, $puesto);
        $stmt->bindValue(3, $fecha_inicio);
        $stmt->bindValue(4, $fecha_fin);
        $stmt->bindValue(5, $descripcion);
        return $stmt->execute();
    }

    public function update_experiencia($id, $empresa, $puesto, $fecha_inicio, $fecha_fin, $descripcion) {
        $sql = "UPDATE experiencia SET empresa = ?, puesto = ?, fecha_inicio = ?, fecha_fin = ?, descripcion = ? WHERE id = ?";
        $stmt = parent::getConexion()->prepare($sql);
        $stmt->bindValue(1, $empresa);
        $stmt->bindValue(2, $puesto);
        $stmt->bindValue(3, $fecha_inicio);
        $stmt->bindValue(4, $fecha_fin);
        $stmt->bindValue(5, $descripcion);
        $stmt->bindValue(6, $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function delete_experiencia($id) {
        $sql = "DELETE FROM experiencia WHERE id = ?";
        $stmt = parent::getConexion()->prepare($sql);
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>
