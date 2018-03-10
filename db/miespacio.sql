------------------------------
-- Archivo de base de datos --
------------------------------


-- Tabla usuarios --

DROP TABLE IF EXISTS usuarios CASCADE;

CREATE TABLE usuarios
(
      id          BIGSERIAL    PRIMARY  KEY
    , nombre      VARCHAR(255) NOT NULL UNIQUE
    , password    VARCHAR(255) NOT NULL
    , email       VARCHAR(255) NOT NULL UNIQUE
    , token_acti  VARCHAR(255)
    , token_clave VARCHAR(255)
    , auth_key    VARCHAR(255)
);

INSERT INTO usuarios (nombre, password, email)
    VALUES ('oscar', crypt('oscar', gen_salt('bf', 13)), 'oscar.vega@iesdonana.org');
