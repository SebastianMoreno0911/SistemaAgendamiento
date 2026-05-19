# 📅 Sistema de Agendamiento Virtual

[![Status](https://img.shields.io/badge/Status-Producción-success)](https://github.com/SebastianMoreno0911/SistemaAgendamiento)
[![Backend](https://img.shields.io/badge/Backend-PHP-777BB4)](https://github.com/SebastianMoreno0911/SistemaAgendamiento)
[![Style](https://img.shields.io/badge/Style-TailwindCSS-38B2AC)](https://github.com/SebastianMoreno0911/SistemaAgendamiento)
[![Database](https://img.shields.io/badge/Database-MySQL-4479A1)](https://github.com/SebastianMoreno0911/SistemaAgendamiento)
[![License](https://img.shields.io/badge/License-Académico-blue)](https://github.com/SebastianMoreno0911/SistemaAgendamiento)

Sistema web desarrollado en PHP para la gestión de citas virtuales, construido como mejora de una plataforma existente del sector de telecomunicaciones mediante ingeniería inversa.

🔗 Repositorio: https://github.com/SebastianMoreno0911/SistemaAgendamiento

---

## 📚 Funcionalidades

- **Agendar cita** — Registro de nueva cita seleccionando regional, ciudad, oficina, trámite, fecha y hora
- **Consultar citas** — Historial filtrado por estado (abiertas / cerradas)
- **Modificar cita** — Actualización de los datos de una cita existente
- **Cancelar cita** — Cambio de estado a *Cancelada* (sin eliminación física del registro)

---

## 🏗️ Arquitectura del Proyecto

```
SistemaAgendamiento/
├── config/
│   └── conexionDB.php       # Conexión a la BD mediante PDO
├── controllers/             # Lógica de negocio y operaciones CRUD
├── pages/                   # Vistas del sistema
├── layout/
│   ├── header.php           # Encabezado reutilizable
│   └── footer.php           # Pie de página reutilizable
├── database/
│   └── agendamiento.sql     # Script SQL con esquema y datos de prueba
└── index.php                # Punto de entrada principal
```

Diseño:
- Arquitectura en capas: presentación, lógica de negocio y acceso a datos
- Conexión segura mediante PDO con consultas preparadas (prevención de SQL Injection)
- Interfaz responsiva con Tailwind CSS
- Base de datos relacional normalizada hasta la **3FN**

---

## 🗃️ Base de Datos

La base de datos `agendamiento` contiene 7 tablas normalizadas:

| Tabla | Descripción |
|---|---|
| `usuarios` | Datos personales de los usuarios |
| `estados` | Estados posibles de una cita (Agendada, Cancelada, Incumplida, En curso, Finalizada) |
| `regionales` | 32 departamentos de Colombia |
| `tramites` | Tipos de trámite disponibles |
| `ciudades` | Ciudades con su regional asociada |
| `oficinas` | Puntos de atención por ciudad |
| `citas` | Registro central de citas agendadas |

---

## ⚙️ Requisitos

- XAMPP (Apache + MySQL)
- Navegador moderno (Chrome, Edge, Firefox, Safari)
- No requiere Node.js ni dependencias externas

---

## 🚀 Ejecución del Proyecto

### ✅ Ejecutar Localmente

1. Clona el repositorio:

```bash
git clone https://github.com/SebastianMoreno0911/SistemaAgendamiento.git
```

2. Copia la carpeta del proyecto en `htdocs/` de XAMPP

3. Inicia los módulos **Apache** y **MySQL** desde el panel de XAMPP

4. Abre **phpMyAdmin** e importa el archivo:

```
database/agendamiento.sql
```

5. Accede al sistema desde el navegador:

```
http://localhost/SistemaAgendamiento/
```

---

## 📘 ¿Cómo usar la aplicación?

1. Desde la pantalla de inicio, selecciona la acción deseada
2. Para **agendar**: ingresa tu número de documento, completa los datos y selecciona regional, ciudad, oficina, trámite, fecha y hora
3. Para **consultar**: ingresa tu documento y filtra por estado (abiertas / cerradas)
4. Para **modificar o cancelar**: busca tu cita con tu documento y número de cita, luego selecciona la acción

---

## 🧠 Fundamento Académico

Este proyecto aplica ingeniería inversa sobre una plataforma web real del sector de telecomunicaciones para proponer una versión mejorada en términos de UX y arquitectura de datos.

Conceptos aplicados:
- Ingeniería inversa de sistemas web
- Diseño y normalización de bases de datos relacionales (1FN, 2FN, 3FN)
- Programación backend con PHP y PDO
- Principios de experiencia de usuario (UX)
- Arquitectura en capas

---

## 🧪 Tecnologías Utilizadas

- PHP
- MySQL
- PDO (PHP Data Objects)
- Tailwind CSS
- XAMPP
- phpMyAdmin

---

## 🎓 Autor

Johan Sebastian Moreno Muñoz  
Estudiante de Ingeniería de Sistemas — Universidad Santiago de Cali

Proyecto académico — Desarrollo Web.

---

## 📝 Notas para el Docente

- Proyecto ejecutable localmente con XAMPP
- La base de datos está incluida en `database/agendamiento.sql`
- Importar el SQL en phpMyAdmin antes de ejecutar
- No requiere configuración adicional fuera de XAMPP
