<p align="center">
  <img src="https://laravel.com/img/logomark.min.svg" width="100" alt="Laravel Logo">
</p>

<h1 align="center">Laboratorio CRUD de Productos con Laravel</h1>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-PHP-red?logo=laravel" alt="Laravel">
  <img src="https://img.shields.io/badge/Base%20de%20datos-MySQL-blue?logo=mysql" alt="MySQL">
  <img src="https://img.shields.io/badge/Entorno-Windows%20%7C%20WampServer-lightgrey" alt="Windows y WampServer">
  <img src="https://img.shields.io/badge/Proyecto-CRUD-success" alt="CRUD">
</p>

# Universidad Tecnológica de Panamá
## Facultad de Ingeniería de Sistemas Computacionales

**Laboratorio:** Acercamiento a un CRUD rápido en Laravel  
**Guía utilizada:** Laboratorio #2 de CRUD con Laravel  
**Proyecto:** `crud_rapido`

---

## 🎯 Objetivos

- Comprender la estructura de una aplicación desarrollada con Laravel.
- Crear y configurar un proyecto Laravel desde el entorno local de WampServer.
- Aplicar el patrón Modelo-Vista-Controlador (MVC) en un módulo de productos.
- Trabajar con migraciones y una base de datos MySQL.
- Implementar las operaciones CRUD: crear, consultar, actualizar y eliminar productos.
- Revisar las rutas, el controlador, el modelo y las vistas que conectan las distintas partes de la aplicación.

## 📝 Introducción

En este laboratorio seguí la guía **“Acercamiento a un CRUD rápido en Laravel”** para preparar un proyecto y construir un módulo que permita administrar productos. La idea es utilizar las herramientas de Laravel para organizar el código y evitar tener que programar manualmente cada parte desde cero.

Trabajé desde PowerShell en Windows, con WampServer, dentro de la carpeta `C:\wamp64\www`. El proyecto se llama `crud_rapido` y utiliza una base de datos MySQL con el mismo nombre. Durante el proceso se revisaron la configuración del entorno, las migraciones, el modelo `Product`, el controlador `ProductController`, las rutas y las vistas Blade.

Las capturas se insertan junto a los pasos que ilustran y se enlazan directamente desde la carpeta [Imagenes del repositorio de referencia](https://github.com/Neiel003/Ejemplo-de-un-CRUD-en-Laravel/tree/main/Imagenes). Los archivos siguen el formato `Img1.png`, `Img2.png`, etc.

## ⚙️ Requisitos y herramientas

- **Windows y PowerShell:** para ejecutar los comandos.
- **WampServer:** entorno local de desarrollo.
- **PHP:** en el equipo utilizado se trabajó con PHP 8.3.
- **Composer:** administrador de dependencias de PHP.
- **Laravel Installer:** herramienta utilizada en la guía para crear el proyecto con `laravel new`.
- **MySQL:** motor de base de datos.
- **Editor de código:** para modificar los archivos PHP y Blade.

## 🔧 Procedimiento realizado

### 1. Abrir PowerShell y ubicarse en `www`

Primero abrí PowerShell. Como el proyecto se iba a trabajar con WampServer, me ubiqué en la carpeta `www`, que es el directorio donde se guardan los proyectos web locales:

```powershell
cd C:\wamp64\www
```

En este paso solo entré a `www`; todavía no estaba dentro de `crud_rapido`. Desde esta ubicación seguí la guía para crear el proyecto.

![IMG1: PowerShell ubicado en la carpeta www](https://raw.githubusercontent.com/Neiel003/Ejemplo-de-un-CRUD-en-Laravel/main/Imagenes/Img1.png)

### 2. Crear el proyecto Laravel

Siguiendo el procedimiento de la guía, desde `C:\wamp64\www` ejecuté el comando para crear el proyecto:

```powershell
laravel new crud_rapido
```

El instalador de Laravel prepara la carpeta `crud_rapido` y crea la estructura inicial de la aplicación. Este comando corresponde al método de creación que aparece en la guía del laboratorio; por eso, no lo sustituyo por `composer create-project` en esta documentación.

Si el proyecto ya está creado en el equipo, no hay que volver a ejecutar este comando sobre la misma carpeta. En ese caso se continúa con el proyecto existente.

![IMG2: Creación del proyecto crud_rapido](https://raw.githubusercontent.com/Neiel003/Ejemplo-de-un-CRUD-en-Laravel/main/Imagenes/Img2.png)

### 3. Entrar en la carpeta del proyecto

Una vez creado el proyecto, entré en su carpeta:

```powershell
cd C:\wamp64\www\crud_rapido
```

Desde aquí ejecuté los comandos de Artisan y trabajé con los archivos del sistema. En la raíz del proyecto se encuentra `artisan`, y las carpetas principales incluyen `app`, `database`, `resources` y `routes`.

![IMG3: Carpeta y estructura inicial del proyecto](https://raw.githubusercontent.com/Neiel003/Ejemplo-de-un-CRUD-en-Laravel/main/Imagenes/Img3.png)

### 4. Revisar el archivo `.env`

Antes de ejecutar las migraciones, revisé el archivo `.env`, tal como indica la guía. Este archivo contiene los valores de configuración del entorno local, incluida la conexión con MySQL.

La base de datos utilizada en este proyecto se llama `crud_rapido`. Los valores de `DB_DATABASE`, `DB_USERNAME` y `DB_PASSWORD` deben corresponder a la configuración local de MySQL. No es recomendable subir contraseñas reales al repositorio.

![IMG4: Configuración del archivo .env](https://raw.githubusercontent.com/Neiel003/Ejemplo-de-un-CRUD-en-Laravel/main/Imagenes/Img4.png)

### 5. Atender el ajuste de longitud de cadenas, si es necesario

La guía incluye un ajuste para evitar ciertos errores de migración relacionados con la longitud de cadenas en algunos entornos. En el archivo `app/Providers/AppServiceProvider.php` se puede importar `Schema` y establecer el valor predeterminado dentro del método `boot()`:

```php
use Illuminate\Support\Facades\Schema;

// Dentro del método boot():
Schema::defaultStringLength(191);
```

Este ajuste se aplica cuando el entorno lo requiere, no como una instrucción para duplicar la línea. Si el proyecto no presenta ese error, no es necesario agregarlo solo por agregarlo. Después de modificar un archivo PHP, guardé los cambios antes de continuar.

![IMG5: Ajuste de Schema en AppServiceProvider, si se utilizó](https://raw.githubusercontent.com/Neiel003/Ejemplo-de-un-CRUD-en-Laravel/main/Imagenes/Img5.png)

### 6. Preparar la base de datos y ejecutar las migraciones

Las migraciones describen la estructura de las tablas en archivos PHP. Antes de ejecutarlas, comprobé que la conexión del `.env` apuntara a la base de datos correcta.

Los comandos principales que aparecen en la guía son:

```powershell
php artisan migrate
```

Para consultar el estado de las migraciones también se puede usar:

```powershell
php artisan migrate:status
```

`migrate` ejecuta las migraciones pendientes. En cambio, `migrate:status` permite ver cuáles ya se ejecutaron y cuáles faltan.

La guía también explica dos comandos que conviene distinguir: `php artisan migrate:fresh` elimina las tablas existentes y las crea de nuevo ejecutando todas las migraciones; `php artisan migrate:rollback` revierte el último lote de migraciones. No se debe usar `migrate:fresh` en una base de datos con información que se quiera conservar.

![IMG6: Ejecución o revisión de las migraciones](https://raw.githubusercontent.com/Neiel003/Ejemplo-de-un-CRUD-en-Laravel/main/Imagenes/Img6.png)

### 7. Crear el modelo `Product` y su migración

Para trabajar con los productos utilicé el modelo `Product`. La guía presenta este comando para crear el modelo junto con una migración:

```powershell
php artisan make:model Product -m
```

El modelo se ubica normalmente en `app/Models/Product.php`, y la migración correspondiente se crea dentro de `database/migrations`. El modelo representa los productos en Laravel y permite acceder a sus registros mediante Eloquent.

![IMG7: Modelo Product y migración generada](https://raw.githubusercontent.com/Neiel003/Ejemplo-de-un-CRUD-en-Laravel/main/Imagenes/Img7.png)

### 8. Definir las columnas de la tabla de productos

En la migración se definen los campos que necesita cada producto. La guía utiliza como referencia una descripción, un precio y el stock, además del identificador y las fechas automáticas. En la interfaz del proyecto los campos se presentan en español como nombre, descripción, precio y stock; por eso es importante comprobar que los nombres reales del formulario, del modelo y de la base de datos coincidan.

Un esquema de referencia para la migración incluye:

```php
$table->id();
$table->string('name');
$table->string('description');
$table->double('price', 8, 2);
$table->integer('stock');
$table->timestamps();
```

La definición debe ajustarse a los campos que realmente utiliza el proyecto. Si la tabla ya existe pero no tiene alguna de estas columnas, hay que crear una migración de modificación apropiada; cambiar solamente el formulario no añade columnas a MySQL.

Después de guardar la migración, se aplica con:

```powershell
php artisan migrate
```

![IMG8: Columnas definidas para la tabla de productos](https://raw.githubusercontent.com/Neiel003/Ejemplo-de-un-CRUD-en-Laravel/main/Imagenes/Img8.png)

### 9. Generar los archivos del CRUD con el paquete indicado en la guía

La guía presenta el paquete `ibex/crud-generator` como una herramienta para generar partes del CRUD. La instalación indicada es:

```powershell
composer require ibex/crud-generator --dev
```

Este tipo de generador puede crear archivos como controladores, vistas, modelos, solicitudes, migraciones o rutas, dependiendo de la configuración del paquete y de la versión instalada. Si el proyecto ya tiene esos archivos creados, no hay que volver a generarlos sin revisar primero el contenido existente, porque se podrían sobrescribir cambios.

![IMG9: Instalación o revisión del generador CRUD](https://raw.githubusercontent.com/Neiel003/Ejemplo-de-un-CRUD-en-Laravel/main/Imagenes/Img9.png)

### 10. Publicar los archivos del paquete

Después de instalar el paquete, la guía muestra el comando para publicar los recursos que el paquete tenga registrados con la etiqueta `crud`:

```powershell
php artisan vendor:publish --tag=crud
```

La publicación copia al proyecto los recursos que el paquete exponga para esa etiqueta. Si Artisan no encuentra recursos con ese tag, se debe revisar que el paquete se haya instalado correctamente y que la versión utilizada registre esa etiqueta.

![IMG10: Publicación de recursos del generador](https://raw.githubusercontent.com/Neiel003/Ejemplo-de-un-CRUD-en-Laravel/main/Imagenes/Img10.png)

### 11. Ejecutar el generador para `products`

La guía continúa con el comando:

```powershell
php artisan make:crud products
```

El argumento `products` identifica el recurso para el que se quiere generar el CRUD. Después de ejecutar el comando, revisé los archivos creados y las rutas que se incorporaron. La generación automática facilita el inicio, pero de todas formas es necesario revisar el código generado y adaptarlo a los nombres de campos y a las necesidades reales del proyecto.

![IMG11: Ejecución del generador para products](https://raw.githubusercontent.com/Neiel003/Ejemplo-de-un-CRUD-en-Laravel/main/Imagenes/Img11.png)

### 12. Revisar las rutas del recurso

En `routes/web.php` se registró el recurso de productos mediante `ProductController`:

```php
use App\Http\Controllers\ProductController;

Route::resource('products', ProductController::class);
```

La ruta de recurso permite que Laravel relacione las direcciones habituales con los métodos del controlador: listar, mostrar el formulario de creación, guardar, consultar un registro, editar, actualizar y eliminar. En este proyecto también se conservaron las rutas de la página inicial y las de autenticación que ya estaban configuradas.

Para comprobar las rutas se puede ejecutar:

```powershell
php artisan route:list --path=products
```

![IMG12: Rutas del recurso products en web.php o route:list](https://raw.githubusercontent.com/Neiel003/Ejemplo-de-un-CRUD-en-Laravel/main/Imagenes/Img12.png)

## 🏗️ Cómo se organiza el CRUD (MVC)

Laravel utiliza el patrón Modelo-Vista-Controlador para separar responsabilidades.

### Modelo: `Product`

El modelo está en `app/Models/Product.php`. Se encarga de representar los productos y comunicarse con la tabla de la base de datos mediante Eloquent. Si se usan métodos como `create()` o `update()` con un arreglo de datos, hay que revisar el atributo `$fillable` para permitir únicamente los campos que se deben asignar de forma masiva.

### Controlador: `ProductController`

El controlador está en `app/Http/Controllers/ProductController.php`. Sus métodos coordinan las operaciones del CRUD:

- `index`: obtiene y muestra el listado.
- `create`: presenta el formulario de creación.
- `store`: valida y guarda un producto nuevo.
- `show`: muestra los detalles de un producto.
- `edit`: presenta el formulario de edición.
- `update`: procesa los cambios de un producto.
- `destroy`: elimina el registro seleccionado.

### Vistas Blade

Las vistas de productos están dentro de `resources/views/product/`. En el proyecto se trabajó con archivos como `index.blade.php`, `create.blade.php`, `edit.blade.php`, `show.blade.php` y `form.blade.php`. La vista compartida `form.blade.php` ayuda a mantener una estructura común entre el formulario para crear y el formulario para editar.

### Validaciones y nombres de los campos

Las reglas de validación deben corresponder con los campos que envía el formulario. De igual forma, el modelo y la tabla deben utilizar nombres compatibles. Si un campo se llama `description` en la migración pero la vista envía otro nombre, el valor podría no guardarse o no mostrarse correctamente.

## 🧩 Funciones principales del CRUD

### 1. Crear un producto

En el formulario de creación se introducen el nombre, la descripción, el precio y el stock. Al enviar los datos, el controlador los recibe, aplica las validaciones correspondientes y utiliza el modelo para guardarlos en la base de datos.

![IMG13: Formulario de creación de producto](https://raw.githubusercontent.com/Neiel003/Ejemplo-de-un-CRUD-en-Laravel/main/Imagenes/Img13.png)

### 2. Consultar el listado

La vista `index.blade.php` muestra los productos registrados en una tabla. Desde el listado se pueden revisar los datos y acceder a las opciones para consultar, editar o eliminar un producto.

![IMG14: Listado de productos](https://raw.githubusercontent.com/Neiel003/Ejemplo-de-un-CRUD-en-Laravel/main/Imagenes/Img14.png)

### 3. Consultar los detalles

La opción de consulta abre la vista `show.blade.php`, donde se presentan los datos del producto seleccionado sin tener que modificarlos.

![IMG15: Detalles de un producto](https://raw.githubusercontent.com/Neiel003/Ejemplo-de-un-CRUD-en-Laravel/main/Imagenes/Img15.png)

### 4. Editar un producto

La opción de edición abre el formulario con los datos actuales del producto. Al guardar los cambios, Laravel procesa la solicitud mediante el método `update` del controlador. Es importante que los campos enviados coincidan con las reglas de validación y con las columnas de la tabla.

![IMG16: Formulario de edición](https://raw.githubusercontent.com/Neiel003/Ejemplo-de-un-CRUD-en-Laravel/main/Imagenes/Img16.png)

### 5. Eliminar un producto

La opción de eliminación utiliza el método `destroy` del controlador para borrar el registro seleccionado. Como esta acción modifica los datos almacenados, hay que comprobar que se seleccionó el producto correcto antes de confirmar la operación.

![IMG17: Acción o resultado de eliminar un producto](https://raw.githubusercontent.com/Neiel003/Ejemplo-de-un-CRUD-en-Laravel/main/Imagenes/Img17.png)

## ▶️ Levantar el sistema

La guía incluye comandos para iniciar la aplicación. Para arrancar el servidor de desarrollo de Laravel desde la carpeta del proyecto se puede ejecutar:

```powershell
php artisan serve
```

La terminal muestra una dirección local; al abrirla en el navegador se puede probar la aplicación. La guía también menciona `composer run dev` para los proyectos que tienen configurado ese script en Composer. En este proyecto se puede utilizar el comando que corresponda a la configuración existente.

![IMG18: Aplicación en ejecución](https://raw.githubusercontent.com/Neiel003/Ejemplo-de-un-CRUD-en-Laravel/main/Imagenes/Img18.png)

## 🗄️ Base de datos y mantenimiento

La base de datos utilizada para el proyecto se llama `crud_rapido`. La tabla `products` debe contener las columnas que usa la aplicación. Si el listado presenta valores vacíos o el precio aparece como `0.00`, conviene comprobar:

- Que la migración haya creado las columnas necesarias.
- Que el formulario envíe los nombres de campo esperados.
- Que las validaciones acepten los valores recibidos.
- Que `$fillable` permita asignar los campos requeridos.
- Que los métodos `store` y `update` guarden los valores correctos.

![IMG19: Revisión de la estructura o los datos de la base de datos](https://raw.githubusercontent.com/Neiel003/Ejemplo-de-un-CRUD-en-Laravel/main/Imagenes/Img19.png)

Para revisar las migraciones:

```powershell
php artisan migrate:status
```

Para ejecutar migraciones pendientes:

```powershell
php artisan migrate
```

Como respaldo, se recomienda exportar la base de datos desde phpMyAdmin en formato SQL, si el laboratorio solicita entregar una copia. El respaldo debe generarse a partir de la base de datos real; no debe asumirse que ya existe.

## 🛠️ Comandos de referencia de la guía

| Comando | Función |
|---|---|
| `cd C:\wamp64\www` | Ubicarse en la carpeta `www` de WampServer. |
| `laravel new crud_rapido` | Crear el proyecto Laravel siguiendo la guía. |
| `cd C:\wamp64\www\crud_rapido` | Entrar en la carpeta del proyecto. |
| `php artisan config:clear` | Limpiar la caché de configuración. |
| `php artisan cache:clear` | Limpiar la caché de la aplicación. |
| `php artisan config:cache` | Volver a generar la caché de configuración. |
| `php artisan migrate` | Ejecutar las migraciones pendientes. |
| `php artisan migrate:fresh` | Eliminar y volver a crear las tablas con las migraciones. Usar con precaución. |
| `php artisan migrate:rollback` | Revertir el último lote de migraciones. |
| `php artisan make:model Product -m` | Crear el modelo y su migración. |
| `composer require ibex/crud-generator --dev` | Instalar el generador mencionado en la guía. |
| `php artisan vendor:publish --tag=crud` | Publicar los recursos registrados con la etiqueta `crud`. |
| `php artisan make:crud products` | Generar el CRUD para el recurso `products`. |
| `php artisan route:list --path=products` | Revisar las rutas de productos. |
| `composer dump-autoload` | Regenerar el mapa de autocarga de clases de Composer. |
| `php artisan serve` | Iniciar el servidor de desarrollo de Laravel. |

La guía también incluye `laravel/ui` y comandos de Bootstrap/autenticación. Esos pasos solo deben describirse como ejecutados si efectivamente se realizaron en este proyecto; no se presentan aquí como una instalación confirmada porque la configuración existente puede variar.

![IMG20: Comprobación de comandos y configuración del proyecto](https://raw.githubusercontent.com/Neiel003/Ejemplo-de-un-CRUD-en-Laravel/main/Imagenes/Img20.png)

## ⚠️ Dificultades y comprobaciones

Durante el desarrollo fue importante verificar que la estructura de la tabla coincidiera con los campos usados en la interfaz. Una migración que solo cree el identificador y las fechas no basta si el formulario necesita guardar nombre, descripción, precio y stock.

Si los datos no se guardan o se muestran de forma incompleta, revisaría en este orden:

1. Las columnas existentes en `products`.
2. Los atributos `name`, `description`, `price` y `stock` usados por la vista y la migración.
3. Las reglas de validación.
4. El atributo `$fillable` del modelo `Product`.
5. Los métodos `store` y `update` de `ProductController`.

Para evitar perder datos, primero se debe revisar el esquema y preparar una migración correctiva. `migrate:fresh` no es una solución segura si hay registros que se deben conservar, ya que elimina las tablas existentes.

![IMG21: Resultado final o evidencia complementaria del laboratorio](https://raw.githubusercontent.com/Neiel003/Ejemplo-de-un-CRUD-en-Laravel/main/Imagenes/Img21.png)

## 📚 Referencias

- **Guía de laboratorio:** *Acercamiento a un CRUD rápido en Laravel*, Laboratorio #2, material proporcionado para la práctica.
- Laravel. *Documentación oficial*. https://laravel.com/docs
- Laravel. *Migraciones*. https://laravel.com/docs/migrations
- Laravel. *Eloquent ORM*. https://laravel.com/docs/eloquent
- Video de referencia incluido en la guía: https://www.youtube.com/watch?v=j5baJsM_Adc&t=111s

## 👤 Información del estudiante

- **Universidad:** Universidad Tecnológica de Panamá
- **Facultad:** Facultad de Ingeniería de Sistemas Computacionales
- **Nombre:** Vasti Neiel Legaspi
- **Curso:** Desarrollo WEB
- **Docente:** Ing. Irina Fong

---

<p align="center">
  <i>Laboratorio CRUD con Laravel · Universidad Tecnológica de Panamá</i>
</p>
