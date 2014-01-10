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

    /**
     * @param int|string  $id
     * @return \Dclg\CurrencyIso\Model\Currency
     * @throws \Dclg\CurrencyIso\Exception\NotFoundException
     */
    public function getById($id)
    {
        $this->checkDataIsLoaded();

        if (!isset($this->data[$id])) {
            throw new NotFoundException("Data for key $id not found");
        }

        return $this->arrayDecoder->fromArray($this->data[$id]);
    }

    /**
     * @return \Dclg\CurrencyIso\Model\Currency[]
     */
    public function getAll()
    {
        $this->checkDataIsLoaded();

        $result = [];
        foreach($this->data as $key => $array) {
            $result[$key] = $this->arrayDecoder->fromArray($array);
        }
        return $result;
    }

    protected function checkDataIsLoaded()
    {
        if (!$this->dataIsLoaded) {
            $this->data = $this->dataLoader->load();
            $this->dataIsLoaded = true;
        }
    }
}