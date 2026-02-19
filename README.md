# 🎰 Casino Backoffice PMK - Módulo de historial de notas

Este proyecto es una Prueba Técnica para PMK. Consiste en un sistema Backoffice desarrollado con **Laravel** y **Livewire 3** (con enfoque SPA) que permite a los agentes del casino gestionar y visualizar las notas de los jugadores.

## 🚀 Tecnologías y Arquitectura
- **Framework:** Laravel 10+ (PHP 8+)
- **Frontend:** Livewire 3 (Single Page Application)
- **Estilos:** Tailwind CSS
- **Arquitectura:** Patrón Repositorio (Repository Pattern) y Domain-Driven Design.
- **Seguridad:** Control de Acceso Basado en Roles (RBAC) mediante Laravel Gates.

---

## 🔐 Credenciales de Acceso Rápido

Para facilitar la revisión del proyecto, el sistema genera automáticamente dos perfiles con distintos niveles de permisos al correr las migraciones. 

Puedes iniciar sesión con cualquiera de los siguientes:

| Rol | Permisos | Correo Electrónico | Contraseña |
| :--- | :--- | :--- | :--- |
| **Agente Pro** (Supervisor) | Lectura y Escritura (Puede crear notas) | `agentsupervisor@casino.com` | `12345678` |
| **Agente Standar** (Junior) | Solo Lectura (No ve el formulario) | `agentjunior@casino.com` | `12345678` |

---

## ⚙️ Instrucciones de Instalación

Sigue estos pasos para levantar el proyecto localmente:

1. **Clonar el repositorio:**
```bash
git clone [https://github.com/arimadrid2000/Players-Notes-PMK.git](https://github.com/arimadrid2000/Players-Notes-PMK.git)
cd Players-Notes-PMK
```

2. **Instalar dependencias de PHP:**
```bash
composer install
```

3. **Configurar el entorno (.env):**
Copia el archivo de ejemplo y crea tu propio `.env`:
```bash
cp .env.example .env
```
*Asegúrate de configurar tus credenciales de base de datos en el archivo `.env` (y de que la base de datos `players_notes_pmk` exista en tu gestor MySQL).*

4. **Generar la clave de la aplicación:**
```bash
php artisan key:generate
```

5. **Ejecutar Migraciones y Seeders (¡Importante!):**
Esto creará las tablas, los roles, los jugadores de prueba y los usuarios para el inicio de sesión.

 - Al ejecutar por primera vez
```bash
php artisan migrate --seed
```

 - Para refrescar tablas y datos de seeders
```bash
php artisan migrate:fresh --seed
```

6. **Levantar el servidor local:**
```bash
php artisan serve
```
*El proyecto estará disponible en [http://localhost:8000](http://localhost:8000)*

---

## 🧪 Pruebas Automatizadas (Feature Tests)

El proyecto incluye pruebas integradas para verificar el correcto funcionamiento de los componentes críticos. Para ejecutarlas, corre el siguiente comando en la terminal:

```bash
php artisan test
```

Las pruebas verifican:
- Autenticación correcta e incorrecta en el componente de Login (`AgentSelectorTest`).
- Validación de caracteres, comprobación de permisos de Roles y guardado exitoso en la base de datos (`NoteFormTest`).
