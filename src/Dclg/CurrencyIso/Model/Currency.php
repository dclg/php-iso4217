<?php

namespace Dclg\CurrencyIso\Model;

/**
 * Class Currency
 * @package Dclg\CurrencyIso\Model
 */
class Currency
{
    /** @var  int Three-digit numeric currency identifier */
    protected $numericKey;

    /** @var  string Three-letter currency identifier */
    protected $alphaKey;

    /** @var  string Currency name in english */
    protected $name;

    /** @var int Number of minor unit of currency digits */
    protected $minorUnitExponent;

    public function __construct($numericKey, $alphaKey, $enName, $minorUnitExponent = 0)
    {
        $this->numericKey = (int)$numericKey;
        $this->alphaKey = $alphaKey;
        $this->name = $enName;
        $this->minorUnitExponent = (int)$minorUnitExponent;
    }

    /**
     * @return int
     */
    public function getNumericKey()
    {
        return $this->numericKey;
    }

    /**
     * @return string
     */
    public function getAlphaKey()
    {
        return $this->alphaKey;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getMinorUnitExponent()
    {
        return $this->minorUnitExponent;
    }
}