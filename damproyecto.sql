-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-06-2020 a las 17:29:07
-- Versión del servidor: 10.1.9-MariaDB
-- Versión de PHP: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `damproyecto`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `pr_altaAdmins` (IN `p_CodAdmin` CHAR(6), IN `p_usuario` VARCHAR(50), IN `p_rango` CHAR(2), IN `p_pswd` VARCHAR(16), OUT `p_salida` TINYINT)  NO SQL
BEGIN
	SET @existe=(SELECT COUNT(*) FROM administradores Where CodAdmin Like 			p_CodAdmin OR 	Usuario LIKE p_pswd);
    IF @existe<>0 THEN
    	Set @salida=-1;
    ELSE
    	INSERT INTO administradores (CodAdmin, Usuario,password,Rango)
        VALUES(p_CodAdmin,p_usuario,p_pswd,p_rango);
          Set p_salida=0;
    END IF;
        
End$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pr_altaCategoria` (IN `p_CodCategoria` CHAR(3), IN `p_Categoria` VARCHAR(50), OUT `p_salida` INT)  NO SQL
BEGIN
	INSERT INTO categorias(CodCategoria,Categoria) VALUES (p_CodCategoria, p_Categoria);
    SET p_salida=0;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pr_altaCliente` (IN `p_Username` VARCHAR(25), IN `p_pswd` VARCHAR(16), IN `p_nombre` VARCHAR(25), IN `p_apellidos` VARCHAR(100), IN `p_email` VARCHAR(100), IN `p_sexo` BIT, IN `p_tel` CHAR(9), IN `p_dni` CHAR(9), IN `p_direc` VARCHAR(300), OUT `p_salida` SMALLINT)  NO SQL
BEGIN
	INSERT INTO clientes (codigo, Username, password, nombre, 						apellidos, email, sexo, telefono, dni, direccion,	fechaAlta, saldo)
        VALUES(NULL,p_Username, p_pswd, p_nombre, p_apellidos, p_email, p_sexo, p_tel, p_dni,p_direc, CURDATE() , 100);
          Set @p_salida=0; 
End$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pr_altaProdutos` (IN `p_Nombre` VARCHAR(50), IN `p_Descripcion` VARCHAR(500), IN `p_PrecioUnitario` DECIMAL(5,2), IN `p_Categoria` CHAR(3), IN `p_SubCategoria` CHAR(3), IN `p_Stock` INT, OUT `P_salida` INT)  NO SQL
BEGIN
	INSERT Into productos (Idproducto, Nombre, Descripcion, PrecioUnitario, Categoria, SubCategoria, Stock) VALUES (NULL, p_Nombre, p_Descripcion, p_PrecioUnitario, p_Categoria, p_SubCategoria, p_Stock);
    SET p_salida=0;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pr_BuscarAdmin` (IN `p_Usuario` VARCHAR(50), IN `p_Pswd` VARCHAR(16))  NO SQL
BEGIN
	SELECT  CodAdmin, Rango FROM administradores WHERE Usuario LIKE p_Usuario AND password LIKE p_Pswd;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pr_BuscarCategorias` ()  NO SQL
BEGIN 
	SELECT CodCategoria, Categoria FROM categorias;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pr_BuscarCliente` (IN `p_Username` VARCHAR(25), IN `p_Pswd` VARCHAR(16))  NO SQL
BEGIN
	Select codigo FROM clientes WHERE Username like p_Username and password Like p_Pswd ;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pr_BuscarProductos` ()  NO SQL
BEGIN
	SELECT IdProducto, Nombre, Descripcion, PrecioUnitario,c.Categoria as Categoria,p.Categoria as CCAt, SC.Categoria as SubCategoria, p.SubCategoria as CSCAt,Stock, Imagen
    FROM productos as p
    JOIN  categorias as c 
    on p.Categoria=c.CodCategoria 
    JOIN categorias as SC
    on p.SubCategoria=SC.CodCategoria;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pr_BuscarVentas` ()  NO SQL
BEGIN
	SELECT CodVenta, c.Username as Cliente, PrecioTotal, FechaCompra
    FROM ventas as v
    JOIN clientes as c
    ON v.CodCliente=c.codigo;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pr_Clientes` ()  NO SQL
BEGIN
	SELECT * from clientes;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pr_DetalleVenta` (IN `p_CodVenta` INT)  NO SQL
BEGIN
	SELECT CodVenta, p.Nombre as Producto, Cantidad,p.PrecioUnitario as PrecioUnitario, (p.PrecioUnitario*Cantidad) as TotalPorProducto
    FROM detalleventas as dv
    JOIN productos as p
    on p.IdProducto=dv.CodProducto
    WHERE CodVenta= p_CodVenta;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pr_MaxCodVenta` ()  NO SQL
BEGIN
SELECT MAX(CodVenta)as CodVenta from ventas;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pr_SelectAdmins` ()  NO SQL
BEGIN
    SELECT CodAdmin,Usuario,rango,password
    FROM administradores;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pr_MasVentas` (IN `p_codCliente` INT, IN `p_producto` INT, IN `p_CodVenta` INT)  NO SQL
BEGIN 
	
    SET @precio=(SELECT PrecioUnitario From productos 
    where IdProducto=p_producto);
    
    SET @saldo=(SELECT Saldo From clientes where Codigo=p_codCliente);
    
    SET @SCK=(SELECT Stock From productos where IdProducto=p_producto);
	
    UPDATE Ventas Set PrecioTotal=PrecioTotal+@precio
            WHERE CodVenta=p_CodVenta;

            UPDATE clientes  SET saldo=saldo-@precio 
            where codigo=p_codCliente;

            INSERT Into detalleventas (CodVenta, CodProducto,Cantidad)
            VALUES (p_CodVenta,p_producto,1);

            UPDATE productos SET Stock=Stock-1 
            WHERE IdProducto = p_producto;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pr_updateAdmin` (IN `p_codAdmin` CHAR(6), IN `p_usuario` VARCHAR(50), IN `p_Rango` CHAR(2), IN `p_password` VARCHAR(16))  NO SQL
BEGIN
    UPDATE administradores
    SET usuario=p_usuario,rango=p_Rango,password=p_p_password
    WHERE CodAdmin=p_codAdmin;
End$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pr_updateCliente` (IN `p_Codigo` INT, IN `p_Username` VARCHAR(25), IN `p_psd` VARCHAR(16), IN `p_nombre` VARCHAR(25), IN `p_apellidos` VARCHAR(100), IN `p_email` VARCHAR(100), IN `p_sexo` BIT, IN `p_telefono` INT, IN `p_dni` INT, IN `p_saldo` INT, IN `p_direccion` VARCHAR(100))  NO SQL
BEGIN
	UPDATE clientes
    SET Username = p_Username, password = p_psd, nombre=p_nombre, apellidos=p_apellidos, email=p_email,sexo= p_sexo,telefono=p_telefono,  dni=p_dni, saldo=p_saldo,direccion=p_direccion
    WHERE codigo=p_Codigo;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pr_Venta` (IN `p_codCliente` INT, IN `p_producto` INT)  NO SQL
BEGIN 
	

    
    SET @precio=(SELECT PrecioUnitario From productos 
    where IdProducto=p_producto);
    
    SET @saldo=(SELECT Saldo From clientes where Codigo=p_codCliente);
    
    
    INSERT into Ventas (CodVenta,CodCliente,PrecioTotal,FechaCompra) 		VALUES (NULL,p_codCliente,@precio,CURDATE());
    
    UPDATE clientes  SET saldo=saldo-@precio where codigo=p_codCliente;
    
    Set @CV= (SELECT MAX(CodVenta) From ventas);
    
    INSERT Into detalleventas (CodVenta, CodProducto,Cantidad)
    VALUES (@CV,p_producto,1);
    
    UPDATE productos SET Stock=Stock-1 
    WHERE IdProducto = p_producto;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pr_VentaMismoProducto` (IN `p_codCliente` INT, IN `p_producto` INT, IN `p_CodVenta` INT)  NO SQL
BEGIN 
	
    SET @precio=(SELECT PrecioUnitario From productos 
    where IdProducto=p_producto);
    
    SET @saldo=(SELECT Saldo From clientes where Codigo=p_codCliente);
    
    SET @SCK=(SELECT Stock From productos where IdProducto=p_producto);
	
    UPDATE ventas Set PrecioTotal=PrecioTotal+@precio
            WHERE CodVenta=p_CodVenta;

            UPDATE clientes  SET saldo=saldo-@precio 
            where codigo=p_codCliente;
            
            UPDATE detalleventas  SET Cantidad=Cantidad+1 
            where CodVenta=p_CodVenta AND CodProducto=p_producto;

            UPDATE productos SET Stock=Stock-1 
            WHERE IdProducto = p_producto;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administradores`
--

CREATE TABLE `administradores` (
  `CodAdmin` char(6) NOT NULL,
  `Usuario` varchar(50) NOT NULL,
  `Rango` char(2) NOT NULL,
  `password` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `administradores`
--

INSERT INTO `administradores` (`CodAdmin`, `Usuario`, `Rango`, `password`) VALUES
('Adm001', 'AdmPlus_JonAme', 'AA', 'seim-2020'),
('Adm002', 'AdmPlus_JosGar', 'A0', 'seim-2020');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `CodCategoria` char(3) NOT NULL,
  `Categoria` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`CodCategoria`, `Categoria`) VALUES
('A01', 'Comida'),
('A02', 'Bebida'),
('E01', 'Joven'),
('E02', 'Adulto'),
('E03', 'Niños'),
('J01', 'Diversion'),
('J02', 'Deporte'),
('R01', 'Ropa'),
('R02', 'Disfraces');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `codigo` int(11) NOT NULL,
  `Username` varchar(25) NOT NULL,
  `password` varchar(16) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `sexo` bit(1) NOT NULL,
  `telefono` char(9) NOT NULL,
  `dni` char(9) NOT NULL,
  `direccion` varchar(300) NOT NULL,
  `fechaAlta` date NOT NULL,
  `saldo` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`codigo`, `Username`, `password`, `nombre`, `apellidos`, `email`, `sexo`, `telefono`, `dni`, `direccion`, `fechaAlta`, `saldo`) VALUES
(1, 'Jon', '123', 'Jon', 'Amengual', 'jon@gmail.com', b'1', '688675215', '72603070M', 'Paseo Fanderia', '2020-06-11', 9049),
(2, 'Ane', 'Ane', 'Ane', 'Amengual', 'Ane@gmail.com', b'0', '9456845', '78945612M', 'PaseoFanderia', '2020-06-11', 40.01),
(3, 'Jorge', 'Jorge', 'Jorge', 'mario', 'Jorge@gmail.com', b'1', '943256489', '25441070M', 'Pase Fardon', '2020-06-11', 100),
(4, 'Jamelin', 'Seim-2020', 'Jaime', 'AAA', 'ewr@seim.com', b'1', '987654322', '75315985L', 'ASDS', '2020-06-15', 100),
(5, 'Arnol', 'seim-2121', 'Arnol', 'Ferca', 'Arnol@gmail.com', b'1', '987654329', '75315985', 'ASDI', '2020-06-15', 100);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleventas`
--

CREATE TABLE `detalleventas` (
  `CodVenta` int(11) NOT NULL,
  `CodProducto` int(11) NOT NULL,
  `Cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalleventas`
--

INSERT INTO `detalleventas` (`CodVenta`, `CodProducto`, `Cantidad`) VALUES
(1, 1, 1),
(1, 2, 1),
(2, 1, 1),
(4, 1, 1),
(5, 1, 1),
(6, 1, 2),
(6, 4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `IdProducto` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Descripcion` varchar(500) NOT NULL,
  `PrecioUnitario` decimal(5,2) NOT NULL,
  `Categoria` char(3) DEFAULT NULL,
  `SubCategoria` char(3) DEFAULT NULL,
  `Stock` int(11) NOT NULL,
  `Imagen` varchar(600) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`IdProducto`, `Nombre`, `Descripcion`, `PrecioUnitario`, `Categoria`, `SubCategoria`, `Stock`, `Imagen`) VALUES
(1, 'Satisfyer', 'El juguete que está revolucionando el mercado. Y es que no nos extraña: muchas mujeres y personas con vagina (en concreto el 83%) afirman llegar al orgasmo en 2 minutos. Y además, descubren que son multiorgásmicas. Además de tener estos magníficos poderes, es sumergible.', '59.99', 'E02', 'J01', 6, 'https://static.carrefour.es/hd_510x_/imagenes/products/21000/00214/246/2100000214246/imagenGrande1.jpg'),
(2, 'Pantalon vaquero', 'Un simple pantalon vaquero', '30.01', 'E01', 'R01', 96, 'https://www.creacionescasbas.com/24406-large_default/pantalon-vaquero-elastico-adrien-confort-41b.jpg'),
(3, 'Taparrabos', 'Para los salvajes de este mundo... Un taparrabos para tapar el miembro', '100.50', 'R02', 'E02', 65, 'https://images-na.ssl-images-amazon.com/images/I/61W3SdY6eAL._AC_SX466_.jpg'),
(4, 'Silla de ruedas', 'Silla con cuatro ruedas.', '650.99', 'J01', 'J02', 64, 'https://www.queralto.com/289836-large_default/silla-de-ruedas-plegable-autopropulsable-ligera-valencia-clinicalfy.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `CodVenta` int(11) NOT NULL,
  `CodCliente` int(11) NOT NULL,
  `PrecioTotal` decimal(9,2) NOT NULL,
  `FechaCompra` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`CodVenta`, `CodCliente`, `PrecioTotal`, `FechaCompra`) VALUES
(1, 2, '90.00', '2020-06-14'),
(2, 1, '59.99', '2020-06-15'),
(4, 2, '59.99', '2020-06-15'),
(5, 1, '59.99', '2020-06-15'),
(6, 1, '891.01', '2020-06-15');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`CodAdmin`),
  ADD UNIQUE KEY `Usuario` (`Usuario`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`CodCategoria`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`codigo`),
  ADD UNIQUE KEY `Usuername` (`Username`),
  ADD UNIQUE KEY `dni` (`dni`);

--
-- Indices de la tabla `detalleventas`
--
ALTER TABLE `detalleventas`
  ADD PRIMARY KEY (`CodVenta`,`CodProducto`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`IdProducto`),
  ADD KEY `Categoria` (`Categoria`,`SubCategoria`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`CodVenta`),
  ADD KEY `CodCliente` (`CodCliente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `IdProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `CodVenta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;



/**************************************************************************Procedimientos**************************************************/
CREATE DEFINER=`root`@`localhost` PROCEDURE `pr_BuscarAdmin`(IN `p_Usuario` VARCHAR(50), IN `p_Pswd` VARCHAR(16))
    NO SQL
BEGIN
	SELECT  CodAdmin, Rango FROM administradores WHERE Usuario LIKE p_Usuario AND password LIKE p_Pswd;
END

CREATE DEFINER=`root`@`localhost` PROCEDURE `pr_BuscarCategorias`()
    NO SQL
BEGIN 
	SELECT CodCategoria, Categoria FROM categorias;
END

CREATE DEFINER=`root`@`localhost` PROCEDURE `pr_BuscarCliente`(IN `p_Username` VARCHAR(25), IN `p_Pswd` VARCHAR(16))
    NO SQL
BEGIN
	Select codigo FROM clientes WHERE Username like p_Username and password Like p_Pswd ;
END

CREATE DEFINER=`root`@`localhost` PROCEDURE `pr_BuscarVentas`()
    NO SQL
BEGIN
	SELECT CodVenta, c.Username as Cliente, PrecioTotal, FechaCompra
    FROM ventas as v
    JOIN clientes as c
    ON v.CodCliente=c.codigo;
END

CREATE DEFINER=`root`@`localhost` PROCEDURE `pr_BuscarProductos`()
    NO SQL
BEGIN
	SELECT IdProducto, Nombre, Descripcion, PrecioUnitario,c.Categoria as Categoria,p.Categoria as CCAt, SC.Categoria as SubCategoria, p.SubCategoria as CSCAt,Stock, Imagen
    FROM productos as p
    JOIN  categorias as c 
    on p.Categoria=c.CodCategoria 
    JOIN categorias as SC
    on p.SubCategoria=SC.CodCategoria;
END

CREATE DEFINER=`root`@`localhost` PROCEDURE `pr_Clientes`()
    NO SQL
BEGIN
	SELECT * from clientes;
END

CREATE DEFINER=`root`@`localhost` PROCEDURE `pr_DetalleVenta`(IN `p_CodVenta` INT)
    NO SQL
BEGIN
	SELECT CodVenta, p.Nombre as Producto, Cantidad,p.PrecioUnitario as PrecioUnitario, (p.PrecioUnitario*Cantidad) as TotalPorProducto
    FROM detalleventas as dv
    JOIN productos as p
    on p.IdProducto=dv.CodProducto
    WHERE CodVenta= p_CodVenta;
END

CREATE DEFINER=`root`@`localhost` PROCEDURE `pr_MasVentas`(IN `p_codCliente` INT, IN `p_producto` INT, IN `p_CodVenta` INT)
    NO SQL
BEGIN 
	
    SET @precio=(SELECT PrecioUnitario From productos 
    where IdProducto=p_producto);
    
    SET @saldo=(SELECT Saldo From clientes where Codigo=p_codCliente);
    
    SET @SCK=(SELECT Stock From productos where IdProducto=p_producto);
	
    UPDATE Ventas Set PrecioTotal=PrecioTotal+@precio
            WHERE CodVenta=p_CodVenta;

            UPDATE clientes  SET saldo=saldo-@precio 
            where codigo=p_codCliente;

            INSERT Into detalleventas (CodVenta, CodProducto,Cantidad)
            VALUES (p_CodVenta,p_producto,1);

            UPDATE productos SET Stock=Stock-1 
            WHERE IdProducto = p_producto;
END

CREATE DEFINER=`root`@`localhost` PROCEDURE `pr_MaxCodVenta`()
    NO SQL
BEGIN
SELECT MAX(CodVenta)as CodVenta from ventas;
END

CREATE DEFINER=`root`@`localhost` PROCEDURE `pr_SelectAdmins`()
    NO SQL
BEGIN
    SELECT CodAdmin,Usuario,rango,password
    FROM administradores;
END

CREATE DEFINER=`root`@`localhost` PROCEDURE `pr_Venta`(IN `p_codCliente` INT, IN `p_producto` INT)
    NO SQL
BEGIN 
	

    
    SET @precio=(SELECT PrecioUnitario From productos 
    where IdProducto=p_producto);
    
    SET @saldo=(SELECT Saldo From clientes where Codigo=p_codCliente);
    
    
    INSERT into Ventas (CodVenta,CodCliente,PrecioTotal,FechaCompra) 		VALUES (NULL,p_codCliente,@precio,CURDATE());
    
    UPDATE clientes  SET saldo=saldo-@precio where codigo=p_codCliente;
    
    Set @CV= (SELECT MAX(CodVenta) From ventas);
    
    INSERT Into detalleventas (CodVenta, CodProducto,Cantidad)
    VALUES (@CV,p_producto,1);
    
    UPDATE productos SET Stock=Stock-1 
    WHERE IdProducto = p_producto;

END

CREATE DEFINER=`root`@`localhost` PROCEDURE `pr_VentaMismoProducto`(IN `p_codCliente` INT, IN `p_producto` INT, IN `p_CodVenta` INT)
    NO SQL
BEGIN 
	
    SET @precio=(SELECT PrecioUnitario From productos 
    where IdProducto=p_producto);
    
    SET @saldo=(SELECT Saldo From clientes where Codigo=p_codCliente);
    
    SET @SCK=(SELECT Stock From productos where IdProducto=p_producto);
	
    UPDATE ventas Set PrecioTotal=PrecioTotal+@precio
            WHERE CodVenta=p_CodVenta;

            UPDATE clientes  SET saldo=saldo-@precio 
            where codigo=p_codCliente;
            
            UPDATE detalleventas  SET Cantidad=Cantidad+1 
            where CodVenta=p_CodVenta AND CodProducto=p_producto;

            UPDATE productos SET Stock=Stock-1 
            WHERE IdProducto = p_producto;
END

CREATE DEFINER=`root`@`localhost` PROCEDURE `pr_altaAdmins`(IN `p_CodAdmin` CHAR(6), IN `p_usuario` VARCHAR(50), IN `p_rango` CHAR(2), IN `p_pswd` VARCHAR(16), OUT `p_salida` TINYINT)
    NO SQL
BEGIN
	SET @existe=(SELECT COUNT(*) FROM administradores Where CodAdmin Like 			p_CodAdmin OR 	Usuario LIKE p_pswd);
    IF @existe<>0 THEN
    	Set @salida=-1;
    ELSE
    	INSERT INTO administradores (CodAdmin, Usuario,password,Rango)
        VALUES(p_CodAdmin,p_usuario,p_pswd,p_rango);
          Set p_salida=0;
    END IF;
        
End

CREATE DEFINER=`root`@`localhost` PROCEDURE `pr_altaCategoria`(IN `p_CodCategoria` CHAR(3), IN `p_Categoria` VARCHAR(50), OUT `p_salida` INT)
    NO SQL
BEGIN
	INSERT INTO categorias(CodCategoria,Categoria) VALUES (p_CodCategoria, p_Categoria);
    SET p_salida=0;
END

CREATE DEFINER=`root`@`localhost` PROCEDURE `pr_altaCliente`(IN `p_Username` VARCHAR(25), IN `p_pswd` VARCHAR(16), IN `p_nombre` VARCHAR(25), IN `p_apellidos` VARCHAR(100), IN `p_email` VARCHAR(100), IN `p_sexo` BIT, IN `p_tel` CHAR(9), IN `p_dni` CHAR(9), IN `p_direc` VARCHAR(300), OUT `p_salida` SMALLINT)
    NO SQL
BEGIN
	INSERT INTO clientes (codigo, Username, password, nombre, 						apellidos, email, sexo, telefono, dni, direccion,	fechaAlta, saldo)
        VALUES(NULL,p_Username, p_pswd, p_nombre, p_apellidos, p_email, p_sexo, p_tel, p_dni,p_direc, CURDATE() , 100);
          Set @p_salida=0; 
End

CREATE DEFINER=`root`@`localhost` PROCEDURE `pr_altaProdutos`(IN `p_Nombre` VARCHAR(50), IN `p_Descripcion` VARCHAR(500), IN `p_PrecioUnitario` DECIMAL(5,2), IN `p_Categoria` CHAR(3), IN `p_SubCategoria` CHAR(3), IN `p_Stock` INT, OUT `P_salida` INT)
    NO SQL
BEGIN
	INSERT Into productos (Idproducto, Nombre, Descripcion, PrecioUnitario, Categoria, SubCategoria, Stock) VALUES (NULL, p_Nombre, p_Descripcion, p_PrecioUnitario, p_Categoria, p_SubCategoria, p_Stock);
    SET p_salida=0;
END

CREATE DEFINER=`root`@`localhost` PROCEDURE `pr_updateAdmin`(IN `p_codAdmin` CHAR(6), IN `p_usuario` VARCHAR(50), IN `p_Rango` CHAR(2), IN `p_password` VARCHAR(16))
    NO SQL
BEGIN
    UPDATE administradores
    SET usuario=p_usuario,rango=p_Rango,password=p_p_password
    WHERE CodAdmin=p_codAdmin;
End

CREATE DEFINER=`root`@`localhost` PROCEDURE `pr_updateCliente`(IN `p_Codigo` INT, IN `p_Username` VARCHAR(25), IN `p_psd` VARCHAR(16), IN `p_nombre` VARCHAR(25), IN `p_apellidos` VARCHAR(100), IN `p_email` VARCHAR(100), IN `p_sexo` BIT, IN `p_telefono` INT, IN `p_dni` INT, IN `p_saldo` INT, IN `p_direccion` VARCHAR(100))
    NO SQL
BEGIN
	UPDATE clientes
    SET Username = p_Username, password = p_psd, nombre=p_nombre, apellidos=p_apellidos, email=p_email,sexo= p_sexo,telefono=p_telefono,  dni=p_dni, saldo=p_saldo,direccion=p_direccion
    WHERE codigo=p_Codigo;
END
