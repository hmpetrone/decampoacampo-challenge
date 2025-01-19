<?php
// Clase para conectar a la base de datos
class Database
{
    private static $connection;

    public static function getConnection()
    {
        if (!self::$connection) {
            try {
                self::$connection = new mysqli(
                    getenv('DB_HOST'),
                    getenv('DB_USER'),
                    getenv('DB_PASS'),
                    getenv('DB_NAME')
                );

                if (self::$connection->connect_error) {
                    throw new Exception('Error de conexión: ' . self::$connection->connect_error);
                }
            } catch (Exception $e) {
                die('Error de conexión: ' . $e->getMessage());
            }
        }
        return self::$connection;
    }
}
