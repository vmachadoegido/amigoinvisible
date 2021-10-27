--
-- Base de datos: Amigo Invible
-- Victor Manuel Machado Egido
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

--
-- Tabla Grurpos
--


CREATE TABLE grupos
(
    IDGrupo SMALLINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    Nombre VARCHAR(60) NOT NULL,
    Fecha_Inicio date NOT NULL,
    Fecha_Fin date NOT NULL,
    Propietario SMALLINT UNSIGNED NOT NULL,
    
    FOREIGN KEY (Propietario) REFERENCES usuarios(IDUsuario)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


--
-- Tabla Usuario-Grupo
--

CREATE TABLE usuariogrupo
(
    IDUsuario SMALLINT UNSIGNED NOT NULL,
    IDGrupo SMALLINT UNSIGNED NOT NULL,
    
    FOREIGN KEY (IDUsuario) REFERENCES usuarios(IDUsuario),
    FOREIGN KEY (IDGrupo) REFERENCES grupos(IDGrupo)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;











