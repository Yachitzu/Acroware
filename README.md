# ACROWARE

## Título
Gestión de inventario de Bienes Mobiliarios, Informáticos y de Software

## Descripción
Este proyecto tiene como objetivo desarrollar una plataforma digital para la gestión de inventarios de bienes materiales y software. El sistema permite a los administradores gestionar usuarios, bienes, ubicaciones, software, y generar informes detallados sobre el inventario. Su propósito es facilitar la administración y seguimiento de los activos en una organización, asegurando un control eficiente y seguro.

## Instrucciones de Instalación
### Requisitos Previos
Para utilizar este código, es necesario asegurarse de que el entorno **cumpla** con los siguientes **requisitos**:
- Servidor web compatible con PHP.
- PHP 7.0 o superior.
- Extension PDO de PHP habilitada.
- Base de datos MySQL.

Los siguientes archivos deben estar disponibles y correctamente configurados:
- **Conexion.php**: Implementación del patrón Singleton para la conexion a la base de datos. Modificación de credenciales.
- **Sesion.php**: Implementación del patrón Singleton para la gestión de sesiones.

### Pasos de Instalación
- **Clonar el repositorio**
  - git clone https://github.com/tuusuario/gestion-inventario.git
- ***Configurar la Base de Datos** 
  - Crear una base de datos en Mysql.
  - Importar el archivo *acrofin.sql* ubicado en la raiz del proyecto.
- **Configurar la Conexión a la Base de Datos**
  - Editar el archivo *Conexion.php* con las credenciales de la base de datos.
- **Configurar el Servidor Web**
  - Configurar tu servidor web (Apache, Nginx) para que apunte al directorio del proyecto.
## Guía de Uso
### Ingreso al sistema
- **Abrir el Navegador Web:** Ingresar la URL del sistema.
- **Inicio de Sesión:** Introducir el nombre de usuario y contraseña.
### Funcionalidades Principales
- **Gestión de Usuarios:** Registrar, autenticar y gestionar usuarios.
- **Gestión de Bienes:** Agregar, actualizar y eliminar bienes del inventarios.
- **Gestión de Ubicaciones:** Agregar, actualizar y eliminar lugares.
- **Gestión de Software:** Agregar, actualizar y eliminar software.
- **Generación de Informes:** Generar informes detallados.

## Contacto o Soporte
- **Contacto Principal:** Estefanía Mora (Gestora del Proyecto).
- **Email:** estefania.mora@gmail.com
  
## Estado del Proyecto
**Estado Actual:** Finalizado
**Notas de Estabilidad:** Actualmente en fase beta, funcionalidad básica implementada. Algunas áreas pueden necesitar mejoras y pruebas adicionales.

## Referencias 
- https://dev.mysql.com/doc/
- https://www.php.net/docs.php
- https://httpd.apache.org/docs/