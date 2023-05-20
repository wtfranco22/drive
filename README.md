# Proyecto de Drive

Este proyecto es una aplicación web desarrollada con Laravel 10.x y Vue 3 que funciona como una API RESTful en el backend y utiliza Vue en el frontend. El proyecto está configurado con Vite 4.3 y utiliza MySQL como base de datos con servidor Apache.


## Requisitos previos

Asegúrate de tener las siguientes dependencias instaladas en tu sistema:

- Composer 2.5 o superior
- Node.js con npm (se recomienda la versión LTS)
- MySQL (con servidor Apache, como XAMPP)


## Clonar el proyecto

1. Cree una nueva carpeta en su sistema.

2. Abra una terminal y navegue hasta la ubicación de la carpeta recién creada.

3. Ejecute el siguiente comando para clonar el proyecto:

>>>>> git clone https://github.com/wtfranco22/drive.git


## Instalación

1. Navegue hasta la carpeta raíz del proyecto.

2. Instale las dependencias de Composer ejecutando el siguiente comando:

>>>>> composer install

3. A continuación, instale las dependencias de Node.js ejecutando el siguiente comando:

>>>>> npm install


## Configuración del entorno

1. Cree un nuevo archivo `.env` en la raíz del proyecto.

2. Copie y pegue el contenido del archivo `.env.example` en el nuevo archivo `.env`.

3. Genere una nueva clave de aplicación ejecutando el siguiente comando:

>>>>> php artisan key:generate


## Configuración de la base de datos

1. Asegúrese de tener MySQL y Apache en funcionamiento. Si está utilizando XAMPP, asegúrese de que esté ejecutándose.

2. Ejecute las migraciones y los seeders para crear la estructura de la base de datos y agregar datos de prueba ejecutando el siguiente comando:

>>>>> php artisan migrate --seed


## Ejecución

1. Abra dos terminales: una para ejecutar Vue y otra para ejecutar Laravel.

2. En la primera terminal, ejecute el siguiente comando para compilar y ejecutar el frontend con Vue:

>>>>> npm run dev

3. En la segunda terminal, ejecute el siguiente comando para iniciar el servidor de desarrollo de Laravel:

>>>>> php artisan serve



## Acceso a la aplicación

Una vez que haya completado los pasos anteriores, la aplicación estará disponible en [http://localhost:8000].

### Credenciales de prueba

Puede utilizar las siguientes credenciales de prueba para acceder a la aplicación:

- Rol de administrador:
- Correo electrónico: example@gmail.com
- Contraseña: admin123

- Rol de usuario:
- Correo electrónico: wtfranco22@gmail.com
- Contraseña: franco123

## Contribución

Si desea contribuir a este proyecto, puede seguir las siguientes pautas:

- Haga un fork del repositorio.
- Realice sus cambios en una rama separada.
- Envíe una solicitud de extracción (pull request) con sus cambios.

## Licencia

Este proyecto está bajo la [Licencia MIT](LICENSE).

## Contacto

Si tiene alguna pregunta o sugerencia, no dude en ponerse en contacto conmigo:

- Correo electrónico: example@gmail.com
- [GitHub](https://github.com/wtfranco22)
- [Whatsapp](+5492996017699)
