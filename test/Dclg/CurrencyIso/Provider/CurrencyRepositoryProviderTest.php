<?php
namespace Tests\Dclg\CurrencyIso\Provider;

use Dclg\CurrencyIso\Model\Currency;
use Dclg\CurrencyIso\Provider\CurrencyRepositoryProvider;

class CurrencyRepositoryProviderTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider providerServiceProvider
     * @param $keyType
     * @param $key
     */
    public function testServiceProvider($keyType, $key)
    {
        $serviceProvider = new CurrencyRepositoryProvider($keyType);

        /** @var \Dclg\CurrencyIso\Repository\CurrencyRepository $repository */
        $repository = $serviceProvider();

        $this->assertEquals(new Currency(840, 'USD', 'US Dollar', 2), $repository->getById($key));
    }

    public function providerServiceProvider()
    {
        return [
            [CurrencyRepositoryProvider::ALPHA_KEY, 'USD'],
            [CurrencyRepositoryProvider::NUMERIC_KEY, 840]
        ];
    }
}