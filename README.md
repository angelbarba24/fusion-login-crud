# 🏎️ F1 Management System (MVC + Login Seguro)

![PHP Version](https://img.shields.io/badge/PHP-8.0%2B-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white)

Un sistema de gestión de escuderías de Fórmula 1 desarrollado en **PHP nativo** utilizando el patrón de arquitectura **MVC (Modelo-Vista-Controlador)**.

Este proyecto es el resultado de la fusión de un **Sistema de Autenticación Seguro** y un **CRUD de Gestión Deportiva**, creando una aplicación web robusta, segura y escalable.

---

## 🚀 Características Principales

### 🔒 Seguridad (Login Module)
* **Autenticación Robusta:** Verificación de credenciales con hashing de contraseñas (`password_hash` / `password_verify`).
* **Protección Anti-Fuerza Bruta:** Bloqueo temporal de la cuenta tras 5 intentos fallidos.
* **Seguridad de Sesiones:** Regeneración de ID de sesión y cookies seguras (`HttpOnly`, `SameSite`, `Secure`).
* **Protección CSRF:** Tokens únicos por sesión para evitar falsificación de peticiones en sitios cruzados.
* **Bloqueo de Vistas:** Redirección automática al login si se intenta acceder a una vista o archivo directamente sin sesión.

### 🏎️ Gestión (F1 Module)
* **CRUD Completo:** Crear, Leer, Actualizar y Borrar escuderías.
* **Interfaz Moderna:** Diseño "Dark Mode" inspirado en la estética oficial de la F1, construido con Bootstrap 5.
* **Arquitectura MVC:** Separación clara de la lógica de negocio, acceso a datos e interfaz de usuario.
* **Router Centralizado:** Un único punto de entrada (`index.php`) que gestiona todas las peticiones.

---

## 🛠️ Estructura del Proyecto

El proyecto sigue una estructura MVC estricta:

```text
/proyecto-f1/
├── config/
│   ├── Database.php            # Conexión a la BBDD con PDO
│   └── establecer-sesion.php   # Configuración de cookies y seguridad de sesión
├── controllers/
│   ├── AuthController.php      # Lógica de Login, Logout y Auth
│   └── EscuderiaController.php # Lógica del CRUD de F1
├── models/
│   ├── User.php                # Consultas relacionadas con Usuarios
│   └── Escuderia.php           # Consultas relacionadas con Escuderías
├── views/
│   ├── js/validaciones.js      # Validaciones frontend
│   ├── login.php               # Formulario de acceso
│   ├── listar.php              # Vista principal (Dashboard)
│   ├── crear.php               # Formulario de alta
│   └── editar.php              # Formulario de edición
└── index.php                   # Enrutador principal
