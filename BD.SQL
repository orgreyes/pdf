CREATE TABLE clientes (
    cliente_id SERIAL NOT NULL,
    cliente_nombre CHAR (75) NOT NULL,
    cliente_situacion SMALLINT NOT NULL DEFAULT 1,
    PRIMARY KEY (cliente_id)
);

CREATE TABLE productos (
    producto_id SERIAL NOT NULL,
    producto_nombre CHAR (100),
    producto_precio INT NOT NULL,
    producto_situacion SMALLINT NOT NULL DEFAULT 1,
    PRIMARY KEY (producto_id)
);

CREATE TABLE ventas (
    venta_id SERIAL NOT NULL,
    venta_cliente INT NOT NULL,
    venta_fecha DATETIME YEAR TO DAY NOT NULL,
    venta_situacion SMALLINT NOT NULL DEFAULT 1,
    PRIMARY KEY (venta_id),
    FOREIGN KEY (venta_cliente) REFERENCES clientes (cliente_id)
);

CREATE TABLE detalle_ventas (
    detalle_id SERIAL NOT NULL,
    detalle_venta INT NOT NULL,
    detalle_producto INT NOT NULL,
    detalle_cantidad INT NOT NULL,
    detalle_situacion SMALLINT NOT NULL DEFAULT 1,
    PRIMARY KEY (detalle_id),
    FOREIGN KEY (detalle_venta) REFERENCES ventas (venta_id),
    FOREIGN KEY (detalle_producto) REFERENCES productos (producto_id)
);


INSERT INTO clientes (cliente_nombre)
VALUES
    ('Cliente 1');
    INSERT INTO clientes (cliente_nombre)
VALUES
    ('Cliente 2');
    INSERT INTO clientes (cliente_nombre)
VALUES
    ('Cliente 3');
    INSERT INTO clientes (cliente_nombre)
VALUES
    ('Cliente 4');
    INSERT INTO clientes (cliente_nombre)
VALUES
    ('Cliente 5');


INSERT INTO productos (producto_nombre, producto_precio)
VALUES
    ('Producto A', 100);
    INSERT INTO productos (producto_nombre, producto_precio)
VALUES
    ('Producto B', 50);
    INSERT INTO productos (producto_nombre, producto_precio)
VALUES
    ('Producto C', 75);
    INSERT INTO productos (producto_nombre, producto_precio)
VALUES
    ('Producto D', 120);
    INSERT INTO productos (producto_nombre, producto_precio)
VALUES
    ('Producto E', 80);


INSERT INTO ventas (venta_cliente, venta_fecha)
VALUES
    (1, '2023-09-17');
    INSERT INTO ventas (venta_cliente, venta_fecha)
VALUES
    (2, '2023-09-18');
    INSERT INTO ventas (venta_cliente, venta_fecha)
VALUES
    (3, '2023-09-19');
    INSERT INTO ventas (venta_cliente, venta_fecha)
VALUES
    (4, '2023-09-20');
    INSERT INTO ventas (venta_cliente, venta_fecha)
VALUES
    (5, '2023-09-21');


    INSERT INTO detalle_ventas (detalle_venta, detalle_producto, detalle_cantidad)
VALUES
    (1, 1, 3);
        INSERT INTO detalle_ventas (detalle_venta, detalle_producto, detalle_cantidad)
VALUES
    (1, 2, 2);
        INSERT INTO detalle_ventas (detalle_venta, detalle_producto, detalle_cantidad)
VALUES
    (2, 3, 1);
        INSERT INTO detalle_ventas (detalle_venta, detalle_producto, detalle_cantidad)
VALUES
    (3, 4, 4);
        INSERT INTO detalle_ventas (detalle_venta, detalle_producto, detalle_cantidad)
VALUES
    (4, 5, 2);

