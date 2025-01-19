<?php

require_once BASE_PATH.'/config/Database.php';
class ProductRepository
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function getAll(): array
    {
        $stmt = $this->db->prepare('
            SELECT 
                id, 
                nombre,
                descripcion,
                precio AS precio_pesos, 
                precio / ? AS precio_usd 
            FROM productos
        ');
        $precioUsd = getenv('PRECIO_USD');
        $stmt->bind_param('d', $precioUsd);
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getById(int $id): ?array
    {
        $stmt = $this->db->prepare('
            SELECT 
                id, 
                nombre,
                descripcion,
                precio AS precio_pesos, 
                precio / ? AS precio_usd 
            FROM productos 
            WHERE id = ?
        ');
        $precioUsd = getenv('PRECIO_USD');
        $stmt->bind_param('di', $precioUsd, $id);
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->fetch_assoc() ?: null;
    }

    public function create(string $nombre, string $descripcion, float $precio): bool
    {
        try {
            $stmt = $this->db->prepare('
                INSERT INTO productos (nombre, descripcion, precio) 
                VALUES (?, ?, ?)
            ');
            $stmt->bind_param('ssd', $nombre, $descripcion, $precio);
            return $stmt->execute();
        } catch (Exception $e) {
            error_log('Error al insertar producto: ' . $e->getMessage());
            return false;
        }
    }

    public function update(int $id, string $nombre, string $descripcion, float $precio): bool
    {
        try {
            $stmt = $this->db->prepare('
                UPDATE productos
                SET nombre = ?, descripcion = ?, precio = ?
                WHERE id = ?
            ');
            $stmt->bind_param('ssdi', $nombre, $descripcion, $precio, $id);
            return $stmt->execute();
        } catch (Exception $e) {
            error_log('Error al actualizar producto: ' . $e->getMessage());
            return false;
        }
    }

    public function delete(int $id): bool
    {
        try {
            $stmt = $this->db->prepare('
                DELETE FROM productos WHERE id = ?
            ');
            $stmt->bind_param('i', $id);
            return $stmt->execute();
        } catch (Exception $e) {
            error_log('Error al eliminar producto: ' . $e->getMessage());
            return false;
        }
    }

}
