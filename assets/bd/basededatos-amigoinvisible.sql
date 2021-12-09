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

    FOREIGN KEY (IDUsuario) REFERENCES usuarios(IDUsuario) ON DELETE CASCADE,
    FOREIGN KEY (IDGrupo) REFERENCES grupos(IDGrupo) ON DELETE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Tabla Invitado
--

CREATE TABLE invitado
(
    IDGrupo SMALLINT UNSIGNED NOT NULL,
    Correo VARCHAR(60) NOT NULL,

    FOREIGN KEY (IDGrupo) REFERENCES grupos(IDGrupo) ON DELETE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


--
-- Tabla Regalo
--

CREATE TABLE regalo
(
    IDRegalo INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    Nombre VARCHAR(512) NOT NULL,
    Volumen TINYINT UNSIGNED NOT NULL,
    Formato VARCHAR(80) NOT NULL,
    Ruta VARCHAR(512) NOT NULL,
    Fecha_Subida date NOT NULL,
    Destinatario SMALLINT UNSIGNED NULL,
    Grupo SMALLINT UNSIGNED NOT NULL,
    Usuario SMALLINT UNSIGNED NOT NULL,


    FOREIGN KEY (Destinatario) REFERENCES usuarios(IDUsuario) ON DELETE CASCADE,
    FOREIGN KEY (Grupo) REFERENCES grupos(IDGrupo) ON DELETE CASCADE,
    FOREIGN KEY (Usuario) REFERENCES usuarios(IDUsuario) ON DELETE CASCADE

)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;




