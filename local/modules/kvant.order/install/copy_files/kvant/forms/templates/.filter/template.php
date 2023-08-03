<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
\Bitrix\Main\Loader::IncludeModule("kvant.filter");
\Bitrix\Main\Loader::includeModule('iblock');
use \kvant\Lists\Lists;

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Modal</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>
<body>

<section class="add__user content">
    <form action="" id="filter-form-calendar">
        <button class="close">
            <img src="images/x.png">
        </button>

        <div class="modal">
            <h2>Фильтр</h2>
            <form class='add__form'>

                <div class="add__form-head">
                    <select name="contr-buyer">
                        <option value="Организация">Контрагент-покупатель</option>
                        <option value="Option 1">Option 1</option>
                        <option value="Option 2">Option 2</option>
                        <option value="Option 3">Option 3</option>
                    </select>

                    <select name="contr-taker">
                        <option value="Роль">Контрагент-получатель</option>
                        <option value="Option 1">Option 1</option>
                        <option value="Option 2">Option 2</option>
                        <option value="Option 3">Option 3</option>
                    </select>

                    <select name="create-order">
                        <option value="Роль">Создал заказ</option>
                        <option value="Option 1">Option 1</option>
                        <option value="Option 2">Option 2</option>
                        <option value="Option 3">Option 3</option>
                    </select>
                </div>
            </form>

            <div class="calendar__filter" style="margin-top: 30px;">
                <div class="calendar__filter-titles">
                    <div class="calendar__filter-title">Дата создание заказа</div>
                    <div class="calendar__filter-title" style="margin-right: 49px">Дата отгрузки</div>
                    <div class="calendar__filter-title">Дата доставки</div>
                </div>
                <div class="calendar__filter-from">

                    <div class="calendar__filter-card">
                        <div class="from-head">
                            <p>От</p>
                            <span>15.06.2023</span>
                        </div>
                        <div class="calendar__trigger" id="calendar-trigger-0">
                            <input type="text" id="date-picker" name="create-order-field">
                            <svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M18.1667 8.33329H3.16669M14 1.66663V4.99996M7.33335 1.66663V4.99996M7.16669 18.3333H14.1667C15.5668 18.3333 16.2669 18.3333 16.8017 18.0608C17.2721 17.8211 17.6545 17.4387 17.8942 16.9683C18.1667 16.4335 18.1667 15.7334 18.1667 14.3333V7.33329C18.1667 5.93316 18.1667 5.2331 17.8942 4.69832C17.6545 4.22791 17.2721 3.84546 16.8017 3.60578C16.2669 3.33329 15.5668 3.33329 14.1667 3.33329H7.16669C5.76656 3.33329 5.06649 3.33329 4.53171 3.60578C4.06131 3.84546 3.67885 4.22791 3.43917 4.69832C3.16669 5.2331 3.16669 5.93316 3.16669 7.33329V14.3333C3.16669 15.7334 3.16669 16.4335 3.43917 16.9683C3.67885 17.4387 4.06131 17.8211 4.53171 18.0608C5.06649 18.3333 5.76656 18.3333 7.16669 18.3333Z"
                                      stroke="#4C6EF5" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                    </div>
                    -
                    <div class="calendar__filter-card">
                        <div class="from-head">
                            <p>До</p>
                            <span>15.06.2023</span>
                        </div>
                        <div class="calendar__trigger" id="calendar-trigger-1" name="create-order-field-1">
                            <input type="text" id="date-picker-1">
                            <svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M18.1667 8.33329H3.16669M14 1.66663V4.99996M7.33335 1.66663V4.99996M7.16669 18.3333H14.1667C15.5668 18.3333 16.2669 18.3333 16.8017 18.0608C17.2721 17.8211 17.6545 17.4387 17.8942 16.9683C18.1667 16.4335 18.1667 15.7334 18.1667 14.3333V7.33329C18.1667 5.93316 18.1667 5.2331 17.8942 4.69832C17.6545 4.22791 17.2721 3.84546 16.8017 3.60578C16.2669 3.33329 15.5668 3.33329 14.1667 3.33329H7.16669C5.76656 3.33329 5.06649 3.33329 4.53171 3.60578C4.06131 3.84546 3.67885 4.22791 3.43917 4.69832C3.16669 5.2331 3.16669 5.93316 3.16669 7.33329V14.3333C3.16669 15.7334 3.16669 16.4335 3.43917 16.9683C3.67885 17.4387 4.06131 17.8211 4.53171 18.0608C5.06649 18.3333 5.76656 18.3333 7.16669 18.3333Z"
                                      stroke="#4C6EF5" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                    </div>
                    -
                    <div class="calendar__filter-card">
                        <div class="from-head">
                            <p>От</p>
                            <span>15.06.2023</span>
                        </div>
                        <div class="calendar__trigger" id="calendar-trigger-2" name="create-order-field-2">
                            <input type="text" id="date-picker-2">
                            <svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M18.1667 8.33329H3.16669M14 1.66663V4.99996M7.33335 1.66663V4.99996M7.16669 18.3333H14.1667C15.5668 18.3333 16.2669 18.3333 16.8017 18.0608C17.2721 17.8211 17.6545 17.4387 17.8942 16.9683C18.1667 16.4335 18.1667 15.7334 18.1667 14.3333V7.33329C18.1667 5.93316 18.1667 5.2331 17.8942 4.69832C17.6545 4.22791 17.2721 3.84546 16.8017 3.60578C16.2669 3.33329 15.5668 3.33329 14.1667 3.33329H7.16669C5.76656 3.33329 5.06649 3.33329 4.53171 3.60578C4.06131 3.84546 3.67885 4.22791 3.43917 4.69832C3.16669 5.2331 3.16669 5.93316 3.16669 7.33329V14.3333C3.16669 15.7334 3.16669 16.4335 3.43917 16.9683C3.67885 17.4387 4.06131 17.8211 4.53171 18.0608C5.06649 18.3333 5.76656 18.3333 7.16669 18.3333Z"
                                      stroke="#4C6EF5" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                    </div>
                    -
                    <div class="calendar__filter-card">
                        <div class="from-head">
                            <p>До</p>
                            <span>15.06.2023</span>
                        </div>
                        <div class="calendar__trigger" id="calendar-trigger-3" name="create-order-field-3">
                            <input type="text" id="date-picker-3">
                            <svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M18.1667 8.33329H3.16669M14 1.66663V4.99996M7.33335 1.66663V4.99996M7.16669 18.3333H14.1667C15.5668 18.3333 16.2669 18.3333 16.8017 18.0608C17.2721 17.8211 17.6545 17.4387 17.8942 16.9683C18.1667 16.4335 18.1667 15.7334 18.1667 14.3333V7.33329C18.1667 5.93316 18.1667 5.2331 17.8942 4.69832C17.6545 4.22791 17.2721 3.84546 16.8017 3.60578C16.2669 3.33329 15.5668 3.33329 14.1667 3.33329H7.16669C5.76656 3.33329 5.06649 3.33329 4.53171 3.60578C4.06131 3.84546 3.67885 4.22791 3.43917 4.69832C3.16669 5.2331 3.16669 5.93316 3.16669 7.33329V14.3333C3.16669 15.7334 3.16669 16.4335 3.43917 16.9683C3.67885 17.4387 4.06131 17.8211 4.53171 18.0608C5.06649 18.3333 5.76656 18.3333 7.16669 18.3333Z"
                                      stroke="#4C6EF5" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                    </div>
                    -
                    <div class="calendar__filter-card">
                        <div class="from-head">
                            <p>От</p>
                            <span>15.06.2023</span>
                        </div>
                        <div class="calendar__trigger" id="calendar-trigger-4" name="create-order-field-4">
                            <input type="text" id="date-picker-4">
                            <svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M18.1667 8.33329H3.16669M14 1.66663V4.99996M7.33335 1.66663V4.99996M7.16669 18.3333H14.1667C15.5668 18.3333 16.2669 18.3333 16.8017 18.0608C17.2721 17.8211 17.6545 17.4387 17.8942 16.9683C18.1667 16.4335 18.1667 15.7334 18.1667 14.3333V7.33329C18.1667 5.93316 18.1667 5.2331 17.8942 4.69832C17.6545 4.22791 17.2721 3.84546 16.8017 3.60578C16.2669 3.33329 15.5668 3.33329 14.1667 3.33329H7.16669C5.76656 3.33329 5.06649 3.33329 4.53171 3.60578C4.06131 3.84546 3.67885 4.22791 3.43917 4.69832C3.16669 5.2331 3.16669 5.93316 3.16669 7.33329V14.3333C3.16669 15.7334 3.16669 16.4335 3.43917 16.9683C3.67885 17.4387 4.06131 17.8211 4.53171 18.0608C5.06649 18.3333 5.76656 18.3333 7.16669 18.3333Z"
                                      stroke="#4C6EF5" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                    </div>
                    -
                    <div class="calendar__filter-card">
                        <div class="from-head">
                            <p>До</p>
                            <span>15.06.2023</span>
                        </div>
                        <div class="calendar__trigger" id="calendar-trigger-5" name="create-order-field-5">
                            <input type="text" id="date-picker-5">
                            <svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M18.1667 8.33329H3.16669M14 1.66663V4.99996M7.33335 1.66663V4.99996M7.16669 18.3333H14.1667C15.5668 18.3333 16.2669 18.3333 16.8017 18.0608C17.2721 17.8211 17.6545 17.4387 17.8942 16.9683C18.1667 16.4335 18.1667 15.7334 18.1667 14.3333V7.33329C18.1667 5.93316 18.1667 5.2331 17.8942 4.69832C17.6545 4.22791 17.2721 3.84546 16.8017 3.60578C16.2669 3.33329 15.5668 3.33329 14.1667 3.33329H7.16669C5.76656 3.33329 5.06649 3.33329 4.53171 3.60578C4.06131 3.84546 3.67885 4.22791 3.43917 4.69832C3.16669 5.2331 3.16669 5.93316 3.16669 7.33329V14.3333C3.16669 15.7334 3.16669 16.4335 3.43917 16.9683C3.67885 17.4387 4.06131 17.8211 4.53171 18.0608C5.06649 18.3333 5.76656 18.3333 7.16669 18.3333Z"
                                      stroke="#4C6EF5" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="calendar__selection-footer">
                <select name="contr-buyer-footer">
                    <option value="Организация">Контрагент-покупатель</option>
                    <option value="Option 1">Option 1</option>
                    <option value="Option 2">Option 2</option>
                    <option value="Option 3">Option 3</option>
                </select>

                <select name="contr-status-footer">
                    <option value="Организация">Статус оплат</option>
                    <option value="Option 1">Option 1</option>
                    <option value="Option 2">Option 2</option>
                    <option value="Option 3">Option 3</option>
                </select>
            </div>
            <div class="access-buttons" style="display: flex;justify-content: space-between">
                <div style="display: flex;gap: 16px">
                    <button class="add-btn" type="submit">Применить</button>
                    <button type="submit" style=" color: #000;background: #fff;border: 1px solid #4C6EF5;}">Отменить</button>
                </div>
                <button class="clean-btn">Очистить фильтр</button>
            </div>
        </div>
    </form>
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
        line-height: 150%; 

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
        max-width: 1100px;
    }

    .modal {
        padding-bottom: 32px;
    }

    select {
        padding: 14px;
        border-radius: 5px;
        border: 1px solid #C0C9D2;
    }

    select {
        font-size: 16px;
        font-style: normal;
        font-weight: 400;
        line-height: 150%; /* 24px */
        outline: none;
    }

    select {
        padding: 14px;
    }

    .add__form {
        display: flex;
        flex-direction: column;
        row-gap: 16px;
        margin-top: 24px;
    }

    .add__form-head {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
        margin-top: 24px;
    }

    .add__form-head select {
        width: 33.3%;
    }

    .close {
        margin-left: 98%;
        border: none;
        background: none;
        width: 24px;
        height: 24px;
    }

    input.form-control.input {
        width: 0;
        height: 0;
        visibility: hidden;
    }

    .from-head p {
        color: #7A859D;
        font-size: 10px;
        font-style: normal;
        font-weight: 400;
        line-height: 130%; /* 13px */
    }

    .calendar__filter-from {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .calendar__filter-card {
        display: flex;
        padding: 9px 12px;
        border-radius: 4px;
        border: 1px solid #C0C9D2;
        width: 20%;
    }

    .calendar__filter-titles {
        display: flex;
        justify-content: space-between;
        padding: 0 228px 0 2px;
    }

    .calendar__filter-title {
        color: #393949;
        font-size: 14px;
        font-style: normal;
        font-weight: 400;
        line-height: 100%; /* 14px */
    }

    .calendar__filter-from {
        margin-top: 8px;
    }

    .calendar__selection-footer {
        display: flex;
        gap: 11px;
        align-items: center;
        margin-top: 16px;
    }

    .calendar__selection-footer select{
        width: 49.5%;
    }

    .access-buttons .clean-btn {
        color: #4C6EF5;
        font-size: 14px;
        font-style: normal;
        background-color: #fff;
        font-weight: 400;
        line-height: 150%; /* 21px */
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/ru.js"></script>
<script>
    const dateSpans = document.querySelectorAll('.calendar__filter-card span');
    const datePickers = ['#date-picker', '#date-picker-1', '#date-picker-2', '#date-picker-3', '#date-picker-4', '#date-picker-5'];

    datePickers.forEach((picker, index) => {
        let datepicker = flatpickr(picker, {
            altInput: true,
            altFormat: "d.m.Y",
            dateFormat: "Y-m-d",
            allowInput: true,
            clickOpens: false,
            locale: "ru",
            onChange: function (selectedDates, dateStr, instance) {
                // Обновляем содержимое span новой датой
                dateSpans[index].textContent = instance.altInput.value;
            }
        });

        document.getElementById(`calendar-trigger-${(index - 1) + 1}`).addEventListener('click', function () {
            datepicker.open();
        });
    });
</script>


</body>
</html>

