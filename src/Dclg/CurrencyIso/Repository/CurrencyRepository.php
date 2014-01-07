<?php
namespace Dclg\CurrencyIso\Repository;

use Dclg\CurrencyIso\Exception\NotFoundException;
use Dclg\CurrencyIso\LoaderInterface;

/**
 * Class CurrencyRepository
 * @package Dclg\CurrencyIso\Repository
 */
class CurrencyRepository
{
    protected $dataByNumeric;
    protected $dataByAlpha;

    protected $byNumericLoader;
    protected $byAlphaLoader;

    protected $arrayDecoder;

    public function __construct(LoaderInterface $byAlphaLoader, LoaderInterface $byNumericLoader, CurrencyArrayEncoder $arrayEncoder)
    {
        $this->byAlphaLoader = $byAlphaLoader;
        $this->byNumericLoader = $byNumericLoader;
        $this->arrayDecoder = $arrayEncoder;
    }


    public function getByNumericId($id)
    {
        if (is_null($this->dataByNumeric)) {
            $this->dataByNumeric = $this->byNumericLoader->load();
        }

        if (isset($this->dataByNumeric[$id])) {
            throw new NotFoundException("Data for numeric key $id not found");
        }

        return $this->arrayDecoder->fromArray($this->dataByNumeric[$id]);
    }


    public function getByAlphaId($id)
    {
        if (is_null($this->dataByAlpha)) {
            $this->dataByAlpha = $this->byAlphaLoader->load();
        }

        if (isset($this->dataByAlpha[$id])) {
            throw new NotFoundException("Data for alpha key $id not found");
        }

        return $this->arrayDecoder->fromArray($this->dataByAlpha[$id]);
    }

}