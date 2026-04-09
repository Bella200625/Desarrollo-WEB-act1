# Desarrollo-WEB-act1

Sistema de Gestion de Usuarios y Facturacion de Servicios Publicos

    Este proyecto implementa la capa de dominio siguiendo los principios de Diseño Orientado al Dominio (DDD) y Arquitectura Hexagonal. El sistema esta desarrollado en PHP y se centra en la gestion tecnica de usuarios y el control de gastos asociados a servicios basicos.

Enfoque del Ejercicio
    El sistema ha sido adaptado para el seguimiento de facturas de servicios publicos domiciliarios en el contexto de la ciudad de Cartagena. Se especializa en el registro y validacion de costos de operacion de un hogar o establecimiento.

Estructura de la Entidad Gasto
    De acuerdo con los requerimientos academicos, la entidad Gasto maneja los siguientes atributos de negocio:

        - Fecha: Registro cronologico de la emision de la factura.

        - Valor Total Sin IVA: Base imponible del servicio prestado.

        - IVA Total: Calculo del impuesto aplicado segun la normativa del servicio.

        - Valor Total Con IVA: Monto final liquidado en la factura.

        - Lugar: Empresa prestadora del servicio (Afinia, Aguas de Cartagena, Surtigas, Veolia).

        - Categoria: Clasificacion mediante Enums (Energia, Agua, Gas, Aseo).

        - Descripcion: Detalle conceptual del cobro o consumo.

Estructura de la Entidad Usuario
    Entidad comun que gestiona el acceso y los permisos dentro del sistema:

        - ID: Identificador unico de usuario.

        - Clave: Credencial de acceso encriptada.

        - Nombre: Nombre completo del titular.

        - Rol: Nivel de permisos (ADMIN, MEMBER, REVIEWER).

Componentes de la Capa de Dominio
    1. Exceptions: Gestion de errores especificos para validaciones de entrada y reglas de negocio.

    2. Enums: Definicion de tipos de datos cerrados para consistencia de la informacion.

    3. Value Objects: (En proceso) Objetos encargados de la integridad y validacion de cada atributo.