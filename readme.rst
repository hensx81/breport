###################
Reporte de facturación
###################

Descripción

**************************
Cambios
**************************

Descripción

*******************
Requerimientos
*******************

PHP version 5.6 o mas nueva.
En debian 9 instalar los siguientes paquetes:

- apache2 php php-mysql php-gd php-mcrypt git

************
Instalación
************

- Clonar el repositorio en /var/www/html/ (git clone https://github.com/jefonseca/breport.git)
- Copiar el archivo de la carpeta config database.php.sample a database.php (cp breport/config/database.php.sample breport/config/database.php)
- Editar el archivo database.php y poner los datos de conexión a la base de datos
