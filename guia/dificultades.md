# Dificultades encontradas


_**Añadir un mapa con una ubicación:**_

- A la hora de crear una ubicación nueva y añadirla a una tarjeta, tuve problemas. De manera que mi intención era de añadir una ubicación en una ventana modal, pero el problema era que a la hora de iterar sobre el mapa, arrastrarel mapa, el modal se bloqueaba y se cerraba sólo.

- Decidí entonces colocar el mapa en una página concreta, de manera que a la hora de añadir una nueva ubicación, accedíamos a una nueva página.
<br><br>


_**Subir archivos a la aplicación mediante AJAX:**_

- A la hora de subir archivos por ajax, tuve problemas, ya que el contenido del mismo archivo no llegaba bién. De manera que al subir un archivo a la aplicación, no se tuviera que recargar la página.

- Después de investigar, encontré la solución de añanir una serie de cabeceras como parámetros en la función de realizar peticiones AJAX, de manera que se podía enviar archivos por AJAX, y los archivos llegaban correctos.
<br><br>

_**Elementos de innovación**_

- ** Google Maps: ** He usado la API de Google Maps para poder añadir un mapa de una ubicación en una tarjeta, de manera que se guarde en la base de datos la latitud y longitud de dicha ubicación.

- ** Iniciar sesión con Google: ** He usado la API de Google para poder inicar sesión en la aplicación, desde la cuenta de correos de Google.
