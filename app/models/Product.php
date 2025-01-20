<?php

class Product
{
    public $id;
    public $nombre;
    public $descripcion;
    private $precio_pesos;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? null;
        $this->nombre = $data['nombre'];
        $this->descripcion = $data['descripcion'];
        $this->precio_pesos = $data['precio'];
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
        return round($this->precio_pesos, 2);
    }

    public function getPrecioUsd(): float
    {
        $precioUsd = getenv('PRECIO_USD');
        return round($this->precio_pesos / $precioUsd, 2);
    }

    public function toJson(): string
    {
        return json_encode([
            'id' => $this->id,
            'nombre' => $this->getNombre(),
            'descripcion' => $this->getDescripcion(),
            'precio_pesos' => $this->getPrecioPesos(),
            'precio_usd' => $this->getPrecioUsd(),
        ]);
    }
}
