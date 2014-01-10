Currency Iso
============

PHP Library provides simple way to operate currency list specified by ISO-4217.

Data source
-----------

Currency list is based on xml file represents Table A.1 downloaded here: http://www.currency-iso.org/en/home/tables/table-a1.html

Data about funds and currencies with N/A minor unit has been excluded.

Service can be initialized in two different ways:
 - currency is identified by 3-digit numeric code
 - currency is identified by 3-letter alpha code

If you need both of them you should create two separate instances.

Installation
------------

To use this library just add `"dclg/php-iso4217": "*"` to your composer.json require section:

```json
{
    "require": {
        "dclg/php-iso4217": "*"
    }
}
```

And then run in your project root:

```
$ composer update -o
```

Usage
-----

To create currency repository you can use included in library invokable service provider:

```php
<?php
use Dclg\CurrencyIso\Provider\CurrencyRepositoryProvider;

require_once __DIR__ . '/../vendor/autoload.php';

$currencyRepositoryProvider = new CurrencyRepositoryProvider(CurrencyRepositoryProvider::NUMERIC_KEY);

$currencyRepository = $currencyRepositoryProvider();
```

The way you define currency repository provider defines currency repository type. There are two options
specified by constants in CurrencyRepositoryProvider class: NUMERIC_KEY and ALPHA_KEY, first one is default.

When you've created currency repository you can fetch a single model by id (let's assume it is numeric) or full
currency list indexed by preferred identifier type:

```php
/** @var \Dclg\CurrencyIso\Repository\CurrencyRepository $currencyRepository */

$usdCurrency = $currencyRepository->getById(840);

$fullList = $currencyRepository->getAll();

var_dump($usdCurrency);
var_dump($fullList);
```

This will display:

```
object(Dclg\CurrencyIso\Model\Currency)[113]
  protected 'numericKey' => int 840
  protected 'alphaKey' => string 'USD' (length=3)
  protected 'name' => string 'US Dollar' (length=9)
  protected 'minorUnitExponent' => int 2


array (size=158)
  971 =>
    object(Dclg\CurrencyIso\Model\Currency)[114]
      protected 'numericKey' => int 971
      protected 'alphaKey' => string 'AFN' (length=3)
      protected 'name' => string 'Afghani' (length=7)
      protected 'minorUnitExponent' => int 2
  978 =>
    object(Dclg\CurrencyIso\Model\Currency)[115]
      protected 'numericKey' => int 978
      protected 'alphaKey' => string 'EUR' (length=3)
      protected 'name' => string 'Euro' (length=4)
      protected 'minorUnitExponent' => int 2
  8 =>
    object(Dclg\CurrencyIso\Model\Currency)[116]
      protected 'numericKey' => int 8
      protected 'alphaKey' => string 'ALL' (length=3)
      protected 'name' => string 'Lek' (length=3)
      protected 'minorUnitExponent' => int 2
...
```

As you see currency model is pretty simple and include four read-only properties:
- numeric key
- alpha key
- name in english that can be used as i18n key in your app
- minor unit exponent, which describes currency factional part length

Information about country names from ISO 4217 is omitted.

This properties can be accessed by methods with intuitive names:
`getNumericKey`, `getAlphaKey`, `getName`, `getMinorUnitExponent`.

Integrate with Silex (Pimple)
-----------------------------

This library has no dependency on Silex so it cannot provide silex-compatible service provider. But you can use
invokable service provider as callable in your own silex service provider:

```php
<?php
namespace Your\Namespace;

use Dclg\CurrencyIso\Provider\CurrencyRepositoryProvider;
use Silex\Application;
use Silex\ServiceProviderInterface;

class CurrencyServiceProvider implements ServiceProviderInterface
{

    public function register(Application $app)
    {
        $app['currency.repo'] = $app->share(
            new CurrencyRepositoryProvider(CurrencyRepositoryProvider::ALPHA_KEY)
        );
    }

    public function boot(Application $app)
    {
    }
}
```

You can use any service id, and even provide two services with different types.

You have no need to wrap new instance creation to closure, because object of CurrencyRepositoryProvider class is
invokable itself.