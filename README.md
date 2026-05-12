# F1 Database Management - Laravel

Este es un proyecto Laravel que modela el dominio de la Fórmula 1 para el Laboratorio 7.

## Requerimientos Implementados
1. 10 tablas y migraciones completas.
2. 10 modelos Eloquent (`Team`, `Driver`, `Circuit`, `Race`, `Result`, `Car`, `Sponsor`, `PitStop`, `Qualifying`, `SponsorTeam`) con sus respectivos `$fillable` y `$casts`.
3. Más de 5 relaciones establecidas (HasMany, BelongsTo, BelongsToMany).
4. 5 consultas usando Eloquent con filtros y ordenamiento.
5. Uso de **Eager Loading** para solucionar el problema de N+1 (Justificado en `app/Console/Commands/RunF1Queries.php`).
6. Seeder con más de 10,000 registros generados en la base de datos (SQLite).

## Instrucciones para ejecutar el proyecto

Dado que el proyecto utiliza **SQLite**, no necesitas configurar conexiones de bases de datos externas como MySQL. Todo funciona directamente.

### Paso 1: Instalar dependencias
Si acabas de clonar el proyecto, asegúrate de tener PHP y Composer instalados, y ejecuta:
```bash
composer install
cp .env.example .env
php artisan key:generate
```
Asegúrate de que `DB_CONNECTION=sqlite` esté presente en el archivo `.env`.

### Paso 2: Ejecutar las Migraciones y Seeders
Para crear las 10 tablas en la base de datos y poblarlas con más de 10,000 registros coherentes de F1, ejecuta el siguiente comando:
```bash
php artisan migrate:fresh --seed
```
*(Nota: Este comando puede tomar unos segundos debido a la gran cantidad de inserciones, ~30,000 registros en total).*

### Paso 3: Probar las Consultas (Requerimiento 4 y 5)
He creado un comando de Artisan personalizado para demostrar las consultas de Eloquent de manera limpia. Ejecuta el siguiente comando en la terminal para ver los resultados:
```bash
php artisan f1:queries
```

### Problema N+1 y Eager Loading
La consulta número 3 dentro de `app/Console/Commands/RunF1Queries.php` utiliza explícitamente el método `with('team')` de Eloquent para solucionar el problema de N+1 al cargar pilotos y sus escuderías, evitando realizar una consulta a la base de datos adicional por cada piloto en el bucle.
