<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
\Bitrix\Main\Loader::IncludeModule("kvant.newOrder");
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
        <h2>Новый заказ</h2>
        <form class='add__form'>
            <select>
                <option value="Организация">Организация-поставщик</option>
                <option value="Option 1">Option 1</option>
                <option value="Option 2">Option 2</option>
                <option value="Option 3">Option 3</option>
            </select>


            <select>
                <option value="Организация">Контрагент-покупатель</option>
                <option value="Option 1">Option 1</option>
                <option value="Option 2">Option 2</option>
                <option value="Option 3">Option 3</option>
            </select>

            <select>
                <option value="Организация">Контрагент-получатель</option>
                <option value="Option 1">Option 1</option>
                <option value="Option 2">Option 2</option>
                <option value="Option 3">Option 3</option>
            </select>

            <select>
                <option value="Организация">Сделка</option>
                <option value="Option 1">Option 1</option>
                <option value="Option 2">Option 2</option>
                <option value="Option 3">Option 3</option>
            </select>
            <select>

                <option value="Организация">Договор</option>
                <option value="Option 1">Option 1</option>
                <option value="Option 2">Option 2</option>
                <option value="Option 3">Option 3</option>
            </select>
            <select>

                <option value="Организация">Тип заказа</option>
                <option value="Option 1">Option 1</option>
                <option value="Option 2">Option 2</option>
                <option value="Option 3">Option 3</option>
            </select>
            <select>

                <option value="Организация">Товар</option>
                <option value="Option 1">Option 1</option>
                <option value="Option 2">Option 2</option>
                <option value="Option 3">Option 3</option>
            </select>


            <select>
                <option value="Организация">Самовывоз</option>
                <option value="Option 1">Option 1</option>
                <option value="Option 2">Option 2</option>
                <option value="Option 3">Option 3</option>
            </select>

            <input type="text" placeholder="Дата отгрузки">
            <input type="text" placeholder="Дата доставки">
            <input type="text" placeholder="Адрес доставки">

            <select>
                <option value="Роль">Способ оплаты</option>
                <option value="Option 1">Option 1</option>
                <option value="Option 2">Option 2</option>
                <option value="Option 3">Option 3</option>
            </select>

            <select>
                <option value="Роль">Дополнительные опции</option>
                <option value="Option 1">Option 1</option>
                <option value="Option 2">Option 2</option>
                <option value="Option 3">Option 3</option>
            </select>

            <select>
                <option value="Роль">Роль</option>
                <option value="Option 1">Option 1</option>
                <option value="Option 2">Option 2</option>
                <option value="Option 3">Option 3</option>
            </select>

            <input type="text" placeholder="Внутренний номера заказа">

            <textarea placeholder="Прочие комментарии">
</textarea>


            <div class="form__add-files">
                <p class="comment-text">Приложить файлы</p>
                <div class="add__files-wrapper">

                    <select id="fileType" style="width: 250px; height: 49px">
                        <option value="" disabled selected>Вид файла</option>
                        <option value="Роль">Рекламация</option>
                        <option value="Option 1">Рекламация</option>
                        <option value="Option 2">Option 2</option>
                        <option value="Option 3">Option 3</option>
                    </select>


                    <label for="file-upload" style="cursor: pointer; position: relative; display: inline-block; outline: none">
                        <svg style="position: absolute; top: 50%; left: 5px; transform: translateY(-50%);" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17.6271 9.0829L10.1141 16.5959C8.40553 18.3045 5.63544 18.3045 3.92689 16.5959C2.21835 14.8874 2.21835 12.1173 3.92689 10.4087L11.4399 2.89571C12.5789 1.75669 14.4257 1.75669 15.5647 2.89571C16.7037 4.03474 16.7037 5.88147 15.5647 7.0205L8.34631 14.2389C7.7768 14.8084 6.85343 14.8084 6.28392 14.2389C5.7144 13.6694 5.7144 12.746 6.28392 12.1765L12.6184 5.84199" stroke="#4C6EF5" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <input type="text" placeholder="Приложите файл" style="padding-left: 30px;height: 49px; "/>
                        <input id="file-upload" type="file" style="display: none;"/>
                    </label>
                </div>
            </div>

            <div class="more__files" style="position: relative; width: 100%;border-radius: 5px">
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
            <button class="add-btn" type="submit">Добавить пользователя</button>
            <button type="button" style=" color: #000;background: #fff;border: 1px solid #4C6EF5;}">Отменить</button>
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
        height: 50px;
        background: #4C6EF5;
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

    input, select {
        padding: 14px;
        border-radius: 5px;
        border: 1px solid #C0C9D2;
    }

    select, input {
        font-size: 16px;
        font-style: normal;
        font-weight: 400;
        line-height: 150%; /* 24px */
        outline: none;
    }

    .add__form {
        display: flex;
        flex-direction: column;
        row-gap: 16px;
        margin-top: 24px;
    }

    .close {
        margin-left: 98%;
        border: none;
        background: none;
        width: 24px;
        height: 24px;
    }

    textarea {
        padding: 14px;
        border-radius: 5px;
        border: 1px solid #C0C9D2;
        outline: none;
    }

    textarea::placeholder {
        color: #8E92A2;
        font-size: 16px;
        font-style: normal;
        font-weight: 400;
        line-height: 150%; /* 24px */
    }
    .add__files-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 14px;
    }

</style>
</body>
</html>
