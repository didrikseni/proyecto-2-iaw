La idea a implementar es un portal donde cada usuario pueda compartir publicaciónes relacionadas con las ciencas de la computación, siempre que sean de su propia autoría o de contenido libre otorgando el credito correspondiente, y los demás usuarios puedan ver, descargar, opinar y puntuar las mismas. 

Por ejemplo si tenemos un resumen de alguna materia y queremos ayudar a nuestros compañeros y las futuras generaciónes de estudiantes que cursen la materia, podríamos hacerlo a traves del portal. Donde los demás usuarios podrán ver la publicación, comentar sobre ella, e inclusive puntuarlas.

La idea es que también sirva como puente entre los profesores y los alumnos. Muchas veces como alumnos, no nos enteramos de las actividades de investigación, y desarrollo realizadas en el DCIC. Estaría muy bueno conocer sobre las distintas ramas y disciplinas que se estudian y desarrollan en la universidad, y hasta podríamos desarrollar algún interés en algun área que no sabíamos que existía.

Las entidades en la aplicación serían las de: 
* Usuario, que puede tener cero o mas artículos publicados, puede guardar artículos, y puede reportarlos, además de contener su información como nombre, apellido, email, etc.
* Publicación o Artículo, el cual tiene un usuario "dueño" y también puede tener un archivo adjuntado. Además cada artículo puede tener varios "tags".
* Archivos o Imágenes vinculadas a cada publicación.
* Area temática, donde muchas publicaciónes pueden pertenecer a un mismo área temática o tag.


Los distintos tipos de usuario serán:	
* Usuario, el cual puede publicar articulos, añadirles alguna imágen, y algún archivo y eliminar sus propios articulos y los articulos en los cuales es un colaborador. Además podrá ver las otras publicaciónes realizadas por otros usuarios, podrá puntuarlas, guardarlas, reportarlas.
	
* Administrador, el cual puede hacer todo lo que hace el usuario, y además puede elminar o modificar cualquier articulo, imágen o archivo del sitio.


En cuanto a la API REST:
* Permite registrar usuarios y loguearse, obteniendose un token para autenticar los pedidos.
* Permite obtener información acerca de usuarios (todos o alguno en particular): nombre, email y el avatar.
* Permite obtener información acerca de los artículos (todos o alguno en particular): titulo, descripción, contenido, tags, archivos adjuntados, y autor.
* Permite obtener el nombre de los tags.
* Permite obtener información acerca de los archivos (todos o alguno en particular): nombre, extensión, data.

Para probar la api debemos importar el archivo "Test API REST - Proyecto 2.postman_collection.json" dentro de la carpeta "API REST - Postman test", a la aplicación Postman. Luego debemos registrarnos con el request "Registration" o loguearnos con el request "Login" si ya estamos registrados, estos request nos devuelven un 'access_token', el cual debemos copiar, nos dirigimos a la carpeta raiz "Test API REST - Proyecto 2", y pegamos el código en segundo click->edit->Authorization : Token, con el tipo seleccionado como Bearer Token, y clickear en "update".

Luego de ésto, ya podemos ejecutar cualquier request que querramos en las subcarpetas. 
En éstas tenemos las request para testear: 
* Articulos
* Usuarios
* Archivos
* Tags
