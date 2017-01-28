SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


-- Base de datos: 'kiosco'

-- Volcar la base de datos para la tabla 'articulo'

INSERT INTO articulo VALUES (1, 1, 1, 'Diario de Cadiz - L', 0, 0.5, 0.61, 1, '');
INSERT INTO articulo VALUES (2, 1, 1, 'Viva Cadiz - L', 0, 0.5, 0.61, 0.9, '');
INSERT INTO articulo VALUES (3, 1, 1, 'Bahia de Cadiz', 0, 0.75, 0.915, 1.2, '');
INSERT INTO articulo VALUES (4, 4, 2, 'Fortuna 24 Azul Duro', 0, 4, 4.07, 4.25, '');
INSERT INTO articulo VALUES (5, 4, 2, 'Fortuna 24 Rojo Duro', 8, 4, 4.07, 4.25, '');
INSERT INTO articulo VALUES (6, 4, 2, 'Camel Activa', 0, 3.45, 3.51038, 3.95, '');
INSERT INTO articulo VALUES (7, 1, 1, 'Guia Silver-Star ', 0, 10, 12.2, 14.9, 'Limitada');
INSERT INTO articulo VALUES (8, 2, 3, 'Bonobus 10 viajes', 2, 9, 9.81, 10, 'Urbano');
INSERT INTO articulo VALUES (9, 2, 3, 'Bonobus 20 viajes', 0, 16, 17.44, 18, 'Urbano');


-- Volcar la base de datos para la tabla 'art_com'

INSERT INTO art_com VALUES (3, 1, 1);
INSERT INTO art_com VALUES (9, 2, 1);
INSERT INTO art_com VALUES (7, 2, 1);
INSERT INTO art_com VALUES (6, 2, 1);
INSERT INTO art_com VALUES (5, 3, 1);
INSERT INTO art_com VALUES (5, 4, 2);
INSERT INTO art_com VALUES (7, 5, 1);
INSERT INTO art_com VALUES (8, 5, 1);
INSERT INTO art_com VALUES (5, 5, 1);
INSERT INTO art_com VALUES (7, 6, 1);
INSERT INTO art_com VALUES (9, 6, 3);
INSERT INTO art_com VALUES (9, 1, 1);
INSERT INTO art_com VALUES (8, 7, 2);


-- Volcar la base de datos para la tabla 'art_dep'

INSERT INTO art_dep VALUES (1, 1, 10, 10, 0, 10);
INSERT INTO art_dep VALUES (2, 1, 10, 5, 0, 5);
INSERT INTO art_dep VALUES (3, 1, 1, 1, 1, 0);
INSERT INTO art_dep VALUES (4, 2, 10, 0, 0, 0);
INSERT INTO art_dep VALUES (5, 2, 10, 12, 4, 0);
INSERT INTO art_dep VALUES (6, 2, 1, 1, 1, 0);
INSERT INTO art_dep VALUES (7, 3, 3, 3, 3, 0);
INSERT INTO art_dep VALUES (8, 4, 5, 5, 3, 0);
INSERT INTO art_dep VALUES (9, 4, 5, 5, 5, 0);


-- Volcar la base de datos para la tabla 'cliente'

INSERT INTO cliente VALUES (2, '15443090Q', 'Juan Antonio Espinosa', 'Calle Tierra N52', '679939948', 'gm.mizuki@gmail.com', '');
INSERT INTO cliente VALUES (3, '75799919S', 'Cristina', 'C/ Conil 9', '676834237', '', '');
INSERT INTO cliente VALUES (4, '88888888B', 'Emily Evans', 'Av. Real N128', '999888777', 'emili_evans@mail.com', 'VIP');
INSERT INTO cliente VALUES (5, '27478462X', 'Pepe Perez', 'C/ Falsa 123', '', '', '');


-- Volcar la base de datos para la tabla 'compra'

INSERT INTO compra VALUES (1, 1, '2012-05-21 11:21:42', 19.2, '');
INSERT INTO compra VALUES (2, 2, '2012-05-21 12:17:38', 45.85, '');
INSERT INTO compra VALUES (3, 5, '2012-05-21 12:19:46', 4.25, 'Fiado');
INSERT INTO compra VALUES (4, 1, '2012-05-21 17:23:28', 8.5, '');
INSERT INTO compra VALUES (5, 3, '2012-05-21 17:24:05', 29.15, '');
INSERT INTO compra VALUES (6, 4, '2012-05-21 17:25:07', 68.9, '');
INSERT INTO compra VALUES (7, 1, '2012-05-21 19:19:19', 20, '');


-- Volcar la base de datos para la tabla 'deposito'

INSERT INTO deposito VALUES (1, 1, 0.915, 3, '2012-05-20 21:33:19', '2012-05-21 06:01:27', '2012-05-21 23:59:59', '');
INSERT INTO deposito VALUES (2, 2, 52.3504, 5, '2012-05-20 21:35:35', '2012-05-21 06:07:08', '0000-00-00 00:00:00', 'Cigarrillos');
INSERT INTO deposito VALUES (3, 1, 36.6, 3, '2012-05-20 21:38:21', '2012-05-21 06:01:55', '2012-05-21 23:59:59', '');
INSERT INTO deposito VALUES (4, 3, 136.25, 5, '2012-05-20 21:39:34', '2012-05-21 06:17:21', NULL, '');


-- Volcar la base de datos para la tabla 'proveedor'

INSERT INTO proveedor VALUES (1, 'A12345678', 'La Voz de Cadiz', 'Cadiz', '956240900', '', '');
INSERT INTO proveedor VALUES (2, 'B87654321', 'Ghost Smoky', 'Sevilla', '666000999', 'mail@falso.es', 'Tabacalera');
INSERT INTO proveedor VALUES (3, 'D27478482', 'La Union', 'Madrid, Plaza Grande N1', '987654321', 'la@union.com', '');