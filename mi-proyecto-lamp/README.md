# Entorno LAMP con Docker Compose

Estructura de ejemplo del manual "Manual Práctico de Docker: Entorno LAMP con Docker Compose"
(Apache + PHP 8.5, MySQL 9.7, phpMyAdmin).

## Puesta en marcha

1. Copia `.env.example` a `.env` y ajusta las credenciales si quieres:

   ```bash
   cp .env.example .env
   ```

2. Levanta el entorno:

   ```bash
   docker compose up -d
   ```

3. Comprueba que funciona:
   - http://localhost:8080 → debe mostrar "Conexión a MySQL correcta desde PHP."
   - http://localhost:8081 → phpMyAdmin. Como no se fijan `PMA_USER`/`PMA_PASSWORD`, pedirá login:
     usa `root` y la `MYSQL_ROOT_PASSWORD` de tu `.env` para tener permisos completos (crear bases
     de datos, usuarios, etc.), o `MYSQL_USER`/`MYSQL_PASSWORD` si solo necesitas trabajar sobre
     la base `mi_base`.

4. Para detenerlo:

   ```bash
   docker compose down       # conserva los datos de MySQL
   docker compose down -v    # borra también el volumen de datos
   ```

## Estructura

```
mi-proyecto-lamp/
├── docker-compose.yml
├── .env.example
├── apache/
│   └── Dockerfile
└── www/
    └── index.php
```
