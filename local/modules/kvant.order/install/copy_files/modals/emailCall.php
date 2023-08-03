<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

ob_start();
?>

<style>
    .mfeedback {
        width: 80%;
        max-width: 500px;
        margin: 0 auto;
        padding: 20px;
        background: #f4f4f4;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    .mfeedback .mf-text {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    .mfeedback input[type="text"],
    .mfeedback textarea {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ddd;
    }

    .mfeedback input[type="submit"] {
        display: block;
        width: 100%;
        padding: 10px;
        background: #333;
        color: #fff;
        border: none;
        cursor: pointer;
    }

    .mfeedback input[type="submit"]:hover {
        background: #444;
    }
</style>

<script>
    window.onload = function() {
        document.querySelector('.mfeedback form').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Форма отправлена!');
            // ваш код для обработки формы здесь
        });

        console.log('232')
    }
</script>

<?php

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

ob_start();

$APPLICATION->IncludeComponent(
    'kvant:order',
    '.message',
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

