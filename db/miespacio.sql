------------------------------
-- Archivo de base de datos --
------------------------------


-- Tabla usuarios --

DROP TABLE IF EXISTS usuarios CASCADE;

CREATE TABLE usuarios
(
      id       BIGSERIAL    PRIMARY KEY
    , nombre   VARCHAR(255) NOT NULL UNIQUE
    , password VARCHAR(255) NOT NULL
    , email    VARCHAR(255) NOT NULL
    , token VARCHAR(255) 
);
