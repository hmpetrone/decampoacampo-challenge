<?php

class ProductValidator
{
    // validaciones basicas de producto
    public static function validate($nombre, $descripcion, $precio)
    {
        $errors = [];
        if (empty($nombre) || strlen($nombre) > 255) {
            $errors['nombre'] = 'El nombre no puede estar vacío o exceder los 255 caracteres';
        }

        if (empty($descripcion) || strlen($descripcion) > 255) {
            $errors['descripcion'] = 'La descripción no puede estar vacía o exceder los 255 caracteres';
        }

        if (!is_numeric($precio) || $precio <= 0) {
            $errors['precio'] = 'El precio debe ser un número válido y mayor a 0';
        }

        return $errors;
    }
}
