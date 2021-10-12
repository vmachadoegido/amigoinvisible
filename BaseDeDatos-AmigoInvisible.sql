--
-- Base de datos: Amigo Invible
--
CREATE DATABASE IF NOT EXISTS amigoinvisible DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;  
USE amigoinvisible;

--
-- Tabla Usuarios
--
CREATE TABLE usuarios
(
	IDUsuario SMALLINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
	UserName VARCHAR(60) NOT NULL,
	UserLastName VARCHAR(60) NOT NULL,
	Correo VARCHAR(60) NOT NULL UNIQUE,
	Tipo CHAR(1) NOT NULL,
	
	CONSTRAINT CHK_perfil CHECK (Tipo='p' || Tipo='a')
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;



