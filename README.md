# Sistema de encuestas para empleadores (SIEES)

## Descripción

Este proyecto es una aplicación web desarrollada con Laravel. Utilizamos Laravel
debido a su robusta arquitectura MVC y capacidades para crear aplicaciones web full-stack.

## Tecnologías utilizadas

- **Laravel**: Elegimos Laravel por su sintaxis expresiva y elegante, así como por su ecosistema de herramientas y paquetes que facilitan el desarrollo de aplicaciones web.
- **XAMPP**: Utilizamos XAMPP como nuestro entorno de desarrollo local porque es fácil de instalar y viene con PHP, Apache y MySQL, todo lo que necesitamos para desarrollar y probar nuestra aplicación Laravel.
- **MySQL**: Elegimos MySQL como nuestro sistema de gestión de bases de datos debido a su fiabilidad y eficiencia en el manejo de grandes conjuntos de datos.

## Instalación

### Instalación de Composer y dependencias

1. Descargue e instale Composer desde [https://getcomposer.org/download/](https://getcomposer.org/download/).
2. Navegue hasta el directorio del proyecto y ejecute el siguiente comando para instalar las dependencias de PHP:

```bash
composer install
```

### Instalación de dependencias de Node

Aunque no utilizamos Node.js en este proyecto, si desea instalar las dependencias de Node, puede hacerlo con el siguiente comando:

```bash
npm install
```

### Ejecución de migraciones y seeders

Para configurar la base de datos y llenarla con datos de prueba, ejecute los siguientes comandos:

```bash
php artisan migrate
php artisan db:seed
```
