<?php
namespace Tests\Dclg\CurrencyIso\Repository;


use Dclg\CurrencyIso\Model\Currency;
use Dclg\CurrencyIso\Repository\CurrencyArrayEncoder;
use Dclg\CurrencyIso\Repository\CurrencyRepository;

class CurrencyRepositoryTest extends \PHPUnit_Framework_TestCase
{
    public function testGetById()
    {
        $encoder = new CurrencyArrayEncoder();
        $loader = $this->getMock('Dclg\CurrencyIso\LoaderInterface', ['load']);
        $loader
            ->expects($this->once())
            ->method('load')
            ->will(
                $this->returnValue(
                    [
                        'USD' => [840, 'USD', 'US Dollar', 2],
                        'EUR' => [978, 'EUR', 'Euro', 2],
                    ]
                )
            );

        $repository = new CurrencyRepository($loader, $encoder);

        $this->assertEquals(new Currency(840, 'USD', 'US Dollar', 2), $repository->getById('USD'));
        $this->assertEquals(new Currency(978, 'EUR', 'Euro', 2), $repository->getById('EUR'));
    }

    /**
     * @expectedException \Dclg\CurrencyIso\Exception\NotFoundException
     */
    public function testGetByIdException()
    {
        $encoder = new CurrencyArrayEncoder();
        $loader = $this->getMock('Dclg\CurrencyIso\LoaderInterface', ['load']);
        $loader
            ->expects($this->once())
            ->method('load')
            ->will(
                $this->returnValue(
                    [
                        'USD' => [840, 'USD', 'US Dollar', 2],
                        'EUR' => [978, 'EUR', 'Euro', 2],
                    ]
                )
            );

        $repository = new CurrencyRepository($loader, $encoder);
        $repository->getById('JPY');

    }

} 