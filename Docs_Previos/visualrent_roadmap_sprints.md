# VISUALRENT SaaS - ROADMAP DETALLADO DE DESARROLLO POR SPRINTS
> **Documento Guía Ejecutivo y Técnico para el Desarrollo en Antigravity**
> **Versión:** 1.0.0  
> **Tecnologías Core:** Laravel 11+, PostgreSQL 16+ (TIMESTAMPTZ), Vue.js 3, Inertia.js, Syncfusion Vue, Tailwind CSS, Docker, Coolify PaaS, Firebase Genkit, Google MCP Stack.  
> **Cuadrilla IA:** 9 Agentes Especializados.

---

## 📋 TABLA DE CONTENIDOS
1. [Resumen Estratégico y Dinámica de Trabajo con la Cuadrilla de Agentes](#1-resumen-estratégico-y-dinámica-de-trabajo-con-la-cuadrilla-de-agentes)
2. [Sprint 0: Pre-requisitos, Instalación de Herramientas y Configuración de Entorno](#2-sprint-0-pre-requisitos-instalación-de-herramientas-y-configuración-de-entorno)
3. [Sprint 1: Core del Sistema, Autenticación, RBAC, Catálogo Maestro e Inventario](#3-sprint-1-core-del-sistema-autenticación-rbac-catálogo-maestro-e-inventario)
4. [Sprint 2: Motor Atómico de Disponibilidad PostgreSQL, Matriz 2D y Cotizador](#4-sprint-2-motor-atómico-de-disponibilidad-postgresql-matriz-2d-y-cotizador)
5. [Sprint 3: Reservas, Calendario Syncfusion, Facturación DTE 33 y Contratos](#5-sprint-3-reservas-calendario-syncfusion-facturación-dte-33-y-contratos)
6. [Sprint 4: Logística de Terreno, PWA del Técnico, Guías DTE 52 e Incidencias](#6-sprint-4-logística-de-terreno-pwa-del-técnico-guías-dte-52-e-incidencias)
7. [Sprint 5: Embudo Conversacional IA, Automaciones, Nómina, Caja Chica y Dashboard](#7-sprint-5-embudo-conversacional-ia-automaciones-nómina-caja-chica-y-dashboard)
8. [Matriz Resumen de Pruebas QA y Banderas de Ciberseguridad](#8-matriz-resumen-de-pruebas-qa-y-banderas-de-ciberseguridad)

---

## 1. RESUMEN ESTRATÉGICO Y DINÁMICA DE TRABAJO CON LA CUADRILLA DE AGENTES

Este documento establece la ruta paso a paso para construir **VisualRent SaaS** partiendo desde cero absoluto. El desarrollo se ejecutará en la plataforma **Antigravity** utilizando la **Cuadrilla de 9 Agentes IA Especializados**:

1. **Software Architect** (`AGENT_SOFTWARE_ARCHITECT-v2.md`): Guardián de DDD, Monolito Modular y Patrones.
2. **UI/UX Designer** (`AGENT_UI_UX_DESIGNER-v2.md`): Diseño en Tailwind, Google Stitch y PWA táctil.
3. **Frontend Engineer** (`AGENT_FRONTEND_ENGINEER-v2.md`): Vue 3 + Inertia.js, Syncfusion Vue Schedule, Pinia.
4. **Backend Engineer** (`AGENT_BACKEND_ENGINEER-v2.md`): Laravel 11, Services, Integraciones DTE/WhatsApp, Jobs.
5. **DBA** (`AGENT_DBA-v2.md`): PostgreSQL 16+, `TIMESTAMPTZ`, funciones atómicas, índices y Seeders.
6. **QA Tester** (`AGENT_QA_TESTER-v2.md`): Suites Pest/PHPUnit, pruebas de concurrencia y E2E Playwright.
7. **Meta Business AI & Gemini Spark** (`AGENT_META_BUSINESS_AI-v2.md`): Agente conversacional y Genkit NLP.
8. **Cybersecurity Engineer** (`AGENT_CYBERSECURITY_ENGINEER-v2.md`): OWASP, encripción DTE, Rate-limiting, Sanctum.
9. **DevOps Engineer** (`AGENT_DEVOPS_ENGINEER-v2.md`): Docker, Coolify PaaS, GitHub Actions y Servidores MCP.

---
## 2. SPRINT 0: PRE-REQUISITOS, INSTALACIÓN DE HERRAMIENTAS Y CONFIGURACIÓN DE ENTORNO
> **Objetivo:** Preparar el 100% de la infraestructura local y de servidor antes de escribir la primera línea de código del Sprint 1.

Como actualmente solo cuentas con las aplicaciones base de Google (AI Studio, Antigravity 2.0, Antigravity IDE, Stitch), la siguiente lista de verificación debe completarse paso a paso:

### Paso 1: Instalación de Herramientas Locales en la Computadora de Desarrollo
- [ ] **Docker Desktop & Docker Compose:** Descargar e instalar Docker Desktop. Activar la integración con WSL2 (en Windows) o Virtualización (en Mac/Linux). Validar en consola la instalación de Docker.
- [ ] **Node.js LTS (v20+):** Instalar Node.js LTS para ejecutar herramientas de empaquetado y servidores MCP en JS/TS. Validar la instalación en consola.
- [ ] **Git & Cliente SSH:** Instalar Git. Configurar identidad global de Git. Generar clave SSH para conexión segura con GitHub y el servidor VPS.

### Paso 2: Configuración del Stack de Google & Servidores MCP (Model Context Protocol)
- [ ] **Entender qué es MCP:** MCP es un protocolo abierto que permite a las IAs en Antigravity/Google AI Studio conectarse mediante la consola local a herramientas reales (tu base de datos PostgreSQL, la terminal, el sistema de archivos y el diseñador Stitch).
- [ ] **Crear la carpeta `.mcp` y el archivo maestro `.mcp/config.json`:**
  En la raíz del proyecto, crear la estructura de configuración que conectará los 4 servidores MCP requeridos:
  1. `@google/stitch-mcp`: Para extraer tokens de Tailwind y layouts desde Google Stitch.
  2. `@modelcontextprotocol/server-postgres`: Para que el Agente DBA inspeccione la DB PostgreSQL local.
  3. `terminal-mcp`: Para que el Agente Backend ejecute comandos de Artisan, Composer y NPM.
  4. `playwright-mcp`: Para que el Agente QA ejecute navegador headless en pruebas E2E.
- [ ] **Obtener API Keys en Google AI Studio:** Generar la API Key oficial para los modelos Gemini 1.5 Pro / Flash y configurarla en Antigravity IDE y en el archivo de entorno de Firebase Genkit.

### Paso 3: Inicialización del Repositorio y Proyecto Laravel 11 con Docker Sail
- [ ] **Crear Repositorio en GitHub:** Crear el repositorio privado `visualrent-saas` en GitHub.
- [ ] **Crear la estructura inicial con Laravel Sail:**
  Ejecutar el comando de instalación de Laravel 11 con PostgreSQL y Redis via Sail.
- [ ] **Configuración del `.env` local:** Configurar `DB_CONNECTION=pgsql`, `DB_HOST=pgsql`, `DB_PORT=5432`, `DB_DATABASE=visualrent_db`, `TIMEZONE=UTC` / `APP_TIMEZONE=America/Santiago`.
- [ ] **Levantar los Contenedores:** Entrar a la carpeta del proyecto y levantar los contenedores con Sail. Validar en navegador accediendo a localhost.

### Paso 4: Setup de Servicios Adicionales en Docker (`docker-compose.yml`)
- [ ] **Agregar Sidecar de Firebase Genkit:** Incluir en el `docker-compose.yml` el servicio `genkit-sidecar` basado en Node.js para orquestar la IA conversacional en segundo plano.
- [ ] **Agregar Evolution API (WhatsApp):** Incluir la imagen de Evolution API para gestionar la conexión con WhatsApp Webhooks sin costos por plantilla.

### Paso 5: Aprovisionamiento del Servidor VPS de Producción & Coolify PaaS
- [ ] **Contratar Servidor VPS:** Aprovisionar un VPS (Hetzner, DigitalOcean o AWS) con Ubuntu 22.04 LTS (mínimo 4 vCPUs, 8GB RAM).
- [ ] **Instalar Coolify PaaS:** Conectarse por SSH al VPS e instalar Coolify PaaS mediante el script oficial.
- [ ] **Configurar Dominio y DNS:** Apuntar los registros A de la aplicación y la API a la IP del VPS.
- [ ] **Configurar Proyectos en Coolify:** Crear los servicios en Coolify: PostgreSQL 16 (con volúmenes persistentes), Redis, Traefik (Proxy inverso con SSL Let's Encrypt) y la aplicación Laravel/Docker.
- [ ] **Conectar Webhook de GitHub Actions:** Configurar el secreto `COOLIFY_WEBHOOK` en GitHub para despliegue automático tras pasar pruebas en la rama principal.

### Paso 6: Obtención de Credenciales Tributarias y Comerciales
- [ ] **Certificado Digital SII (Chile):** Obtener el archivo `.pfx` del representante legal y la API Key del proveedor de DTE (LibreDTE o SimpleAPI) para la emisión de DTE 33 (Facturas) y DTE 52 (Guías de Despacho).
- [ ] **Meta Business Suite:** Crear la App en Meta for Developers, configurar el Webhook de WhatsApp Business API e Instagram/Facebook Messenger, y obtener el token de verificación y secreto de app.

---
## 3. SPRINT 1: CORE DEL SISTEMA, AUTENTICACIÓN, RBAC, CATÁLOGO MAESTRO E INVENTARIO
> **Duración estimada:** 2 Semanas  
> **Objetivo:** Tener la estructura base de Laravel, el control de acceso por roles (RBAC) y la gestión completa del catálogo físico, kits, consumibles y servicios de desarrollo de software.

### Funcionalidades & Módulos a Construir:
1. Autenticación con Laravel Breeze / Inertia Vue 3.
2. Implementación de roles Spatie (`Admin`, `Vendedor`, `Coordinador`, `Técnico`, `Meta_Agent`).
3. CRUD de Clientes con condiciones de pago (`50_50_contado`, `100_post_evento`, `credito_30_dias`) y líneas de crédito.
4. CRUD de Vehículos con capacidades de volumen (m³) y peso (kg).
5. CRUD de Catálogo Maestro:
   - Productos Seriados (`items_seriados` con código QR/Serie, horas y eventos acumulados).
   - Productos Fungibles (`items_fungibles_stock` con control de retorno a bodega).
   - Insumos Consumibles (`items_consumibles_stock` con alertas de stock mínimo).
   - Servicios Especiales de Desarrollo de Software Interactivo (`tipo_linea = 'servicio_desarrollo'`).
   - Definición de Kits/Packs (`kit_componentes` con desglose de ítems físicos).

### Mapeo de Tareas por Agente IA:
- **Software Architect:** Diseñar los límites de los Bounded Contexts Auth, Clients e Inventory. Diseñar los DTOs de creación de catálogo.
- **UI/UX Designer:** Diseñar layouts base en Tailwind CSS utilizando tokens de Google Stitch. Maquetar formularios de catálogo, selección de componentes de Kits y fichas de clientes.
- **Frontend Engineer:** Implementar páginas en Vue 3 + Inertia.js para Clientes, Vehículos e Inventario. Crear componente modal reactivo para armar Kits/Packs.
- **Backend Engineer:** Crear migraciones, modelos Eloquent, FormRequests y Controladores para el CRUD. Configurar middleware de Spatie Permissions.
- **DBA:** Ejecutar y validar las migraciones iniciales de usuarios, roles, clientes, productos, kit_componentes, items_seriados, items_fungibles_stock e items_consumibles_stock.
- **QA Tester:** Escribir pruebas en Pest para creación de productos, validación de RUT chileno, deslinde de permisos por rol y desglose correcto de kits.
- **Meta Business AI:** Configurar los endpoints de consulta de catálogo inicial (`GET /api/v1/catalogo/buscar`).
- **Cybersecurity Engineer:** Auditar autenticación Sanctum/Fortify, validar protección CSRF en Inertia, sanitización de entradas contra SQLi y almacenamiento seguro de contraseñas (Bcrypt).
- **DevOps Engineer:** Asegurar que los contenedores locales de Docker funcionen correctamente y que las migraciones corran limpiamente en el entorno de testing.

### Criterios de Aceptación & Pruebas QA/Seguridad:
- [ ] **Pest Test:** Ningún usuario no autenticado o con rol Técnico puede crear clientes o modificar precios de productos.
- [ ] **Pest Test:** Un Kit no puede guardarse sin al menos un componente físico asociado.
- [ ] **Security Check:** Intento de inyección SQL en la búsqueda de productos bloqueado por Eloquent/PostgreSQL.

---
## 4. SPRINT 2: MOTOR ATÓMICO DE DISPONIBILIDAD POSTGRESQL, MATRIZ 2D Y COTIZADOR
> **Duración estimada:** 2 Semanas  
> **Objetivo:** Construir el corazón del sistema: la verificación atómica de stock en PostgreSQL considerando tiempos de margen (buffer), la Matriz 2D de Descuentos y la generación de Cotizaciones en PDF con soft lock.

### Funcionalidades & Módulos a Construir:
1. Función almacenada en PostgreSQL `verificar_disponibilidad_item()` utilizando `TIMESTAMPTZ` y operadores de solapamiento `OVERLAPS`.
2. Lógica de cálculo de margen de preparación/limpieza (`buffer_tiempo_horas`).
3. Algoritmo de la **Matriz 2D de Descuentos** (Días x Cantidad) con tope máximo del 20% de descuento.
4. Módulo de Creación de Cotizaciones:
   - Selección de cliente, fechas de evento y productos/kits.
   - Desglose automático de kits a componentes físicos para la consulta de stock.
   - Inclusión de líneas de software con `fecha_entrega_software`.
   - Asignación automática de soft lock de 24 horas (`bloqueo_hasta`).
5. Generador de PDF de Cotizaciones con Browsershot (Headless Chrome).

### Mapeo de Tareas por Agente IA:
- **Software Architect:** Diseñar el servicio de dominio `AvailabilityService` que invoca la función SQL de PostgreSQL y aplica el soft lock.
- **UI/UX Designer:** Diseñar la interfaz del Cotizador en Vue/Tailwind, la vista previa del PDF y la representación visual del tiempo de preparación (buffer).
- **Frontend Engineer:** Desarrollar el cotizador interactivo en Vue 3 con cálculo en tiempo real de la Matriz 2D de Descuentos conforme el usuario cambia días o cantidades.
- **Backend Engineer:** Implementar `CotizacionController`, `AvailabilityService`, `DiscountMatrixCalculator` y la compilación del PDF con Browsershot.
- **DBA:** Crear el script de migración SQL para la función `verificar_disponibilidad_item()`, la tabla `matriz_descuentos` y crear el Seeder con los valores exactos de la matriz corporativa.
- **QA Tester:** Crear pruebas de concurrencia en Pest/PHPUnit: simular 2 vendedores intentando cotizar el último equipo disponible al mismo milisegundo para demostrar la prevención de doble agendamiento.
- **Meta Business AI:** Conectar el endpoint `POST /api/v1/cotizaciones/generar-desde-agente` para que la IA pueda emitir cotizaciones con soft lock ajustado de 6 horas.
- **Cybersecurity Engineer:** Auditar el endpoint del cotizador para evitar manipulación de precios desde el cliente (parameter tampering) y asegurar que el generador de PDF no ejecute scripts maliciosos (PDF Injection).
- **DevOps Engineer:** Configurar Puppeteer/Chrome en el contenedor Docker para que Browsershot genere los PDFs sin errores de dependencias.

### Criterios de Aceptación & Pruebas QA/Seguridad:
- [ ] **Pest Test Concurrencia:** Prevenir matemáticamente que se cotice un equipo ocupado o en mantenimiento en el mismo rango de tiempo (+ buffer).
- [ ] **Pest Test Matriz 2D:** Verificar que 10 equipos por 1 día y 1 equipo por 10 días reciban exactamente el 15% de descuento de la matriz.
- [ ] **Security Check:** Verificación de que el parámetro de precio enviado al backend sea ignorado y recalculado estrictamente en el servidor.

---
## 5. SPRINT 3: RESERVAS, CALENDARIO SYNCFUSION, FACTURACIÓN DTE 33 Y CONTRATOS
> **Duración estimada:** 2 Semanas  
> **Objetivo:** Convertir cotizaciones en reservas operativas, integrar el calendario visual **Syncfusion Vue Schedule**, emitir facturas electrónicas (DTE 33) ante el SII y generar contratos de arriendo.

### Funcionalidades & Módulos a Construir:
1. Módulo de Confirmación de Reservas:
   - Validación de riesgo crediticio para clientes con crédito a 30 días.
   - Opción `retiro_en_bodega` (flete $0).
   - Asignación atómica de `items_seriados` específicos a la reserva.
2. Integración de **Syncfusion Vue Schedule** (`@syncfusion/ej2-vue-schedule`):
   - Vista de calendario interactivo por mes, semana y día.
   - Código de colores por estado: Verde (Operativo), Azul (Confirmado), Amarillo (En Tránsito), Rojo (Mantenimiento/Incidencia).
3. Módulo Tributario DTE 33 (Factura Electrónica Chile):
   - Conexión con LibreDTE / SimpleAPI.
   - Generación del XML firmado, envío al SII y obtención del PDF con timbre electrónico (TED).
4. Generación del Contrato de Arrendamiento:
   - Sumatoria automática de la garantía comercial basada en `monto_garantia_unitario`.
   - Cláusulas de responsabilidad y custodia legal.

### Mapeo de Tareas por Agente IA:
- **Software Architect:** Diseñar la máquina de estados de la Reserva (`confirmada` -> `en_transito` -> `en_terreno` -> `en_retiro` -> `completada`).
- **UI/UX Designer:** Diseñar la maquetación del calendario Syncfusion Vue, adaptando la paleta de colores corporativos de Tailwind y los paneles de detalles al hacer clic en un evento.
- **Frontend Engineer:** Implementar el componente `@syncfusion/ej2-vue-schedule` en Vue 3 con Inertia.js, conectando la carga asíncrona de eventos desde el backend.
- **Backend Engineer:** Desarrollar `ReservaService`, la integración con la API de DTE para facturación electrónica DTE 33 y la generación del Contrato PDF.
- **DBA:** Crear las tablas `reservas`, `reserva_items_asignados`, `facturas` e índices para optimizar las consultas de eventos por rango de fechas en el calendario.
- **QA Tester:** Probar la integración de Syncfusion en navegadores de escritorio y móviles; validar que la maquetación XML del DTE 33 cumpla con el esquema del SII.
- **Meta Business AI:** Habilitar la pre-aprobación de reservas desde el agente conversacional (`POST /api/v1/reservas/pre-aprobar-desde-agente`).
- **Cybersecurity Engineer:** Garantizar que los certificados digitales `.pfx` del SII estén cifrados con AES-256 en la base de datos y que las llaves privadas no se expongan en logs.
- **DevOps Engineer:** Configurar variables de entorno seguras en Coolify para las credenciales del SII y pasarelas de pago.

### Criterios de Aceptación & Pruebas QA/Seguridad:
- [ ] **Syncfusion Test:** El calendario debe renderizar más de 200 eventos simultáneos sin degradar los FPS de la interfaz.
- [ ] **SII Validation:** La factura DTE 33 generada debe ser aceptada exitosamente en el entorno de certificación del SII.
- [ ] **Security Check:** El certificado `.pfx` almacenado debe ser ilegible directamente desde el sistema de archivos sin la clave maestra.

---
## 6. SPRINT 4: LOGÍSTICA DE TERRENO, PWA DEL TÉCNICO, GUÍAS DTE 52 E INCIDENCIAS
> **Duración estimada:** 2 Semanas  
> **Objetivo:** Equipar al equipo logístico con la PWA móvil táctil para gestión de rutas, emisión automática de Guías de Despacho (DTE 52), control de bitácora de vehículos y reporte de equipos dañados.

### Funcionalidades & Módulos a Construir:
1. Desarrollo de la **PWA Móvil para Técnicos**:
   - Instalable en Android/iOS vía Vite PWA Plugin.
   - Interfaz táctil optimizada para celular (botones de mínimo 48px, modo nocturno para eventos).
   - Hoja de ruta del día con enlace directo a Google Maps / Waze.
2. Bitácora de Vehículos (`bitacora_vehiculos`):
   - Registro obligatorio de odómetro (km) y nivel de combustible al salir y regresar a bodega.
3. Emisión Automática de Guía de Despacho Electrónica (DTE 52):
   - Se dispara automáticamente al presionar "Iniciar Viaje" en la PWA para amparar el traslado de carga ante Carabineros y el SII.
4. Checklist de Bodega & Firma Digital:
   - Lectura de códigos QR con la cámara del celular.
   - Captura de firma digital del cliente en pantalla con `signature_pad`.
5. Módulo de Reporte de Incidencias (`incidencias_equipos`):
   - Carga de 1 a 3 fotos de equipos dañados o perdidos.
   - Cambio automático del equipo a `estado_operativo = 'en_reparacion'` y alerta urgente al Coordinador.

### Mapeo de Tareas por Agente IA:
- **Software Architect:** Diseñar el flujo asíncrono de la PWA y la sincronización con el backend cuando hay pérdida temporal de señal en terreno.
- **UI/UX Designer:** Diseñar la interfaz móvil táctil de la PWA, el flujo de checklist con lectura QR, el visor de ruta y el lienzo interactivo de firma digital.
- **Frontend Engineer:** Desarrollar la PWA con Vue 3, Vite PWA, Pinia para estado local, integración de cámara para lectura QR y `signature_pad`.
- **Backend Engineer:** Implementar `DespachoController`, `BitacoraVehiculoController`, la emisión automática del DTE 52 y la recepción de incidencias con fotos.
- **DBA:** Crear las tablas `despachos_logistica`, `bitacora_vehiculos` e `incidencias_equipos`.
- **QA Tester:** Ejecutar pruebas E2E con Playwright simulando la experiencia móvil del técnico: desconectar la red, firmar el contrato, adjuntar fotos y reconectar.
- **Meta Business AI:** Recibir alertas de incidencias para notificar al vendedor si un equipo dañado afecta una cotización futura.
- **Cybersecurity Engineer:** Validar que la subida de imágenes de incidencias esté sanitizada (prevención de ejecución de scripts en imágenes) y restringir los permisos del rol Técnico únicamente a sus despachos asignados.
- **DevOps Engineer:** Configurar el Service Worker de la PWA y las cabeceras HTTPS/SSL obligatorias para el acceso a la cámara en celulares.

### Criterios de Aceptación & Pruebas QA/Seguridad:
- [ ] **PWA Test:** La PWA debe permitir completar el checklist y capturar la firma digital incluso sin conexión a internet, sincronizando al recuperar señal.
- [ ] **DTE 52 Test:** Al presionar "Iniciar Viaje", el DTE 52 se genera en menos de 3 segundos y queda disponible en PDF para el chofer.
- [ ] **Security Check:** Una imagen maliciosa con código ejecutable oculto debe ser rechazada y limpiada por el pipeline de imágenes.

---
## 7. SPRINT 5: EMBUDO CONVERSACIONAL IA, AUTOMACIONES, NÓMINA, CAJA CHICA Y DASHBOARD
> **Duración estimada:** 2 Semanas  
> **Objetivo:** Implementar la inteligencia conversacional multicanal con Firebase Genkit, los Jobs programados en Redis, la gestión de nómina/comisiones, la caja chica del coordinador y el dashboard financiero P&L.

### Funcionalidades & Módulos a Construir:
1. Embudo Conversacional Multicanal (WhatsApp, FB, IG & Email):
   - Integración del Sidecar Node.js de Firebase Genkit con Laravel.
   - **Debounce Job de 10 min en Redis:** Evita respuestas fragmentadas cuando el cliente escribe mensajes seguidos.
   - **Jobs de Calificación a los 30 min, 60 min y 24 hrs:** Envío de plantillas HSM en WhatsApp tras 24h.
   - **Fase 2 - Seguimiento de Cotizaciones:** Cadencia a las 48h, 5 días y 2 días antes del evento (`fecha_evento_inicio - 1 día`).
   - Manejo de objeciones: Transferencia a vendedor humano si el cliente indica que es caro; pre-aprobación si dice "Acepto".
2. Módulo de Nómina y Comisiones:
   - Comisiones de vendedores sobre netos de arriendo (no congelables por mora del cliente).
   - Bonos de técnicos por despachos finalizados (Conductor vs. Ayudante).
3. Módulo de Caja Chica & Rendimiento de Flota:
   - Rendición de gastos en terreno con foto por el Coordinador.
   - Cálculo automático de rendimiento de combustible (km/l) contrastando recargas vs. bitácora.
4. Dashboard Financiero P&L (Profit & Loss):
   - Flujo de caja real, cuentas por cobrar, cuentas por pagar y margen neto en tiempo real.

### Mapeo de Tareas por Agente IA:
- **Software Architect:** Diseñar la arquitectura de comunicación entre Laravel, Redis Queue Worker y el Sidecar de Firebase Genkit.
- **UI/UX Designer:** Diseñar el Dashboard Financiero P&L, el módulo de rendición de caja chica y el panel de control del embudo conversacional de IA.
- **Frontend Engineer:** Desarrollar los gráficos financieros con Chart.js/Syncfusion, la interfaz de revisión de chats de IA y la liquidación de comisiones en Vue 3.
- **Backend Engineer:** Implementar `ProcessLeadDebounceJob`, `QuotationFollowUpScheduler`, `ComisionController`, `CajaChicaController` y las respuestas Webhook.
- **DBA:** Crear las tablas `gastos_caja_chica`, `comisiones_vendedores`, `bonos_despachos_tecnicos` y vistas materializadas para el Dashboard P&L.
- **QA Tester:** Probar el ciclo completo del embudo de IA: simular envío de mensajes continuos, verificar la cancelación del Job de 10 min y validar el cese del seguimiento 24 horas antes del evento.
- **Meta Business AI & Gemini Spark:** Validar la precisión del análisis NLP en Genkit, extracción de datos de leads y transferencia fluida a vendedores humanos.
- **Cybersecurity Engineer:** Verificar la firma HMAC en los Webhooks de Meta, aplicar Rate Limiting en la API de los agentes y auditar la segregación de datos en el Dashboard P&L.
- **DevOps Engineer:** Configurar los workers de Laravel Horizon en Redis para el procesamiento de colas en producción y el monitoreo de tareas programadas (`laravel cron`).

### Criterios de Aceptación & Pruebas QA/Seguridad:
- [ ] **AI Debounce Test:** Si un cliente escribe a las 10:00, 10:02 y 10:05, el sistema ejecuta un solo procesamiento a las 10:15.
- [ ] **Retention Boundary Test:** Ninguna cotización con fecha de evento para mañana recibe mensajes automáticos de seguimiento hoy.
- [ ] **P&L Integrity Test:** El margen neto cuadra al centavo entre ingresos facturados, gastos de caja chica, sueldos y comisiones.

---

## 8. MATRIZ RESUMEN DE PRUEBAS QA Y BANDERAS DE CIBERSEGURIDAD

| Módulo / Sprint | Pruebas Clave QA (Pest / Playwright) | Criterio de Ciberseguridad & Privacidad |
| :--- | :--- | :--- |
| **Sprint 1: Core & RBAC** | Aislamiento estricto de roles; validación de RUT chileno; composición de Kits. | Autenticación Sanctum, Bcrypt, sanitización de entradas, protección CSRF. |
| **Sprint 2: Disponibilidad & 2D** | Pruebas de concurrencia (race conditions) en stock; cálculo de la Matriz 2D. | Sanitización de PDFs (Browsershot), prevención de manipulación de precios. |
| **Sprint 3: Reservas & DTE 33** | Carga masiva en Syncfusion Vue Schedule; validación de esquema XML ante el SII. | Encripción AES-256 de certificados `.pfx` del SII; llaves privadas protegidas. |
| **Sprint 4: Terreno & PWA** | Sincronización offline de la PWA; lectura de código QR; flujo de firma digital. | Sanitización de subida de imágenes de incidencias; SSL obligatorio para PWA. |
| **Sprint 5: IA, Jobs & P&L** | Cancelación de Debounce Job en Redis; cese de seguimiento a T-24h; cálculo P&L. | Firma HMAC en Webhooks de Meta; Rate Limiting en API; aislamiento de tokens Sanctum. |

---
*Fin del Roadmap Detallado de Desarrollo por Sprints para VisualRent SaaS.*
