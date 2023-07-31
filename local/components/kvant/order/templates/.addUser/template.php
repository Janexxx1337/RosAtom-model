<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
\Bitrix\Main\Loader::IncludeModule("kvant.addUser");
\Bitrix\Main\Loader::includeModule('iblock');

use \kvant\Lists\Lists;
?>

<section class="add__user content">

    <div class="modal">
        <h2>Новый пользователь</h2>
        <form class='add__form'>
            <select name="organization">
                <option value="Организация">Организация</option>
                <option value="Option 1">Option 1</option>
                <option value="Option 2">Option 2</option>
                <option value="Option 3">Option 3</option>
            </select>
            <input type="text" name="fullname" placeholder="ФИО">
            <input type="text" name="position" placeholder="Должность">
            <input type="text" name="email" placeholder="E-mail">
            <input type="text" name="phone" placeholder="Телефон">
            <input type="password" name="password" placeholder="Пароль">
            <select name="role">
                <option value="Роль">Роль</option>
                <option value="Option 1">Option 1</option>
                <option value="Option 2">Option 2</option>
                <option value="Option 3">Option 3</option>
            </select>
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

    .add__user button {
        border-radius: 3px;
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

    .access-buttons button {
        background: #4C6EF5;
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

    .add__user   input, select {
        padding: 14px;
        border-radius: 5px;
        border: 1px solid #C0C9D2;
    }

    .add__user  select, input {
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

</style>