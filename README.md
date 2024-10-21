# TPE1WEB2

## Objetivos

El objetivo de esta entrega es desarrollar una base de datos para una aplicación de transporte en colectivo. La aplicación permitirá a los usuarios reservar pasajes, seleccionando entre los viajes en colectivo que están cargados en nuestra base de datos.




## Developers

-Mensa Matias
-Tobares Felipe


## Diagrama
![image](https://github.com/user-attachments/assets/4c9a7d96-700e-4810-9602-7e3a943e6d5a)

## Pasos para el Despliegue
1. Copiar el Proyecto:

Descargar el proyecto y colócarlo en la carpeta htdocs de XAMPP 
C:/xampp/htdocs/tpweb2grupo146

2. Configurar Base de Datos:

Crear una nueva base de datos llamada tpweb2grupo146.
Importar el archivo tpweb2grupo146.sql que viene con el proyecto.

3. Configurar Credenciales de Base de Datos:

En el archivo modelo/db.php, ajustar las credenciales de conexión a la base de datos:

$this->conexion = new PDO('mysql:host=localhost;dbname=tpweb2grupo146', 'root', '');

4. Iniciar Apache y MySQL:

5. Acceder al Sitio:

Abrir el navegador y acceder a:

http://localhost/tpweb2grupo146/
Usuario Administrador
Usuario: webadmin
Contraseña: admin
