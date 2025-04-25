# 🧼 Proyecto Base Laravel + AdminLTE

Starter Kit desarrollado por **Ing. Iver Guerrero Ortiz**, Gerente y CEO de **SIT BOLIVIA**, diseñado para servir como base en el desarrollo de nuevos sistemas web. Este proyecto incluye:

- Laravel 10.x
- AdminLTE 3.x
- Autenticación de usuarios
- Gestión de roles y permisos (Spatie)
- Generación de PDFs
- Estructura organizada y limpia
- Listo para escalar o adaptar a cualquier rubro

---

## ⚙️ Requisitos

- PHP >= 8.2
- Composer
- Node.js y NPM
- MySQL o MariaDB
- Git

---

## 🚀 Pasos para instalar

```bash
# 1. Clona el repositorio
git clone https://github.com/tuusuario/tu-proyecto.git nombre-del-proyecto

cd nombre-del-proyecto

# 2. Instala las dependencias de Laravel
composer install

# 3. Copia el archivo de entorno y configura
cp .env.example .env

# 4. Genera la clave de aplicación
php artisan key:generate

# 5. Configura la base de datos en el archivo .env

# 6. Ejecuta las migraciones y seeders
php artisan migrate --seed

# 7. Instala dependencias de frontend (AdminLTE)
npm install && npm run dev

# 8. Levanta el servidor local
php artisan serve
