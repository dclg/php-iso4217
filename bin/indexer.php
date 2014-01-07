<?php
require_once __DIR__ . '/../vendor/autoload.php';


use Dclg\CurrencyIso\Model\Currency;
use Dclg\CurrencyIso\Repository\CurrencyArrayEncoder;

$file = simplexml_load_file(__DIR__ . '/../data/table_a1.xml');
$list = $file->xpath('/ISO_4217/CcyTbl/CcyNtry');

$currencyDataByNumericId = [];
$currencyDataByAlphaId = [];

$encoder = new CurrencyArrayEncoder();

foreach ($list as $currencyXml) {
    if ((string)($currencyXml->CcyNm->attributes()->IsFund) == 'true') {
        continue;
    }

    $minorUnit = (string)$currencyXml->CcyMnrUnts;
    if (!is_numeric($minorUnit)) {
        continue;
    }

    $minorUnit = (int)$minorUnit;
    $numericCode = (int)$currencyXml->CcyNbr;
    $alphaCode = (string)$currencyXml->Ccy;
    $name = (string)$currencyXml->CcyNm;

    $currency = new Currency($numericCode, $alphaCode, $name, $minorUnit);

    $currencyDataByNumericId[$numericCode] = $currencyDataByAlphaId[$alphaCode] = $encoder->toArray($currency);
}

file_put_contents(
    __DIR__ . '/../data/currencyByNumeric.php',
    "<?php\nreturn " . var_export($currencyDataByNumericId, true) . ';'
);
file_put_contents(
    __DIR__ . '/../data/currencyByAlpha.php',
    "<?php\nreturn " . var_export($currencyDataByAlphaId, true) . ';'
);