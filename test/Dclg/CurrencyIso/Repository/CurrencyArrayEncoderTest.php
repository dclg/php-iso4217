<?php
namespace Tests\Dclg\CurrencyIso\Repository;

use Dclg\CurrencyIso\Model\Currency;
use Dclg\CurrencyIso\Repository\CurrencyArrayEncoder;

class CurrencyArrayEncoderTest extends \PHPUnit_Framework_TestCase
{
    public function testToArray()
    {
        $currency = new Currency(840, 'USD', 'US Dollar', 2);
        $encoder = new CurrencyArrayEncoder();

        $this->assertEquals([840, 'USD', 'US Dollar', 2], $encoder->toArray($currency));
    }

    public function testFromArray()
    {
        $currency = new Currency(840, 'USD', 'US Dollar', 2);
        $encoder = new CurrencyArrayEncoder();

        $this->assertEquals($currency, $encoder->fromArray([840, 'USD', 'US Dollar', 2]));
    }

    /**
     * @dataProvider providerValidateException
     * @expectedException \RuntimeException
     */
    public function testValidateException($inputException)
    {
        $encoder = new CurrencyArrayEncoder();

        $encoder->validateArray($inputException);
    }

    public function providerValidateException()
    {
        return [
            [[1000, 'USD', 'US Dollar', 2, 10]],
            [[1000, 'USD', 'US Dollar']],
            [['US', 'USD', 'US Dollar', 2]],
            [[840, 'USD', 'US Dollar', 'TEST']],
            [[1000, 'USD', 'US Dollar', 2]],
            [[1001, 'USD', 'US Dollar', 2]],
            [[-840, 'USD', 'US Dollar', 2]],
            [[840, 'USD', 'US Dollar', -2]],
            [[840, 'ЯЗЬ', 'US Dollar', 2]],
            [[840, 'UUSD', 'US Dollar', 2]],
            [[840, 'US', 'US Dollar', 2]],
            [[840, 'usd', 'US Dollar', 2]],
        ];
    }
}