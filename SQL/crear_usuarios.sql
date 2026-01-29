-- Usuario administrador de BD

/*Creamos el usuario admin_deportes_mvc, que será el que tiene administre la bd. 
Le damos ALL PRIVILEGES, de manera que le asignamos control total sobre todas las tablas de la bd deportes_MVC*/

CREATE USER 'admin_deportes_mvc'@'localhost' IDENTIFIED BY 'admin123';
GRANT ALL PRIVILEGES ON deportes_MVC.* TO 'admin_deportes_mvc'@'localhost';

/*Creamos el usuario user_web*/
/* Este es el usuario de bd que utilizarán los usuarios de la web. Le damos permiso de select e insert.
	INSERT: Para introducir el usuario y la inscripción en la base de datos
	SELECT: El usuario coordinador tiene acceso a unos procesos para sacar información de la bd. 
	Además, en el formulario de inscripción, para sacar los deportes en los que se 
	puede inscribir un alumno hay que hacer una consulta a la bd, para que los deportes sean dinámicos
*/
CREATE USER 'user_web'@'localhost' IDENTIFIED BY 'web123';
GRANT SELECT, INSERT, ON deportes_MVC.* TO 'web_user'@'localhost';