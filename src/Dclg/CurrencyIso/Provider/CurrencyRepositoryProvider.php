<?php
namespace Dclg\CurrencyIso\Provider;

use Dclg\CurrencyIso\Repository\CurrencyArrayEncoder;
use Dclg\CurrencyIso\Repository\CurrencyRepository;
use Dclg\CurrencyIso\RequireFileLoader;

/**
 * Class CurrencyRepositoryProvider
 *
 * Invokable service provider
 */
class CurrencyRepositoryProvider
{
    const NUMERIC_KEY = 'currencyByNumeric';
    const ALPHA_KEY = 'currencyByAlpha';

    protected $currentKeyType;

    /**
     * @param string $keyType
     */
    public function __construct($keyType = self::NUMERIC_KEY)
    {
        $this->currentKeyType = $keyType;
    }

    /**
     * @return CurrencyRepository
     */
    public function __invoke()
    {
        $dataPath = __DIR__ . str_repeat(DIRECTORY_SEPARATOR . '..', 4) . DIRECTORY_SEPARATOR . 'data'
            . DIRECTORY_SEPARATOR . $this->currentKeyType . '.php';

        return new CurrencyRepository(
            new RequireFileLoader($dataPath),
            new CurrencyArrayEncoder()
        );
    }
}