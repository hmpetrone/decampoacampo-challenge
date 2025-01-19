<?php

require_once BASE_PATH.'/config/Database.php';
require_once BASE_PATH.'/app/models/Product.php';
require_once BASE_PATH.'/app/repositories/ProductRepository.php';

class ProductController
{
    private $repository;

    public function __construct()
    {
        $this->repository = new ProductRepository();
    }

    public function index()
    {
        $products = $this->repository->getAll();
        echo json_encode($products);
    }

    public function show($id)
    {
        $product =  $this->repository->getById($id);
        if ($product) {
            echo json_encode($product);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Producto no encontrado']);
        }
    }

    public function create()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $errors = ProductValidator::validate($data['nombre'], $data['descripcion'], $data['precio']);

        if (!empty($errors)) {
            http_response_code(400);
            echo json_encode(['errors' => $errors]);
            return;
        }

        $nombre = $data['nombre'];
        $descripcion = $data['descripcion'];
        $precio = $data['precio'];
        if ($this->repository->create($nombre, $descripcion, $precio)) {
            echo json_encode(['success' => 'Producto creado']);
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'Error al crear producto']);
        }
    }

    public function update($id)
    {
        $exist = $this->repository->getById($id);
        if (!$exist) {
            http_response_code(404);
            echo json_encode(['error' => 'Producto no encontrado']);
            return;
        }
        $data = json_decode(file_get_contents('php://input'), true);
        $errors = ProductValidator::validate($data['nombre'], $data['descripcion'], $data['precio']);

        if (!empty($errors)) {
            http_response_code(400);
            echo json_encode(['errors' => $errors]);
            return;
        }
        $nombre = $data['nombre'];
        $descripcion = $data['descripcion'];
        $precio = $data['precio'];
        if ($this->repository->update($id, $nombre, $descripcion, $precio)) {
            echo json_encode(['success' => 'Producto actualizado']);
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'Error al actualizar producto']);
        }
    }

    public function delete($id)
    {
        $exist = $this->repository->getById($id);
        if (!$exist) {
            http_response_code(404);
            echo json_encode(['error' => 'Producto no encontrado']);
            return;
        }
        if ($this->repository->delete($id)) {
            echo json_encode(['success' => 'Producto eliminado']);
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'Error al eliminar producto']);
        }
    }


}
