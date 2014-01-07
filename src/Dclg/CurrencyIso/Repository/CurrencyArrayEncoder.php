<?php
namespace Dclg\CurrencyIso\Repository;

use Dclg\CurrencyIso\Model\Currency;

class CurrencyArrayEncoder
{
    public function toArray(Currency $currency)
    {
        $array = array(
            $currency->getNumericKey(),
            $currency->getAlphaKey(),
            $currency->getName(),
            $currency->getMinorUnitExponent()
        );

        $this->validateArray($array);

        return $array;
    }

    public function fromArray($array)
    {
        return new Currency((int)$array[0], $array[1], $array[2], (int)$array[3]);
    }

    public function validateArray($array)
    {
        if (count($array) != 4) {
            throw new \RuntimeException('Array has wrong size');
        }

        foreach (array(0, 3) as $index) {
            if (!is_numeric($array[$index])) {
                throw new \RuntimeException("Array has wrong type of element with index $index: expected integer");
            }
        }

        if ($array[0] < 0 || $array[0] > 1000) {
            throw new \RuntimeException("Array element with index 0 is out of bounds: should be 0...999");
        }

        if ($array[3] < 0) {
            throw new \RuntimeException("Array element with index 3 is out of bounds: should be positive");
        }

        if (!preg_match('/[A-Z]{3}/', $array[1])) {
            throw new \RuntimeException("Array element with index 1 should be three-letter latin upper case code");
        }
    }
}