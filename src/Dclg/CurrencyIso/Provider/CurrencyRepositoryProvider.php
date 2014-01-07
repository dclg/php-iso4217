<?php

use Dclg\CurrencyIso\Repository\CurrencyArrayEncoder;
use Dclg\CurrencyIso\Repository\CurrencyRepository;
use Dclg\CurrencyIso\RequireFileLoader;

/**
 * Class CurrencyRepositoryProvider
 *
 * Standard invokable service provider you can implement your own, but what for?
 */
class CurrencyRepositoryProvider
{
    public function __invoke()
    {
        $dataPath = __DIR__ . '/../../../data';

        return new CurrencyRepository(
            new RequireFileLoader($dataPath . 'currencyByAlpha.php'),
            new RequireFileLoader($dataPath . 'currencyByAlpha.php'),
            new CurrencyArrayEncoder()
        );
    }
}