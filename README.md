# The Lyssal geography bundle

The Lyssal geography bundle permits to use and manipulate geographic data and langugages.

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/cd04ed28-e578-4e99-8f3d-bc911e323b96/small.png)](https://insight.sensiolabs.com/projects/cd04ed28-e578-4e99-8f3d-bc911e323b96)


## Installation

Read the [installation documentation](doc/Installation.md).


## Entities

All entities have an entity manager (if you use `LyssalDoctrineOrmBundle`), a decorator and an appellation (if you use `LyssalEntityBundle`), and an admin (if you use `SonataAdmin`).

Entities are:

* Country
* AdministrativeArea (for states, French regions, etc)
* SubAdministrativeArea (for counties, French departments, etc)
* City
* PostalCode
* Language


## Command

### Import data

Empty and fill data:

```sh
php bin/console lyssal:geography:database:fill --locale=fr
```

Available locales are `fr` (French) and `en` (English).

Warning: All datatables will be empty after the command's call.

The command fill:

* All countries
* The French regions with names in French
* The French departments with names in French
* The French cities with names in French, and postal codes

### CSV

`LyssalGeographyBundle` use CVS from `sql.sh` for countries, departments and cities.

Ce(tte) oeuvre de [http://sql.sh](http://sql.sh) est mise à disposition selon les termes de la licence Creative Commons Attribution – Partage dans les Mêmes Conditions 4.0 International(http://creativecommons.org/licenses/by-sa/4.0/).


## PhpDoc

Execute :

```sh
phpdoc -c doc/phpdoc.tpl.xml
```
