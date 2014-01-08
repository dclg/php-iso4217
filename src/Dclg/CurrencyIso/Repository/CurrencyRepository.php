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
    protected $data;
    protected $dataIsLoaded = false;

    protected $dataLoader;
    protected $arrayDecoder;

    public function __construct(LoaderInterface $dataLoader, CurrencyArrayEncoder $arrayEncoder)
    {
        $this->dataLoader = $dataLoader;
        $this->arrayDecoder = $arrayEncoder;
    }

    public function getById($id)
    {
        if (!$this->dataIsLoaded) {
            $this->data = $this->dataLoader->load();
            $this->dataIsLoaded = true;
        }

        if (!isset($this->data[$id])) {
            throw new NotFoundException("Data for key $id not found");
        }

        return $this->arrayDecoder->fromArray($this->data[$id]);
    }

}