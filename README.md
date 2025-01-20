# Proyecto API en PHP

Este proyecto es una API simple construida en PHP que simula la gestión de productos.
La API permite realizar operaciones CRUD (Crear, Leer, Actualizar, Eliminar) sobre los productos.

## Requisitos

- Docker

## Instalación

1. Clona el repositorio a tu máquina local:
   `git clone https://github.com/hmpetrone/decampoacampo-challenge.git`

2. Accede al directorio del proyecto:
   `cd decampoacampo-challenge` (o el nombre que hayas elegido)

3. Crear un archivo .env con las siguientes variables:
    ```
    DB_HOST=mysql-db
    DB_USER=root
    DB_PASS=root
    DB_NAME=challenge_db
    PRECIO_USD=350.50 -- cambia este valor para transformar los precios en dólares
    ```

## Uso con Docker

Asegúrate de tener Docker y Docker Compose instalados.

Para poder ejecutar el Docker Compose, necesitas tener instalados los siguientes componentes:

1. **Docker**: Puedes descargarlo desde [aquí](https://www.docker.com/get-started).
2. **Docker Compose**: Docker Compose debería instalarse automáticamente con Docker, pero si necesitas instalarlo de manera independiente, puedes seguir las instrucciones [aquí](https://docs.docker.com/compose/install/).

Una vez que hayas instalado estos programas, podrás seguir los siguientes pasos para ejecutar el proyecto en un entorno Dockerizado.

1. Construye los contenedores:
   `docker-compose build`

2. Levanta los contenedores:
   `docker-compose up -d`

   Este comando iniciará los contenedores en segundo plano. La aplicación se ejecutará en `http://localhost:8000`.

3. Accede a la API a través de `http://localhost:8000`.

## Rutas disponibles

Las siguientes rutas están disponibles para interactuar con la API:

- `GET /productos` - Obtiene todos los productos.
- `POST /productos` - Crea un nuevo producto.
- `GET /productos/{id}` - Obtiene un producto específico.
- `PUT /productos/{id}` - Actualiza un producto existente.
- `DELETE /productos/{id}` - Borra un producto existente.

## Pruebas

Puedes probar la API utilizando herramientas como Postman o desde el proyecto frontend ubicado en el siguiente repositorio:

[Repositorio del frontend](https://github.com/hmpetrone/decampoacampo-challenge-front)

Este frontend se conecta directamente con la API y facilita la visualización y gestión de los productos.
