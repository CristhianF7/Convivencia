AplicativoConvivencia
=====================
##Instrucciones Instalación 
Se uso el framework PHP Symfony en su versión 3. Blog en español symfony.es
Aplicación de ejemplo: http://52.33.16.66/Convivencia/
- 1.Descargar el repositorio
```sh
$ git clone https://github.com/CristhianF7/Convivencia
```
- 2. Entrar en la carpeta e instalar dependecias con composer
```sh
$ composer install
```
- 3. Instalar base de datos
``` sh
$ bin/console doctrine:database:create
```
- 4. Creamos el esquema de base de datos
``` sh
$ bin/console doctrine:schema:create
```

- 5. Cargar los de ejemplo
``` sh
$ bin/console doctrine:fixtures:load
```



