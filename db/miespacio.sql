------------------------------
-- Archivo de base de datos --
------------------------------


-- Tabla usuarios --

DROP TABLE IF EXISTS usuarios CASCADE;

CREATE TABLE usuarios
(
      id              BIGSERIAL    PRIMARY  KEY
    , nombre          VARCHAR(255) NOT NULL UNIQUE
    , password        VARCHAR(255) NOT NULL
    , email           VARCHAR(255) NOT NULL UNIQUE
    , token_acti      VARCHAR(255)
    , token_clave     VARCHAR(255)
    , auth_key        VARCHAR(255)
    , update_clave_at TIMESTAMP(0)
);

INSERT INTO usuarios (nombre, password, email)
    VALUES ('oscar', crypt('oscar', gen_salt('bf', 13)), 'oscar.vega@iesdonana.org');


-- Tabla datos_usuarios --

DROP TABLE IF EXISTS datos_usuarios CASCADE;

CREATE TABLE datos_usuarios
(
      id              BIGSERIAL    PRIMARY KEY
    , nombre_completo VARCHAR(255) NOT NULL
    , descripcion     VARCHAR(50)
    , iniciales       VARCHAR(4)   NOT NULL
    , usuario_id      BIGINT       NOT NULL REFERENCES usuarios (id) ON DELETE
                                   CASCADE ON UPDATE CASCADE
);

INSERT INTO datos_usuarios (nombre_completo, iniciales, usuario_id)
    VALUES ('OSCAR', 'O', 1);


-- Tabla equipos --

DROP TABLE IF EXISTS equipos CASCADE;

CREATE TABLE equipos
(
      id           BIGSERIAL    PRIMARY KEY
    , denominacion VARCHAR(255) NOT NULL UNIQUE
    , descipcion   VARCHAR(255)
    , usuario_id   BIGINT       NOT NULL REFERENCES usuarios (id) ON DELETE
                                CASCADE ON UPDATE CASCADE
);


INSERT INTO equipos (denominacion, usuario_id)
    VALUES ('2º DAW', 1), ('1º SMR', 1);



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
