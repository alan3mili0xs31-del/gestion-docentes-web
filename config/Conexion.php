<?php

// Aqui usando el patron singleton juas juas
class Conexion
{
    private static $conexion = null;

    public static function conectar()
    {
        if (self::$conexion == null) {

            try {

                self::$conexion = new PDO(
                    "mysql:host=localhost;dbname=gestion_docentes_db;charset=utf8",
                    "root",
                    ""
                );

                self::$conexion->setAttribute(
                    PDO::ATTR_ERRMODE,
                    PDO::ERRMODE_EXCEPTION
                );

                self::$conexion->setAttribute(
                    PDO::ATTR_DEFAULT_FETCH_MODE,
                    PDO::FETCH_ASSOC
                );

            } catch (PDOException $e) {

                die("Error de conexión: " . $e->getMessage());

            }
        }

        return self::$conexion;
    }
}
