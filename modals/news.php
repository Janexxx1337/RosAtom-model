<?php

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

ob_start();

$APPLICATION->IncludeComponent(
    'kvant:order',
    '.news',
    array(
        'COMPONENT_TEMPLATE' => '.default',
        'SEF_FOLDER' => SITE_DIR . 'kvant.claim/',
        'SEF_MODE' => 'Y',
        'TYPE' => 'PAGE',
    ),
    false
);


$html = ob_get_clean();

echo $html;
