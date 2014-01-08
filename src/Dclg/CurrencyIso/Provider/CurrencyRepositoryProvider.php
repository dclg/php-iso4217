<?php

use Dclg\CurrencyIso\Repository\CurrencyArrayEncoder;
use Dclg\CurrencyIso\Repository\CurrencyRepository;
use Dclg\CurrencyIso\RequireFileLoader;

/**
 * Class CurrencyRepositoryProvider
 *
 * Service provider you can implement your own, but what for?
 */
class CurrencyRepositoryProvider
{
    public function createAlphaRepository()
    {
        $dataPath = __DIR__ . '/../../../data';

        return new CurrencyRepository(
            new RequireFileLoader($dataPath . 'currencyByAlpha.php'),
            new CurrencyArrayEncoder()
        );
    }

    public function createNumericRepository()
    {
        $dataPath = __DIR__ . '/../../../data';

        return new CurrencyRepository(
            new RequireFileLoader($dataPath . 'currencyByNumeric.php'),
            new CurrencyArrayEncoder()
        );
    }
}