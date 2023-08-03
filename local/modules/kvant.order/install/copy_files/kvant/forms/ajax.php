<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Application;
use Bitrix\Main\Web\Json;

// Проверка запроса на AJAX
if (!Application::getInstance()->getContext()->getRequest()->isAjaxRequest()){
    die();
}

// Ваша логика обработчика здесь
$response = [
    'status' => 'success',
    'message' => 'Данные получены'
];

// Возвращение ответа в формате JSON
echo Json::encode($response);
?>
