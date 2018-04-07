# Installation

1. Update your `composer.json` :

```json
"require": {
    "lyssal/geography-bundle": "~x.y"
}
```

2. Update with Composer :

```sh
composer update
```

3. Redefine parameters

Only if you want to extend classes.
Look at parameters in the config directory.

For example for entities:

```xml
<?xml version="1.0" ?>
<container xmlns="http://symfony.com/schema/dic/services" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://symfony.com/schema/dic/services http://symfony.com/schema/dic/services/services-1.0.xsd">
    <!-- ... -->
    <parameters>
        <parameter key="lyssal.geography.entity.administrative_area.class">Acme\GeographyBundle\Entity\AdministrativeArea</parameter>
        <parameter key="lyssal.geography.entity.city.class">Acme\GeographyBundle\Entity\City</parameter>
        <parameter key="lyssal.geography.entity.postal_code.class">Acme\GeographyBundle\Entity\PostalCode</parameter>
        <parameter key="lyssal.geography.entity.country.class">Acme\GeographyBundle\Entity\Country</parameter>
        <parameter key="lyssal.geography.entity.language.class">Acme\GeographyBundle\Entity\Language</parameter>
        <parameter key="lyssal.geography.entity.sub_administrative_area.class">Acme\GeographyBundle\Entity\SubAdministrativeArea</parameter>
    </parameters>
</container>
```

4. Other configurations

If you use the entity managers of `LyssalDoctrineOrmBundle` :

```yml
imports:
    - { resource: "@LyssalGeographyBundle/Resources/config/services/doctrine.xml" }
```

If you use `LyssalEntityBundle` :

```yml
imports:
    - { resource: "@LyssalGeographyBundle/Resources/config/services/appellation.xml" }
    - { resource: "@LyssalGeographyBundle/Resources/config/services/decorator.xml" }
```
