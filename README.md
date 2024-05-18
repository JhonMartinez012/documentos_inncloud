## Pasos para desplegar Backend
1. Con un servicio apache como xampp copie el proyecto en su carpeta htdoc
2. Ejecute php composer install
3. Crear en la raiz de el proyecto el archivo .env y copiar lo que esta en .env.example en este.
4. En el servicio de phpmyadmin de xampp cree una base de datos llamada documentos_innclod
5. Ejecute el comando php artisan migrade --seed, esto permite migrar las tablas y registros iniciales para el funcionamiento de la aplicacion.
6. Ejecute el comando php artisan serve para iniciar el servidor de la aplicacion


## Datos de acceso
usuario: innclod@mail.com
contraseña: 12341234

