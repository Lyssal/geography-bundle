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

3. Create your `GeographyBundle` (optional)

```php
namespace Acme\GeographyBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * {@inheritDoc}
 */
class AcmeGeographyBundle extends Bundle
{
    /**
     * {@inheritDoc}
     */
    public function getParent()
    {
        return 'LyssalGeographyBundle';
    }
}
```

4. Create your entities

For example:

```php
namespace Acme\GeographyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Lyssal\GeographyBundle\Entity\Country as LyssalCountry;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * {@inheritDoc}
 * 
 * @ORM\Entity()
 * @ORM\Table
 * (
 *     uniqueConstraints=
 *     {
 *         @UniqueConstraint(name="CODE_ALPHA_2", columns={ "code_alpha_2" }),
 *         @UniqueConstraint(name="CODE_ALPHA_3", columns={ "code_alpha_3" })
 *     }
 * )
 */
class Country extends LyssalCountry
{
    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * 
     * @ORM\OneToMany(targetEntity="AdministrativeArea", mappedBy="country")
     */
    protected $administrativeAreas;
}
```

```php
namespace Acme\GeographyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Lyssal\GeographyBundle\Entity\AdministrativeArea as LyssalAdministrativeArea;

/**
 * {@inheritDoc}
 * 
 * @ORM\Entity()
 * @ORM\Table()
 */
class AdministrativeArea extends LyssalAdministrativeArea
{
    /**
     * @var \Acme\GeographyBundle\Entity\Country
     * 
     * @ORM\ManyToOne(targetEntity="Country", inversedBy="administrativeAreas")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    protected $country;
    
    /**
     * @ORM\OneToMany(targetEntity="SubAdministrativeArea", mappedBy="administrativeArea")
     */
    protected $subAdministrativeAreas;
}
```

```php
namespace Acme\GeographyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Lyssal\GeographyBundle\Entity\SubAdministrativeArea as LyssalSubAdministrativeArea;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * {@inheritDoc}
 * 
 * @ORM\Entity(repositoryClass="\Lyssal\GeographyBundle\Repository\SubAdministrativeAreaRepository")
 * @ORM\Table
 * (
 *     uniqueConstraints=
 *     {
 *         @UniqueConstraint(name="REGION_CODE", columns={ "administrativeArea_id", "subAdministrativeArea_code" })
 *     }
 * )
 */
class SubAdministrativeArea extends LyssalSubAdministrativeArea
{
    /**
     * @var \Acme\GeographyBundle\Entity\AdministrativeArea
     * 
     * @ORM\ManyToOne(targetEntity="AdministrativeArea", inversedBy="subAdministrativeAreas")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    protected $administrativeArea;
    
    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * 
     * @ORM\OneToMany(targetEntity="City", mappedBy="subAdministrativeArea")
     */
    protected $cities;
}
```

```php
namespace Acme\GeographyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Lyssal\GeographyBundle\Entity\City as LyssalCity;

/**
 * {@inheritDoc}
 * 
 * @ORM\Entity()
 * @ORM\Table()
 */
class City extends LyssalCity
{
    /**
     * @var \Acme\GeographyBundle\Entity\SubAdministrativeArea
     * 
     * @ORM\ManyToOne(targetEntity="SubAdministrativeArea", inversedBy="cities")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    protected $subAdministrativeArea;
}
```

```php
namespace Acme\GeographyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Lyssal\GeographyBundle\Entity\PostalCode as LyssalPostalCode;

/**
 * {@inheritDoc}
 * 
 * @ORM\Entity()
 * @ORM\Table()
 */
class PostalCode extends LyssalPostalCode
{
    
}
```

```php
namespace Acme\GeographyBundle\Entity;

use Lyssal\GeographyBundle\Entity\Language as LyssalLanguage;
use Doctrine\ORM\Mapping as ORM;

/**
 * {@inheritDoc}
 * 
 * @ORM\Entity()
 * @ORM\Table()
 */
class Language extends LyssalLanguage
{
    
}
```

5. Redefine parameters

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

6. Other configurations

If you use the entity managers of `LyssalDoctrineOrmBundle` :

```yml
imports:
    - { resource: "@LyssalGeographyBundle/Resources/config/config/doctrine.xml" }
```

If you use `LyssalEntityBundle` :

```yml
imports:
    - { resource: "@LyssalGeographyBundle/Resources/config/config/appellation.xml" }
    - { resource: "@LyssalGeographyBundle/Resources/config/config/decorator.xml" }
```
