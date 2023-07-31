<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
\Bitrix\Main\Loader::IncludeModule("kvant.message");
\Bitrix\Main\Loader::includeModule('iblock');
use \kvant\Lists\Lists;

?>


<div class="mfeedback">
    <form action="#" method="POST">
        <input type="hidden" name="sessid" id="sessid" value="437ea5b2c784c1374cca65b348b74bef">
        <div class="mf-name">
            <div class="mf-text">Ваше имя<span class="mf-req">*</span></div>
            <input type="text" name="user_name" value="Никита Машинский">
        </div>
        <div class="mf-email">
            <div class="mf-text">Ваш E-mail<span class="mf-req">*</span></div>
            <input type="text" name="user_email" value="nmashinskiy@kvant-is.ru">
        </div>
        <div class="mf-message">
            <div class="mf-text">Сообщение</div>
            <textarea name="MESSAGE" rows="5" cols="40"></textarea>
        </div>
        <input type="hidden" name="PARAMS_HASH" value="7563c052c2521021428ba6e9b7de256a">
        <input type="submit" name="submit" value="Отправить">
    </form>
</div>

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
