
/* 4. Modifica la estructura de la base de datos, para guardar un campo imagen en la tabla deportes. 
Tienes que hacerlo sin borrar las filas que ya tienes.*/

--- EXPLICACIÓN ----
/* Añadimos el campo imagen a la tabla deportes. Lo ponemos NULL para que no tengamos que eliminar o modificar las filas
ya existentes. Las filas existentes obtienen el valor NULL en el nuevo campo imagen */

ALTER TABLE deportes
ADD imagen LONGBLOB NULL;

/*Modificar el campo imagen para que nos guarde la ruta de archivos en vez de la imagen*/

ALTER TABLE deportes
MODIFY COLUMN imagen VARCHAR(250) NULL;

/* Añadir un índice único en el campo email, de manera que no se pueda repetir y podamos ganar rendimiento en búsquedas*/
--- EXPLICACIÓN ---
/* Al intentar añadir el índice nos sale error, ya que hay correos repetidos*/
ALTER TABLE usuarios
ADD UNIQUE INDEX idx_correo(correo);



/* Añadir el campo precio (Precio del deporte) a la tabla deportes*/
-- EXPLICACION ---
/* Como en mysql no existe el tipo de dato SMALLMONEY, utilizamos DECIMAL (4,2), 5 dígitos máximos y 2 en la parte decimal.
Lo ponemos NULL para las filas que ya existen*/
ALTER TABLE deportes
ADD precio DECIMAL (5,2) NULL

/*Añadirle un valor por defecto al precio*/
ALTER TABLE deportes
MODIFY COLUMN precio DECIMAL (5,2) NOT NULL DEFAULT 20.50;

/* Añadimos la constraint chk_precio, a la que le asignamos la restricción check para que los precios siempre sean mayor o igual a 20*/

ALTER TABLE deportes
ADD CONSTRAINT chk_precio CHECK (precio>=20);


