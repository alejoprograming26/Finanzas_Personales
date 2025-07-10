<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>
![Image_Alt](https://github.com/alejoprograming26/Finanzas_Personales/blob/cf2075244315791a6c1f33db68e617d0e4115f54/Captura%20de%20pantalla%202025-07-10%20121216.png)
# Proyecto de Finanzas Personales

Este es un sistema de **Finanzas Personales** desarrollado con [Laravel](https://laravel.com/), utilizando la librería [Filament](https://filamentphp.com/) para la administración y [MySQL](https://www.mysql.com/) como base de datos.

## Funcionalidades

- Registro y autenticación de usuarios.
- Gestión de ingresos y egresos.
- Clasificación de movimientos por categorías personalizables.
- Visualización de reportes y gráficos de gastos e ingresos.
- Panel de administración intuitivo gracias a Filament.
- Soporte para múltiples cuentas y monedas.
- Notificaciones y recordatorios de pagos.

## Tecnologías Utilizadas

- **Backend:** Laravel 10+
- **Frontend Admin:** Filament PHP
- **Base de datos:** MySQL
- **Gráficos:** Chart.js (integrado en Filament)
- **Autenticación:** Laravel Breeze/Jetstream (según configuración)

## Instalación

1. Clona el repositorio:
   ```bash
   git clone https://github.com/alejoprograming26/finanzas-personales.git
   cd finanzas-personales
   ```
2. Instala dependencias:
   ```bash
   composer install
   npm install && npm run build
   ```
3. Copia el archivo de entorno y configura tus variables:

   ```bash
   cp .env.example .env
   ```

   Configura la conexión a tu base de datos MySQL en `.env`.

4. Genera la clave de la aplicación:

   ```bash
   php artisan key:generate
   ```

5. Ejecuta las migraciones:

   ```bash
   php artisan migrate
   ```

6. (Opcional) Si usas seeders:

   ```bash
   php artisan db:seed
   ```

7. Inicia el servidor:

   ```bash
   php artisan serve
   ```

8. Accede a la interfaz de administración en `/admin`.

## Uso

- Ingresa con tu usuario.
- Registra tus ingresos y egresos.
- Consulta tus reportes y gráficos en el panel de control.
- Personaliza categorías y cuentas según tus necesidades.

## Contribuir

¿Quieres mejorar el proyecto? ¡Las contribuciones son bienvenidas! Por favor, abre un issue o un pull request.

Desarrollado con ❤️ usando Laravel y Filament.
