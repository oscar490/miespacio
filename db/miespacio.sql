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



DROP TABLE IF EXISTS datos_usuarios CASCADE;

CREATE TABLE datos_usuarios
(
      id              BIGSERIAL    PRIMARY KEY
    , nombre_completo VARCHAR(255)
    , descripcion     VARCHAR(255)
    , registro        TIMESTAMP(0) NOT NULL DEFAULT localtimestamp
    , ultimo_acceso   TIMESTAMP(0)
    , iniciales       VARCHAR(4)
    , usuario_id      BIGINT       REFERENCES usuarios (id) ON DELETE
                                   CASCADE ON UPDATE CASCADE
);
