# 🏢 Acroware - Sistema de Gestión de Activos

[![PHP](https://img.shields.io/badge/PHP-7.4%2B-8892BF.svg)](https://www.php.net)
[![MySQL](https://img.shields.io/badge/MySQL-5.7%2B-4479A1.svg)](https://www.mysql.com)
[![HTML](https://img.shields.io/badge/HTML5-Structured-orange.svg)](https://developer.mozilla.org/en-US/docs/Web/Guide/HTML/HTML5)
[![CSS](https://img.shields.io/badge/CSS3-Styled-264de4.svg)](https://developer.mozilla.org/en-US/docs/Web/CSS)
[![JavaScript](https://img.shields.io/badge/JavaScript-ES6%2B-F7DF1E.svg?logo=javascript&logoColor=black)](https://developer.mozilla.org/en-US/docs/Web/JavaScript)

**Acroware** es una plataforma integral de gestión de activos desarrollada en PHP que permite a las organizaciones administrar eficientemente tanto activos de TI (equipos informáticos) como activos móviles (mobiliario y suministros). El sistema cuenta con funcionalidades avanzadas de gestión de usuarios, autenticación segura y notificaciones por correo electrónico automatizadas.

---

## 📋 Tabla de Contenidos

- [🏢 Acroware - Sistema de Gestión de Activos](#-acroware---sistema-de-gestión-de-activos)
  - [📋 Tabla de Contenidos](#-tabla-de-contenidos)
  - [📌 Características principales](#-características-principales)
  - [🛠️ Requisitos previos](#️-requisitos-previos)
  - [📦 Instalación](#-instalación)
    - [1. Clonar el repositorio](#1-clonar-el-repositorio)
    - [2. Instalar dependencias](#2-instalar-dependencias)
    - [3. Configurar la base de datos](#3-configurar-la-base-de-datos)
    - [4. Configurar archivos de entorno](#4-configurar-archivos-de-entorno)
    - [5. Configurar permisos](#5-configurar-permisos)
  - [📁 Estructura del proyecto](#-estructura-del-proyecto)
    - [📂 Descripción detallada de módulos](#-descripción-detallada-de-módulos)
  - [⚙️ Configuración](#️-configuración)
    - [Configuración de base de datos](#configuración-de-base-de-datos)
    - [Configuración OAuth2](#configuración-oauth2)
  - [🚀 Uso](#-uso)
    - [API de Gestión de Activos Informáticos](#api-de-gestión-de-activos-informáticos)
      - [Listar usuarios destino](#listar-usuarios-destino)
      - [Listar activos por custodio](#listar-activos-por-custodio)
      - [Transferir activos](#transferir-activos)
    - [API de Gestión de Usuarios](#api-de-gestión-de-usuarios)
      - [Obtener usuarios (DataTables)](#obtener-usuarios-datatables)
      - [Crear usuario](#crear-usuario)
      - [Actualizar usuario](#actualizar-usuario)
      - [Eliminar usuario (soft delete)](#eliminar-usuario-soft-delete)
  - [🔧 Arquitectura del sistema](#-arquitectura-del-sistema)
    - [Patrones de diseño implementados](#patrones-de-diseño-implementados)
    - [Componentes principales](#componentes-principales)
  - [🧪 Validación y seguridad](#-validación-y-seguridad)
    - [Sanitización de entrada](#sanitización-de-entrada)
    - [Medidas de seguridad implementadas](#medidas-de-seguridad-implementadas)
  - [🐞 Solución de problemas](#-solución-de-problemas)
    - [❌ Error de conexión a base de datos](#-error-de-conexión-a-base-de-datos)
    - [❌ Error en envío de correos](#-error-en-envío-de-correos)
    - [❌ Error 409 en operaciones de usuarios](#-error-409-en-operaciones-de-usuarios)
    - [❌ Operación no válida](#-operación-no-válida)
  - [📄 Respuestas de API](#-respuestas-de-api)
    - [Formato de respuesta exitosa](#formato-de-respuesta-exitosa)
    - [Formato de respuesta de error](#formato-de-respuesta-de-error)
    - [Códigos de estado HTTP](#códigos-de-estado-http)
  - [🌐 Soporte de idiomas](#-soporte-de-idiomas)
  - [⚠️ Limitaciones](#️-limitaciones)
  - [🤝 Contribución](#-contribución)
    - [Estándares de código](#estándares-de-código)
  - [📄 Licencia](#-licencia)

---

## 📌 Características principales

- ✅ **Gestión dual de activos**: Manejo separado de activos informáticos y mobiliarios
- 🔄 **Transferencias masivas**: Reasignación eficiente de múltiples activos entre custodios
- ⚙️ **Sistema de usuarios robusto**: CRUD completo con validación y control de acceso
- 📧 **Integración de correo**: PHPMailer v6.9.1 con soporte OAuth2 para múltiples proveedores
- 🌐 **Internacionalización**: Soporte para más de 40 idiomas
- 🔐 **Autenticación segura**: OAuth2 con Google, Microsoft, Azure y Yahoo
- 📊 **API RESTful**: Endpoints estandarizados con respuestas JSON
- 🛡️ **Seguridad avanzada**: Sanitización de entrada y protección contra inyección de headers

---

## 🛠️ Requisitos previos

- **PHP** >= 5.5.0
- **Extensiones PHP requeridas:**
  - `ext-ctype` - Funciones de verificación de tipos de caracteres
  - `ext-filter` - Validación y sanitización de entrada
  - `ext-hash` - Funciones hash criptográficas
- **Extensiones PHP opcionales:**
  - `ext-mbstring` - Manejo de cadenas multibyte
  - `ext-openssl` - Soporte para firmas DKIM y S/MIME
  - `ext-intl` - Soporte de internacionalización
- **Base de datos** compatible con PDO
- **Composer** para gestión de dependencias
- **Servidor web** (Apache/Nginx)

---

## 📦 Instalación

### 1. Clonar el repositorio
```bash
git clone <repository-url>
cd acroware
```

### 2. Instalar dependencias
```bash
composer install
```

### 3. Configurar la base de datos
```sql
CREATE DATABASE acroware_db;
```

### 4. Configurar archivos de entorno
Crear archivo de configuración de base de datos y SMTP según tu entorno.

### 5. Configurar permisos
```bash
chmod 755 Acciones/
chmod 644 Acciones/*.php
```

---

## 📁 Estructura del proyecto

```
Acroware/
├── Acciones/                        # Lógica de negocio y APIs
│   ├── PHPMailer/                   # Biblioteca de correo electrónico
│   │   ├── language/                # Archivos de idioma (40+ idiomas)
│   │   ├── src/                     # Código fuente de PHPMailer
│   │   ├── composer.json            # Dependencias de PHPMailer
│   │   ├── get_oauth_token.php      # Utilidad OAuth2
│   │   └── README.md                # Documentación de PHPMailer
│   ├── AccionesExtrasBi.php         # API de operaciones de activos informáticos
│   ├── AccionesExtrasBm.php         # API de operaciones de activos mobiliarios
│   ├── CargarUbicaciones.php        # API de gestión de ubicaciones
│   ├── CrudUsuarios.php             # API CRUD de usuarios
│   └── DetallesInformaticos.php     # API de detalles de activos IT
├── css/                             # Hojas de estilo
│   ├── maps/                        # Source maps de CSS
│   │   └── vertical-layout-light/   # Maps del tema principal
│   └── vertical-layout-light/       # Tema principal de la aplicación
├── fonts/                           # Fuentes tipográficas
│   ├── Black/                       # Fuente Black
│   ├── Manrope/                     # Fuente Manrope
│   ├── Monospace/                   # Fuente Monospace
│   ├── Nunito/                      # Fuente Nunito
│   └── Roboto/                      # Fuente Roboto
├── images/                          # Recursos gráficos
│   ├── background/                  # Imágenes de fondo
│   ├── dashboard/                   # Gráficos del dashboard
│   ├── faces/                       # Avatares de usuario
│   ├── file-icons/                  # Iconos de archivos
│   │   ├── 128/                     # Iconos 128x128px
│   │   ├── 256/                     # Iconos 256x256px
│   │   ├── 512/                     # Iconos 512x512px
│   │   └── 64/                      # Iconos 64x64px
│   ├── logos/                       # Logotipos del sistema
│   ├── samples/                     # Imágenes de muestra
│   │   ├── 1280x768/               # Muestras alta resolución
│   │   └── 300x300/                # Muestras resolución media
│   └── sprites/                     # Sprites de iconos
├── js/                              # Scripts JavaScript
├── pages/                           # Páginas de la aplicación
│   ├── charts/                      # Páginas de gráficos
│   ├── documentation/               # Documentación del sistema
│   ├── forms/                       # Formularios
│   ├── icons/                       # Páginas de iconos
│   ├── samples/                     # Páginas de ejemplo
│   ├── tables/                      # Tablas de datos
│   └── ui-features/                 # Elementos de interfaz
├── partials/                        # Componentes reutilizables
├── scss/                            # Archivos SASS/SCSS
│   ├── common/                      # Estilos comunes
│   │   ├── dark/                    # Tema oscuro
│   │   │   ├── components/          # Componentes tema oscuro
│   │   │   │   ├── loaders/         # Cargadores tema oscuro
│   │   │   │   ├── mail-components/ # Componentes de correo tema oscuro
│   │   │   │   └── plugin-overrides/# Overrides de plugins tema oscuro
│   │   │   ├── landing-screens/     # Pantallas de inicio tema oscuro
│   │   │   └── mixins/              # Mixins tema oscuro
│   │   └── light/                   # Tema claro
│   │       ├── components/          # Componentes tema claro
│   │       │   ├── loaders/         # Cargadores tema claro
│   │       │   ├── mail-components/ # Componentes de correo tema claro
│   │       │   └── plugin-overrides/# Overrides de plugins tema claro
│   │       ├── landing-screens/     # Pantallas de inicio tema claro
│   │       └── mixins/              # Mixins tema claro
│   ├── fonts/                       # Fuentes en SCSS
│   │   └── Manrope/                 # Definiciones de Manrope
│   └── vertical-layout-light/       # SCSS del layout principal
└── README.md                        # Este archivo
```

### 📂 Descripción detallada de módulos

| 📁 Carpeta / Archivo                  | 📌 Descripción                                                                                       |
|--------------------------------------|------------------------------------------------------------------------------------------------------|
| `Acciones/`                          | Contiene la lógica del backend en PHP y los servicios API del sistema.                              |
| ├── `PHPMailer/`                     | Biblioteca externa para envío de correos con soporte multilenguaje y OAuth2.                         |
| ├── `AccionesExtrasBi.php`           | API para operaciones sobre activos informáticos.                                                    |
| ├── `AccionesExtrasBm.php`           | API para operaciones sobre activos mobiliarios.                                                     |
| ├── `CargarUbicaciones.php`          | API para gestión y actualización de ubicaciones.                                                    |
| ├── `CrudUsuarios.php`              | API para operaciones CRUD de usuarios.                                                              |
| └── `DetallesInformaticos.php`       | API para obtener detalles de activos tecnológicos.                                                  |
| `css/`                               | Hojas de estilo de la aplicación.                                                                   |
| ├── `maps/`                          | Source maps para depuración de estilos.                                                             |
| └── `vertical-layout-light/`         | Estilos principales del tema claro del sistema.                                                     |
| `fonts/`                             | Fuentes tipográficas utilizadas en la interfaz.                                                     |
| ├── `Black/`, `Manrope/`, etc.       | Carpetas de distintas familias tipográficas.                                                        |
| `images/`                            | Recursos gráficos del sistema organizados por tipo.                                                 |
| ├── `background/`                    | Imágenes de fondo.                                                                                  |
| ├── `dashboard/`                     | Elementos visuales del dashboard.                                                                   |
| ├── `faces/`                         | Avatares de usuario.                                                                                |
| ├── `file-icons/`                    | Iconos representativos de archivos (64x64, 128x128, etc.).                                          |
| ├── `logos/`                         | Logotipos del sistema.                                                                              |
| ├── `samples/`                       | Imágenes de muestra para testing o demostraciones.                                                  |
| └── `sprites/`                       | Sprites de iconos utilizados en UI.                                                                 |
| `js/`                                | Scripts JavaScript para funcionalidades del frontend.                                               |
| `pages/`                             | Páginas HTML estructuradas por funcionalidades.                                                     |
| ├── `charts/`                        | Páginas relacionadas con gráficos y estadísticas.                                                   |
| ├── `documentation/`                 | Secciones de ayuda o manuales del sistema.                                                          |
| ├── `forms/`                         | Formularios para distintas operaciones.                                                             |
| ├── `icons/`                         | Páginas para previsualizar iconos disponibles.                                                      |
| ├── `samples/`                       | Ejemplos y plantillas base.                                                                         |
| ├── `tables/`                        | Visualización y gestión de datos en forma tabular.                                                  |
| └── `ui-features/`                   | Elementos gráficos y de experiencia de usuario.                                                     |
| `partials/`                          | Componentes HTML reutilizables como headers, sidebars o footers.                                   |
| `scss/`                              | Código fuente en SCSS/SASS para estilos personalizados.                                             |
| ├── `common/`                        | Estructura base dividida en tema claro y oscuro.                                                    |
| │ ├── `dark/`                        | Estilos y componentes para tema oscuro.                                                             |
| │ │ ├── `components/`, `mixins/`    | Módulos SCSS del tema oscuro.                                                                       |
| │ └── `light/`                       | Estilos y componentes para tema claro.                                                              |
| ├── `fonts/Manrope/`                 | Definiciones tipográficas en SCSS para Manrope.                                                     |
| └── `vertical-layout-light/`         | Estilos SCSS específicos para el layout principal.                                                  |
| `README.md`                          | Archivo principal de documentación del proyecto.                                                    |

> ℹ️ **Nota:** Las carpetas como `PHPMailer/` o `scss/common/` están estructuradas modularmente para facilitar la extensión, personalización y mantenimiento del sistema.


---

## ⚙️ Configuración

### Configuración de base de datos
Crear las siguientes tablas en tu base de datos:

```sql
-- Tabla de usuarios/custodios
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    cedula VARCHAR(20) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    rol VARCHAR(50) NOT NULL,
    activo ENUM('si', 'no') DEFAULT 'si'
);

-- Tabla de activos informáticos
CREATE TABLE bienes_informaticos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    custodio_id INT,
    ubicacion_id INT,
    -- otros campos específicos de activos IT
    FOREIGN KEY (custodio_id) REFERENCES usuarios(id)
);

-- Tabla de activos mobiliarios
CREATE TABLE bienes_mobiliarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    custodio_id INT,
    ubicacion_id INT,
    -- otros campos específicos de activos mobiliarios
    FOREIGN KEY (custodio_id) REFERENCES usuarios(id)
);

-- Tabla de ubicaciones
CREATE TABLE ubicaciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    area_id INT
);

-- Tabla de áreas
CREATE TABLE areas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    id_usu_encargado INT,
    FOREIGN KEY (id_usu_encargado) REFERENCES usuarios(id)
);
```

### Configuración OAuth2
Para configurar la autenticación OAuth2, utiliza el archivo `get_oauth_token.php`:

```php
// Configurar credenciales OAuth2 para cada proveedor
$providers = [
    'Google' => [
        'clientId' => 'tu_client_id',
        'clientSecret' => 'tu_client_secret'
    ],
    'Microsoft' => [
        'clientId' => 'tu_client_id',
        'clientSecret' => 'tu_client_secret'
    ]
    // ... otros proveedores
];
```

---

## 🚀 Uso

### API de Gestión de Activos Informáticos

#### Listar usuarios destino
```http
GET /Acciones/AccionesExtrasBi.php?op=2&usuario_id=123
```

#### Listar activos por custodio
```http
GET /Acciones/AccionesExtrasBi.php?op=3&custodio_id=456
```

#### Transferir activos
```http
PUT /Acciones/AccionesExtrasBi.php
Content-Type: application/json

{
    "bienes": [1, 2, 3],
    "custodioDestino": 789
}
```

### API de Gestión de Usuarios

#### Obtener usuarios (DataTables)
```http
GET /Acciones/CrudUsuarios.php?start=0&length=10&search[value]=juan
```

#### Crear usuario
```http
POST /Acciones/CrudUsuarios.php
Content-Type: application/json

{
    "nombre": "Juan",
    "apellido": "Pérez",
    "cedula": "1234567890",
    "email": "juan@ejemplo.com",
    "rol": "administrador",
    "psswd": "contraseña_segura"
}
```

#### Actualizar usuario
```http
PUT /Acciones/CrudUsuarios.php
Content-Type: application/json

{
    "id": 1,
    "email": "nuevo_email@ejemplo.com",
    "rol": "usuario"
}
```

#### Eliminar usuario (soft delete)
```http
DELETE /Acciones/CrudUsuarios.php?id=1
```

---

## 🔧 Arquitectura del sistema

### Patrones de diseño implementados

- **Singleton**: Para conexiones de base de datos y sesiones
- **Factory**: Para creación de instancias de clases de operación
- **API RESTful**: Con métodos HTTP estándar y respuestas JSON
- **Separación de responsabilidades**: Módulos independientes para cada funcionalidad

### Componentes principales

| Componente | Responsabilidad |
|------------|-----------------|
| **AccionesExtrasBi.php** | Operaciones específicas de activos informáticos |
| **AccionesExtrasBm.php** | Operaciones específicas de activos mobiliarios |
| **CrudUsuarios.php** | Gestión completa de usuarios (CRUD) |
| **CargarUbicaciones.php** | Gestión de ubicaciones y áreas |
| **PHPMailer/** | Sistema de correo electrónico integrado |

---

## 🧪 Validación y seguridad

### Sanitización de entrada
Todos los endpoints implementan sanitización consistente:

```php
$usuario_id = filter_var($_GET['usuario_id'], FILTER_SANITIZE_STRING);
$custodio_id = filter_var($_GET['custodio_id'], FILTER_SANITIZE_NUMBER_INT);
$nombre = htmlspecialchars($data["nombre"]);
```

### Medidas de seguridad implementadas

- ✅ Sanitización de entrada con filtros PHP
- ✅ Validación de unicidad de datos críticos
- ✅ Protección contra inyección de headers de correo
- ✅ Autenticación OAuth2 segura
- ✅ Eliminación suave para preservar integridad referencial
- ✅ Validación de dependencias antes de eliminaciones

---

## 🐞 Solución de problemas

### ❌ Error de conexión a base de datos
- Verifica las credenciales de conexión
- Confirma que el servidor de base de datos esté activo
- Revisa los permisos de usuario en la base de datos

### ❌ Error en envío de correos
- Verifica la configuración SMTP
- Confirma que las credenciales OAuth2 sean correctas
- Revisa que las extensiones PHP necesarias estén habilitadas

### ❌ Error 409 en operaciones de usuarios
- El email o cédula ya existe en el sistema
- Utiliza valores únicos para estos campos

### ❌ Operación no válida
- Verifica que el parámetro `op` sea válido (2 o 3)
- Confirma que estés usando el método HTTP correcto

---

## 📄 Respuestas de API

### Formato de respuesta exitosa
```json
{
    "success": true,
    "data": [...],
    "message": "Operación completada exitosamente"
}
```

### Formato de respuesta de error
```json
{
    "codigo": 1,
    "mensaje": "Descripción del error",
    "error": "Detalles técnicos del error"
}
```

### Códigos de estado HTTP

| Código | Significado | Contexto |
|--------|-------------|----------|
| **200** | Éxito | Operación completada correctamente |
| **409** | Conflicto | Datos duplicados (email/cédula) |
| **400** | Solicitud incorrecta | Parámetros faltantes o inválidos |

---

## 🌐 Soporte de idiomas

PHPMailer incluye soporte para más de 40 idiomas:

```php
$mail->setLanguage('es', '/ruta/opcional/idiomas/');
$mail->setLanguage('en', '/ruta/opcional/idiomas/');
$mail->setLanguage('fr', '/ruta/opcional/idiomas/');
// ... más idiomas disponibles
```

---

## ⚠️ Limitaciones

- **PHP mínimo**: Requiere PHP 5.5.0 o superior
- **Dependencias**: Necesita extensiones específicas de PHP
- **Base de datos**: Compatible solo con sistemas PDO
- **OAuth2**: Requiere configuración manual de credenciales
- **Eliminación**: Solo eliminación suave para mantener integridad referencial

---

## 🤝 Contribución

¿Te gustaría contribuir al proyecto Acroware?

- 🐛 **Reporta errores** abriendo un issue detallado
- ✨ **Propón mejoras** o nuevas funcionalidades
- 🔧 **Envía pull requests** siguiendo las convenciones del código
- 📖 **Mejora la documentación** con ejemplos adicionales

### Estándares de código
- Usar sangría de 4 espacios
- Sanitizar todas las entradas de usuario
- Implementar manejo de errores consistente
- Documentar funciones y métodos complejos

---

## 📄 Licencia

Este proyecto incorpora PHPMailer bajo la **licencia LGPL 2.1** con el Compromiso de Cooperación GPL, garantizando el cumplimiento legal para implementación empresarial.

El código base de Acroware está disponible para uso institucional con las consideraciones de licencia correspondientes.

---

**Desarrollado con ❤️ para la gestión eficiente de activos organizacionales**

<div align="center">

**[⬆ Volver al inicio](#-acroware---sistema-de-gestión-de-activos)**

</div>
