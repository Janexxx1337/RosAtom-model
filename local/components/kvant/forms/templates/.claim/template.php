<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
\Bitrix\Main\Loader::IncludeModule("kvant.claim");
\Bitrix\Main\Loader::includeModule('iblock');
use \kvant\Lists\Lists;

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modal</title>
</head>
<body>

<section class="add__user content">
    <button class="close">
        <img src="images/x.png">
    </button>

    <div class="modal">
        <h2>Новая претензия</h2>
        <form class='add__form' id="add__form">
            <select name="org-sup">
                <option value="Организация">Организация-поставщик</option>
                <option value="Option 1">Option 1</option>
                <option value="Option 2">Option 2</option>
                <option value="Option 3">Option 3</option>
            </select>
            <select name="contr-buyer">
                <option value="Роль">Контрагент-покупатель</option>
                <option value="Option 1">Option 1</option>
                <option value="Option 2">Option 2</option>
                <option value="Option 3">Option 3</option>
            </select>

            <textarea name="claim-description" placeholder="Описание претензии">
</textarea>
            <textarea placeholder="Прочие комментарии" name="claim-comment">
</textarea>

            <div class="form__add-files">
                <p class="comment-text">Приложить файлы</p>
                <div class="add__files-wrapper">

                    <div style="display: flex; gap: 14px">
                        <select id="fileType" style="margin-top: 16px; width: 250px">
                            <option value="" disabled selected>Вид файла</option>
                            <option value="Роль">Рекламация</option>
                            <option value="Option 1">Рекламация</option>
                            <option value="Option 2">Option 2</option>
                            <option value="Option 3">Option 3</option>
                        </select>


                        <div class="more__files" style="position: relative; display: block; width: 50%;margin-top: 16px;cursor: pointer">
                            <input type="file" id="file-add-1" style="opacity: 0; position: absolute; width: 100%; height: 100%; cursor: pointer;">
                            <div style="display: flex; align-items: center; justify-content: space-between; border: 1px solid #ccc; padding: 2px 8px;">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M17.6271 9.08296L10.1141 16.596C8.40556 18.3045 5.63546 18.3045 3.92692 16.596C2.21837 14.8874 2.21837 12.1173 3.92692 10.4088L11.4399 2.89578C12.579 1.75675 14.4257 1.75675 15.5647 2.89578C16.7037 4.0348 16.7037 5.88154 15.5647 7.02057L8.34633 14.2389C7.77682 14.8085 6.85345 14.8085 6.28394 14.2389C5.71442 13.6694 5.71442 12.7461 6.28394 12.1766L12.6184 5.84205" stroke="#4C6EF5" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <input type="text" placeholder="Добавить еще файл" style="border: none; flex-grow: 1;">
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <div class="more__files" style="position: relative; display: inline-block; width: 100%;">
                <input type="file" id="file-add" style="opacity: 0; position: absolute; width: 100%; height: 100%; cursor: pointer;">
                <div style="display: flex; align-items: center; justify-content: space-between; border: 1px solid #ccc; padding: 2px 8px;">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-right: 10px;">
                        <path d="M10 4.16663V15.8333M4.16669 9.99996H15.8334" stroke="#8E92A2" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <input type="text" placeholder="Добавить еще файл" style="border: none; flex-grow: 1;">
                </div>
            </div>
        </form>
        <div class="access-buttons">
            <button class="add-btn" type="submit">Создать претензию</button>
            <button class="cancel-btn" type="button" style=" color: #000;background: #fff;border: 1px solid #4C6EF5;}">
                Отменить
            </button>
        </div>
    </div>
</section>


<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', sans-serif;
    }

    button {
        border-radius: 3px;
        background: #4C6EF5;
        height: 50px;
        padding: 12px 20px;
        color: #fff;
        border: #4C6EF5;
        cursor: pointer;
        font-size: 14px;
        font-style: normal;
        font-weight: 400;
        line-height: 150%; /* 21px */

    }

    .access-buttons {
        margin-top: 24px;
        display: flex;
        align-items: center;
        gap: 16px;
    }


    .content {
        max-width: 1440px;
        width: 100%;
        margin: 0 auto;
        padding: 5px 36px;
    }

    .add__user {
        background-color: #fff;
        border-radius: 12px;
        margin-top: 60px;
        max-width: 550px;
    }

    .modal {
        padding-bottom: 32px;
    }

    textarea {
        overflow-y: hidden;
    }

    input, select, textarea {
        padding: 14px;
        border-radius: 5px;
        border: 1px solid #C0C9D2;
        outline: none;
    }

    textarea::placeholder {
        border-radius: 5px;
        outline: none;
        color: #8E92A2;
        font-size: 16px;
        font-style: normal;
        font-weight: 400;
        line-height: 150%; /* 24px */
    }

    select, textarea {
        font-size: 16px;
        font-style: normal;
        font-weight: 400;
        line-height: 150%; /* 24px */
        outline: none;
        padding: 14px;
    }

    .add-btn {
        color: #FFF;
        font-size: 16px;
        font-style: normal;
        font-weight: 400;
        line-height: 150%;
    }

    .cancel-btn {
        color: #393949;
        font-size: 16px;
        font-style: normal;
        font-weight: 400;
        line-height: 150%;
    }

    input::placeholder {
        color: #8E92A2;
        font-size: 16px;
        font-style: normal;
        font-weight: 400;
        line-height: 150%; /* 24px */
    }

    .add__form {
        display: flex;
        flex-direction: column;
        row-gap: 16px;
        margin-top: 24px;
    }

    .comment-text {
        color: #393949;
        font-size: 18px;
        font-style: normal;
        font-weight: 700;
        line-height: 150%; /* 27px */
    }

    .close {
        margin-left: 98%;
        border: none;
        background: none;
        width: 24px;
        height: 24px;
    }



</style>

<script>
    const formElement = document.querySelector('#add__form'); // Выбираем форму

    fetch('/bitrix/components/kvant/forms/ajax.php', {
        method: 'POST',
        body: new FormData(formElement) // Передаем объект формы в FormData
    })
        .then(response => {
            response.text().then(text => console.log(text)); // Посмотрите, что на самом деле возвращает сервер
            return response.json();
        })
</script>

</body>
</html>