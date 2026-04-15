# Desarrollo Web - Actividad 1
## Sistema de Gestión de Gastos y Usuarios

Este proyecto implementa un sistema para la administración de usuarios y el 
control de facturación de servicios públicos, siguiendo los principios de 
Arquitectura Hexagonal y Diseño Orientado al Dominio (DDD).


## Estructura de Capas

### 1. Domain (Núcleo)

Es la base del sistema. Contiene los elementos esenciales del negocio y no 
depende de ninguna tecnología externa.

- Models:
  Clases principales que representan los datos (Gasto y User)

- Enums:
  Definiciones para TipoServicio, Role y Status

- Exceptions:
  Manejo de errores específicos del negocio

- Value Objects:
  Objetos encargados de validar la integridad de datos

- Eventos:
  Gestión de sucesos dentro del dominio


### 2. Application (Casos de Uso)

Orquesta la lógica del sistema y conecta el dominio con el mundo exterior.

- Ports:
  Definición de puertos de entrada (Input) y salida (Output)

- Services:
  Contiene la lógica de los casos de uso

    * DTO:
      Objetos para transferencia de datos

    * Mapper:
      Transformadores entre capas

    * Casos de Uso:
      Lógica principal del sistema


### 3. Infrastructure (Herramientas)

Encargada de la implementación técnica y la comunicación con sistemas externos.

- Adapters:
  Incluye la persistencia y la conexión real a la base de datos

- EntryPoints:
  Controladores e interfaces que interactúan con el usuario


### 4. Common

Contiene utilidades compartidas por todas las capas, como validaciones 
generales y herramientas de apoyo.


## Entidades del Sistema

El sistema se enfoca en dos componentes principales:

1. Gasto:
   Registro de facturas de servicios públicos (Agua, Luz, Gas), incluyendo 
   IVA y proveedores locales

2. User:
   Gestión de acceso, perfiles y estados de seguridad de los usuarios


## Stack Tecnológico

- Lenguaje: PHP 8.x
- Base de datos: MySQL (XAMPP)