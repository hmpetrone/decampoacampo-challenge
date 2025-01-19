<?php

class Product
{
    public $id;
    public $nombre;
    public $descripcion;
    public $precio_pesos;
    public $precio_usd;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? null;
        $this->nombre = $data['nombre'];
        $this->descripcion = $data['descripcion'];
        $this->precio_pesos = $data['precio_pesos'];
        $this->precio_usd = $data['precio_usd'];
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function getDescripcion(): string
    {
        return $this->descripcion;
    }

    public function getPrecioPesos(): float
    {
        return $this->precio_pesos;
    }

    public function getPrecioUsd(): float
    {
        return $this->precio_usd;
    }

    public function toJson(): string
    {
        return json_encode($this);
    }
}
