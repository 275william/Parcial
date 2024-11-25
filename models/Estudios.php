<?php
class Estudios extends Conectar {
    public function get_estudios() {
        $sql = "SELECT * FROM estudios ORDER BY fecha_inicio DESC";
        $stmt = parent::getConexion()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_estudio_by_id($id) {
        $sql = "SELECT * FROM estudios WHERE id = ?";
        $stmt = parent::getConexion()->prepare($sql);
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insert_estudio($titulo, $institucion, $fecha_inicio, $fecha_fin, $descripcion) {
        $sql = "INSERT INTO estudios (titulo, institucion, fecha_inicio, fecha_fin, descripcion) VALUES (?, ?, ?, ?, ?)";
        $stmt = parent::getConexion()->prepare($sql);
        $stmt->bindValue(1, $titulo);
        $stmt->bindValue(2, $institucion);
        $stmt->bindValue(3, $fecha_inicio);
        $stmt->bindValue(4, $fecha_fin);
        $stmt->bindValue(5, $descripcion);
        return $stmt->execute();
    }

    public function update_estudio($id, $titulo, $institucion, $fecha_inicio, $fecha_fin, $descripcion) {
        $sql = "UPDATE estudios SET titulo = ?, institucion = ?, fecha_inicio = ?, fecha_fin = ?, descripcion = ? WHERE id = ?";
        $stmt = parent::getConexion()->prepare($sql);
        $stmt->bindValue(1, $titulo);
        $stmt->bindValue(2, $institucion);
        $stmt->bindValue(3, $fecha_inicio);
        $stmt->bindValue(4, $fecha_fin);
        $stmt->bindValue(5, $descripcion);
        $stmt->bindValue(6, $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function delete_estudio($id) {
        $sql = "DELETE FROM estudios WHERE id = ?";
        $stmt = parent::getConexion()->prepare($sql);
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>
