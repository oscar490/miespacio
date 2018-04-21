------------------------------
-- Archivo de base de datos --
------------------------------


-- Tabla usuarios --

DROP TABLE IF EXISTS usuarios CASCADE;

CREATE TABLE usuarios
(
      id                 BIGSERIAL    PRIMARY  KEY
    , nombre             VARCHAR(255) NOT NULL UNIQUE
    , password           VARCHAR(255) NOT NULL
    , email              VARCHAR(255) NOT NULL UNIQUE
    , token_acti         VARCHAR(255)
    , token_clave        VARCHAR(255)
    , auth_key           VARCHAR(255)
);

INSERT INTO usuarios (nombre, password, email)
    VALUES ('oscar', crypt('oscar', gen_salt('bf', 13)), 'oscar.vega@iesdonana.org');


-- Tabla datos_usuarios --

DROP TABLE IF EXISTS datos_usuarios CASCADE;

CREATE TABLE datos_usuarios
(
      id              BIGSERIAL    PRIMARY KEY
    , nombre_completo VARCHAR(255) NOT NULL
    , apellidos       VARCHAR(255)
    , url_imagen      VARCHAR(255)
    , descripcion     VARCHAR(50)
    , usuario_id      BIGINT       NOT NULL REFERENCES usuarios (id) ON DELETE
                                   CASCADE ON UPDATE CASCADE
);

INSERT INTO datos_usuarios (nombre_completo, apellidos, url_imagen, usuario_id)
    VALUES ('OSCAR', 'Vega Herrera','images/usuario.png', 1);


-- Tabla equipos --

DROP TABLE IF EXISTS equipos CASCADE;

CREATE TABLE equipos
(
      id           BIGSERIAL    PRIMARY KEY
    , denominacion VARCHAR(255) NOT NULL
    , descripcion  VARCHAR(255)
    , url_imagen   VARCHAR(255)
    , created_at   TIMESTAMP(0) NOT NULL DEFAULT LOCALTIMESTAMP
    , usuario_id   BIGINT       NOT NULL REFERENCES usuarios (id) ON DELETE
                                CASCADE ON UPDATE CASCADE
    , UNIQUE (denominacion, usuario_id)
);


INSERT INTO equipos (denominacion, usuario_id, url_imagen)
    VALUES ('2º DAW', 1, 'images/equipo.png'), ('1º SMR', 1, 'images/equipo.png');



-- Tabla tableros --

DROP TABLE IF EXISTS tableros CASCADE;

CREATE TABLE tableros
(
      id           BIGSERIAL     PRIMARY KEY
    , denominacion VARCHAR(255)  NOT NULL
    , equipo_id    BIGINT        NOT NULL REFERENCES equipos (id) ON DELETE
                                 CASCADE ON UPDATE CASCADE

    , UNIQUE (denominacion, equipo_id)

);

INSERT INTO tableros (denominacion, equipo_id)
    VALUES ('DWEC', 1), ('DWES', 1), ('MOMAE', 2), ('DIW', 1);



-- Tabla listas --

DROP TABLE IF EXISTS listas CASCADE;

CREATE TABLE listas
(
      id           BIGSERIAL    PRIMARY KEY
    , denominacion VARCHAR(255) NOT NULL
    , tablero_id   BIGINT       NOT NULL REFERENCES tableros (id) ON DELETE
                                CASCADE ON UPDATE CASCADE

    , UNIQUE (denominacion, tablero_id)
);

INSERT INTO listas (denominacion, tablero_id)
    VALUES ('Documentacion', 1), ('Actividades', 1), ('Práctico', 2);

    

-- Tabla tarjetas --

DROP TABLE IF EXISTS tarjetas CASCADE;

CREATE TABLE tarjetas
(
      id           BIGSERIAL    PRIMARY KEY
    , denominacion VARCHAR(255) NOT NULL
    , descripcion  VARCHAR(255)
    , lista_id     BIGINT       NOT NULL REFERENCES listas (id) ON DELETE
                                CASCADE ON UPDATE CASCADE

    , UNIQUE (denominacion, lista_id)
);

INSERT INTO tarjetas (denominacion, lista_id)
    VALUES ('Desarrollo web', 1), ('Git', 1), ('Introducción a PHP', 1);





-- Tabla adjuntos --

DROP TABLE IF EXISTS adjuntos CASCADE;

CREATE TABLE adjuntos
(
       id            BIGSERIAL    PRIMARY KEY
    ,  nombre        VARCHAR(255)
    ,  url_direccion VARCHAR(255) NOT NULL
    ,  tarjeta_id    BIGINT       NOT NULL REFERENCES tarjetas (id) ON DELETE
                                  CASCADE ON UPDATE CASCADE
    ,  UNIQUE (url_direccion, tarjeta_id)
);

INSERT INTO adjuntos (nombre, url_direccion, tarjeta_id)
    VALUES ('3dJuegos', 'https://www.3djuegos.com/', 1),
            ('Ágora', 'http://agora.iesdonana.org/', 1);
