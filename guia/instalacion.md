# Instrucciones de instalación y despliegue

## En local

**_Requisitos mínimos:_**

- PHP 7.1.0 o superior.
- Composer
- PostgreSQL

**_Instalación:_**

- Clonamos el reposito:

~~~
bash git clone https://github.com/oscar490/miespacio.git miespacio
~~~

- Instalamos los paquetes necesarios:

~~~
bash composer install
~~~

- Creamos la base de datos e instroducimos los datos en ella.

~~~
bash ./create.sh
bash ./load.sh
~~~

- Creamos el archivo "env" en la raíz del proyecto, con las siguientes variables de entorno:

    - SMTP_PASS: Clave de aplicación (Email)

    - DROPBOX_TOKEN: Token de activación de Dropbox.

- Accedemos a "miespacio" y ejecutamos el siguiente comando para iniciar el servidor:

~~~
make serve
~~~


- Nos dirigimos al navegador y accedemos mediante http://localhost:8080

## En la nube

**_Requisitos mínmimos:_**

- HerokuCLi.

**_Instalación:_**

- Creamos una cuenta de Heroku.

- Creamos una nueva aplicación.

- En "Resources", añadimos el módulo **Heroku Postgres.**

- En HerokuCLi hacemos login:

~~~
bash heroku login
~~~


- Ejecutamos el siguiente comando para añadir variables de entorno, desde la raíz del proyecto.

~~~
bash heroku git:remote --app nombre_app  heroku config:set YII_ENV=prod
~~~

- Insertamos las tablas y los datos necesarios en la Base de datos.

~~~
bash heroku psql < db/miespacio.psql
~~~


- Sincronizaremos con la rama "master" del repositorio, de GitHub, donde está alojado el proyecto, desde "Settings", "Deployment method".
