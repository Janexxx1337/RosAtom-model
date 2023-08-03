<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Loader;
use Bitrix\Iblock\ElementTable;
use Bitrix\Catalog\PriceTable;

if (!Loader::includeModule('iblock') || !Loader::includeModule('catalog'))
    die('Модуль "Инфоблоки" или "Каталог" не установлен!');

$elements = ElementTable::getList(array(
    'select' => array('ID', 'NAME'),
    'filter' => array('IBLOCK_ID' => 14) // Укажите здесь ID вашего инфоблока
))->fetchAll();

$result = array_map(function($element) {
    // Получить цену товара
    $price = PriceTable::getList([
        'select' => ['PRICE'],
        'filter' => ['=PRODUCT_ID' => $element['ID']]
    ])->fetch();

    return array(
        'id' => $element['ID'], // Add this line
        'name' => $element['NAME'],
        'price' => $price ? $price['PRICE'] : null,
    );
}, $elements);


header('Content-Type: application/json');
echo json_encode($result);
