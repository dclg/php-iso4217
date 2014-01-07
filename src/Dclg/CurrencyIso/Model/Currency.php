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
        $this->numericKey = $numericKey;
        $this->alphaKey = $alphaKey;
        $this->name = $enName;
        $this->minorUnitExponent = $minorUnitExponent;
    }

    /**
     * @param mixed $numericKey
     * @return $this
     */
    public function setNumericKey($numericKey)
    {
        $this->numericKey = $numericKey;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNumericKey()
    {
        return $this->numericKey;
    }

    /**
     * @param mixed $alphaKey
     * @return $this
     */
    public function setAlphaKey($alphaKey)
    {
        $this->alphaKey = $alphaKey;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAlphaKey()
    {
        return $this->alphaKey;
    }

    /**
     * @param mixed $enName
     * @return $this
     */
    public function setName($enName)
    {
        $this->name = $enName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param int $minorUnitExponent
     * @return $this
     */
    public function setMinorUnitExponent($minorUnitExponent)
    {
        $this->minorUnitExponent = $minorUnitExponent;
        return $this;
    }

    /**
     * @return int
     */
    public function getMinorUnitExponent()
    {
        return $this->minorUnitExponent;
    }
}