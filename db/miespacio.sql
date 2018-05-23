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
    VALUES ('oscar', crypt('oscar', gen_salt('bf', 13)), 'oscar.vega@iesdonana.org'),
            ('pepe', crypt('pepe', gen_salt('bf', 13)), 'pepe@gmail.com'),
            ('rafa', crypt('rafa', gen_salt('bf', 13)), 'rafa.rafa@gmail.com');


-- Tabla datos_usuarios --

DROP TABLE IF EXISTS datos_usuarios CASCADE;

CREATE TABLE datos_usuarios
(
      usuario_id      BIGINT       NOT NULL REFERENCES usuarios (id) ON DELETE
                                   CASCADE ON UPDATE CASCADE
    , nombre_completo VARCHAR(255) NOT NULL
    , apellidos       VARCHAR(255)
    , url_imagen      VARCHAR(255)
    , descripcion     VARCHAR(50)
    , PRIMARY KEY (usuario_id)
);

INSERT INTO datos_usuarios (usuario_id, nombre_completo, apellidos, url_imagen)
    VALUES (1, 'OSCAR', 'Vega Herrera','images/usuario.png'),
            (2, 'Pepe', 'Macias Herrera','images/usuario.png'),
            (3, 'Rafa', 'Duran García','images/usuario.png');


-- Tabla equipos --

DROP TABLE IF EXISTS equipos CASCADE;

CREATE TABLE equipos
(
      id               BIGSERIAL    PRIMARY KEY
    , denominacion     VARCHAR(255) NOT NULL
    , descripcion      VARCHAR(255)
    , url_imagen       VARCHAR(255)
    , created_at       TIMESTAMP(0) NOT NULL DEFAULT LOCALTIMESTAMP
    , propietario_id   BIGINT       NOT NULL REFERENCES usuarios (id) ON DELETE
                                    CASCADE ON UPDATE CASCADE
    , UNIQUE (denominacion, propietario_id)
);


INSERT INTO equipos (denominacion, propietario_id, url_imagen)
    VALUES ('2º DAW', 1, 'images/equipo.png'), ('1º SMR', 1, 'images/equipo.png');



-- Tipos visibilidad --

DROP TABLE IF EXISTS tipos_visibilidad CASCADE;

CREATE TABLE tipos_visibilidad
(
       id          BIGSERIAL    PRIMARY KEY
    ,  visibilidad VARCHAR(255) NOT NULL
);

INSERT INTO tipos_visibilidad (visibilidad)
    VALUES ('Privado'), ('Público');

-- Tabla tableros --

DROP TABLE IF EXISTS tableros CASCADE;

CREATE TABLE tableros
(
      id            BIGSERIAL     PRIMARY KEY
    , denominacion  VARCHAR(255)  NOT NULL
    , equipo_id     BIGINT        NOT NULL REFERENCES equipos (id) ON DELETE
                                  CASCADE ON UPDATE CASCADE
    , visibilidad_id BIGINT       NOT NULL REFERENCES tipos_visibilidad (id) ON DELETE
                                  CASCADE ON UPDATE CASCADE

    , UNIQUE (denominacion, equipo_id)

);

INSERT INTO tableros (denominacion, equipo_id, visibilidad_id)
    VALUES ('DWEC', 1, 2), ('DWES', 1, 2), ('MOMAE', 2, 2), ('DIW', 1, 2);



-- Tabla listas --

DROP TABLE IF EXISTS listas CASCADE;

CREATE TABLE listas
(
      id           BIGSERIAL    PRIMARY KEY
    , denominacion VARCHAR(255) NOT NULL
    , created_at   TIMESTAMP(0) NOT NULL DEFAULT LOCALTIMESTAMP
    , tablero_id   BIGINT       NOT NULL REFERENCES tableros (id) ON DELETE
                                CASCADE ON UPDATE CASCADE

    , UNIQUE (denominacion, tablero_id)
);

INSERT INTO listas (denominacion, tablero_id)
    VALUES ('Documentacion', 1), ('Actividades', 1),
            ('Práctico', 1), ('Exámenes', 1), ('Excursiones', 1);



-- Tabla tarjetas --

DROP TABLE IF EXISTS tarjetas CASCADE;

CREATE TABLE tarjetas
(
      id           BIGSERIAL    PRIMARY KEY
    , denominacion VARCHAR(255) NOT NULL
    , descripcion  VARCHAR(255)
    , created_at   TIMESTAMP(0) NOT NULL DEFAULT LOCALTIMESTAMP
    , esta_oculta  BOOLEAN
    , lista_id     BIGINT       NOT NULL REFERENCES listas (id) ON DELETE
                                CASCADE ON UPDATE CASCADE

    , UNIQUE (denominacion, lista_id)
);

INSERT INTO tarjetas (denominacion, lista_id, esta_oculta)
    VALUES ('Desarrollo web', 1, false), ('Git', 1, false),
            ('Introducción a PHP', 1, false), ('Enero', 1, false),
            ('Febrero', 2, false), ('Practica 0', 3, false), ('Practica 1', 3, false);





-- Tabla adjuntos --

DROP TABLE IF EXISTS adjuntos CASCADE;

CREATE TABLE adjuntos
(
       id            BIGSERIAL     PRIMARY KEY
    ,  nombre        VARCHAR(255)
    ,  url_direccion VARCHAR(255)  NOT NULL
    ,  es_imagen     BOOLEAN
    ,  created_at    TIMESTAMP(0)  NOT NULL DEFAULT LOCALTIMESTAMP
    ,  tarjeta_id    BIGINT        NOT NULL REFERENCES tarjetas (id) ON DELETE
                                   CASCADE ON UPDATE CASCADE
    ,  UNIQUE (nombre, url_direccion, tarjeta_id)
);

INSERT INTO adjuntos (nombre, url_direccion, tarjeta_id)
    VALUES ('3dJuegos', 'https://www.3djuegos.com/', 1),
            ('Ágora', 'http://agora.iesdonana.org/', 1);




-- Table tipos_miembros --

DROP TABLE IF EXISTS tipos_miembros CASCADE;

CREATE TABLE tipos_miembros
(
       id   BIGSERIAL    PRIMARY KEY
    ,  tipo VARCHAR(255) NOT NULL
);

INSERT INTO tipos_miembros (tipo)
    VALUES ('Popietario'), ('Miembro');



-- Tabla miembros --

DROP TABLE IF EXISTS miembros CASCADE;

CREATE TABLE miembros
(
       id         BIGSERIAL     PRIMARY KEY
    ,  usuario_id BIGINT        NOT NULL REFERENCES usuarios (id) ON DELETE
                                CASCADE ON UPDATE CASCADE
    ,  tipo_id    BIGINT        NOT NULL REFERENCES tipos_miembros (id) ON DELETE
                                CASCADE ON UPDATE CASCADE
    ,  equipo_id  BIGINT        NOT NULL REFERENCES equipos (id) ON DELETE
                                CASCADE ON UPDATE CASCADE
    ,  created_at TIMESTAMP(0)  NOT NULL DEFAULT LOCALTIMESTAMP
    ,  UNIQUE (usuario_id, equipo_id)
);

INSERT INTO miembros (usuario_id, equipo_id, tipo_id)
    VALUES (1, 1, 1), (1, 2, 1);



-- Table notificaciones --

DROP TABLE IF EXISTS notificaciones CASCADE;

CREATE TABLE notificaciones
(
       id         BIGSERIAL    PRIMARY KEY
    ,  contenido  VARCHAR(255)
    ,  miembro_id BIGINT       NOT NULL REFERENCES miembros (id) ON DELETE
                               CASCADE ON UPDATE CASCADE
    ,  tablero_id BIGINT       REFERENCES tableros (id) ON DELETE
                               CASCADE ON UPDATE CASCADE
    ,  created_at TIMESTAMP(0) NOT NULL DEFAULT LOCALTIMESTAMP
    ,  view_at    TIMESTAMP(0)
);



-- Tabla favoritos --

DROP TABLE IF EXISTS favoritos CASCADE;

CREATE TABLE favoritos
(
       id         BIGSERIAL PRIMARY KEY
    ,  usuario_id BIGINT    NOT NULL REFERENCES usuarios (id) ON DELETE
                            CASCADE ON UPDATE CASCADE
    ,  tablero_id BIGINT    NOT NULL REFERENCES tableros (id) ON DELETE
                            CASCADE ON UPDATE CASCADE
    ,  UNIQUE (usuario_id, tablero_id)
);

INSERT INTO favoritos (usuario_id, tablero_id)
        VALUES (1, 1), (1, 2);




-- Table Actividades --
/*
DROP TABLE IF EXISTS actividades CASCADE;

CREATE TABLE actividades
(
       id         BIGSERIAL    PRIMARY KEY
    ,  contenido  VARCHAR(255) NOT NULL
    ,  tablero_id BIGINT       NOT NULL REFERENCES tableros (id) ON DELETE
                               CASCADE ON UPDATE CASCADE
    ,  usuario_id BIGINT       NOT NULL REFERENCES usuarios (id) ON DELETE
                               CASCADE ON UPDATE CASCADE
); */
