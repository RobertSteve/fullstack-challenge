
# Talently Fullstack Challenge

El objetivo del reto es hacer un tablero kanban con sólo 3 columnas (buffer, working y done). con las siguientes características:
- Antes de ingresar al tablero debe existir un registro y autenticación del usuario.   (Los datos a considerar son name, email y password)
- Cada card debe pertenecer en base de datos a un usuario
- Se debe poder agregar tarjetas. Las tarjetas tendrán nombre y una fecha de entrega.   
- Al lado derecho de los textos de las columnas buffer, working y done, debe aparecer la cantidad de tarjetas de la columna.   
- Al hacer click al card se podrá editar los valores.
- Al mover la tarjeta a done. Debe aparecer un popup que diga "Felicitaciones por lograrlo!"   
- El dashboard debe iniciar con los siguientes cards:
   - 1 card en buffer con el nombre "Agregar subtareas al kanban".
   - 1 card en working con el nombre "Testing Kanban".
- Si la fecha de entrega ingresada en el card es menor a la fecha de hoy, las letras del card se pintarán de rojo.   

Referencia del diseño 
![Kanban-board](https://user-images.githubusercontent.com/11076563/128603762-e0433ea7-36ce-4550-925c-eb68dea8e363.png)

## Especificaciones técnicas para el proyecto:
- El proyecto base debe ser laravel framework en su versión 6
- El frontend será un SPA dentro de laravel con componentes Vue
- Los estados del frontend serán manejados por vuex
- Antes de ingresar al kanban debe existir un login, de otra forma no se puede acceder al tablero
- El esquema de base de datos debe estar reflejado en las migraciones de laravel
- Los cards predefinidos deben estar en seeders de laravel
- Se acepta el uso de librerias para backend y frontend

# Entregable o Expectativa del reto
- El reto tiene una duración de 72hrs (3 días) desde el momento que se recibe
- La limpieza y legibilidad del código será considerada.
- La validación del formulario será a criterio personal
- Será indispensable uso de principios S.O.L.I.D.
- La eficiencia del código en cuestiones de rendimiento sumarán para esta prueba. 
- Al finalizar el reto, enviar el enlace del fork de la solución a emmanuel.barturen@talently.tech con copia a cristian@talently.tech con título "Reto Frontend- Talently 2021-08"

## Recomendaciones
- Se recomienda el uso de paquetes de laravel para el registro y autenticación (Sanctum, Passport, etc)


# Preguntas de conocimiento
** Agregar las respuestas en el correo
1. Qué paquete o estrategia utilizarías para levantar un sistema de administración rápidamente? (Autenticación y CRUDs)
2. Una breve explicación de cómo laravel utiliza la injección de dependencias
3. En qué casos utilizarías un Query Scope?
4. Qué convenciones utilizas en la creación e implementación de migraciones?
5. Cuál es la diferencia entre sync, await y los promesa nativas de js?
6. Cómo utilizas las injecciones en nuxt?
7. Qué hooks de nuxts implementaríamos en esta solución si quisieramos enviar una notificación al terminar de compilar?
8. Nombrame 3 escenarios donde podríamos usar middlewares para esta solución? 


Pasos para la instalación
Windows
composer install
npm install
ni database/database.sqlite
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan serve

Linux y Mac
composer install
npm install
touch database/database.sqlite
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan serve