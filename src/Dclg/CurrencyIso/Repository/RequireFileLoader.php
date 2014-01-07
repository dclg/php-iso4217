<?php
namespace Dclg\CurrencyIso;


class RequireFileLoader implements LoaderInterface
{
    protected $path;

    public function __construct($path)
    {
        $this->path = $path;
    }

    /**
     * Loads data and returns it
     * @return mixed
     */
    public function load()
    {
        return require $this->path;
    }
}