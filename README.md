# Sistema de Gestión de Usuarios

Este es un sistema de gestión de usuarios desarrollado en Laravel 10 y utiliza una base de datos PostgreSQL. El sistema permite a los usuarios normales ver su propia información, registrar nuevos usuarios, editar y eliminar usuarios (solo para administradores). Además, cuenta con una API REST para acceder a los datos y un sistema de logs para registrar las actividades del sistema.

## Características

- Acceso de usuarios normales: Los usuarios normales pueden acceder al sistema y ver su propia información.

- Edición y eliminación de usuarios: Solo los administradores tienen los permisos para editar y eliminar usuarios.

- API REST: El sistema cuenta con una API REST que permite acceder a los datos de una api específica.

- Sistema de logs: Todas las actividades del sistema son registradas en un sistema de logs para fines de auditoría.

## Tecnologías utilizadas

- **Laravel 10:** Un potente framework PHP para el desarrollo de aplicaciones web.

- **PostgreSQL:** Un sistema de gestión de bases de datos relacional de código abierto.

- **Docker:** Se ha dockerizado la aplicación para facilitar el despliegue y la gestión del entorno.

## Requisitos

- **PHP 8.1:** Se requiere PHP 8.1 o una versión posterior para ejecutar esta aplicación.

## Instalación

Para instalar y ejecutar el sistema, sigue estos pasos:

1. Clona el repositorio desde GitHub.

2. Asegúrate de tener Docker instalado en tu sistema.

3. Crea un archivo `.env` a partir del archivo `.env.example` y configura las variables de entorno según tu configuración.

4. Ejecuta el siguiente comando para construir y levantar los contenedores de Docker:


docker-compose up -d


5. Ejecuta las migraciones para crear las tablas en la base de datos:


docker-compose exec app php artisan migrate --seed


6. Puedes acceder a la aplicación desde `http://localhost:8000`.

## Uso

Una vez que la aplicación esté instalada y funcionando, puedes acceder a las diferentes funcionalidades:

- **Acceso de usuarios:** Visita `http://localhost:8000/login` para acceder al sistema como usuario normal.

- **Registro de usuarios:** Visita `http://localhost:8000/registro` para registrar un nuevo usuario.

- **Administración de usuarios:** Visita `http://localhost:8000/usuarios` para acceder a la lista de usuarios y realizar acciones de edición y eliminación (solo para administradores).

- **API REST:** Puedes acceder a la API REST para obtener los datos de los posts en  `http://localhost:8000/apirest`

- **Logs:** Todos los logs de actividad se encuentran en la tabla logs de la base de datos.

## Contribuciones

Si deseas contribuir al desarrollo de este proyecto, siéntete libre de hacer fork del repositorio y enviar pull requests. También puedes abrir issues para reportar problemas o sugerir nuevas funcionalidades.

## Licencia

Este proyecto se encuentra bajo la Licencia MIT. Puedes consultar el archivo `LICENSE` para más información.

## Autor

Este proyecto ha sido desarrollado por Cristhian Alexis Castro Correa (cristhian9507@gmail.com).

¡Gracias por utilizar nuestro sistema de gestión de usuarios! Si tienes alguna pregunta o necesitas más ayuda, no dudes en contactarnos.
