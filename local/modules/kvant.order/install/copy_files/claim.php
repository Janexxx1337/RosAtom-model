<?
/**
 * @global  \CMain $APPLICATION
 */
// подключение ядра
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$APPLICATION->SetTitle("Создание претензии");
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
//
//ini_set('error_reporting', E_ALL);
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);

require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');

$APPLICATION->IncludeComponent(
    'kvant:claim',
    '.default',
    array(
        'COMPONENT_TEMPLATE' => '.default',
        'SEF_FOLDER' => SITE_DIR . 'kvant.claim/',
        'SEF_MODE' => 'Y',
        'TYPE' => 'PAGE',
    ),
    false
);