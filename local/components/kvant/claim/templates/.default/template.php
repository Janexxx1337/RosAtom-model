<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
\Bitrix\Main\Loader::IncludeModule("kvant.order");
\Bitrix\Main\Loader::includeModule('iblock');

use \kvant\Lists\Lists;

?>


<section class="table content">
    <div class="table__head">
        <div class="table__head-order">
            <p>Список претензий</p>
            <button id="add-btn" class="add-btn btn">Создать претензию</button>
        </div>
        <div class="table__head-buttons">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M21.5 18L14.8571 12M9.14286 12L2.50003 18M2 7L10.1649 12.7154C10.8261 13.1783 11.1567 13.4097 11.5163 13.4993C11.8339 13.5785 12.1661 13.5785 12.4837 13.4993C12.8433 13.4097 13.1739 13.1783 13.8351 12.7154L22 7M6.8 20H17.2C18.8802 20 19.7202 20 20.362 19.673C20.9265 19.3854 21.3854 18.9265 21.673 18.362C22 17.7202 22 16.8802 22 15.2V8.8C22 7.11984 22 6.27976 21.673 5.63803C21.3854 5.07354 20.9265 4.6146 20.362 4.32698C19.7202 4 18.8802 4 17.2 4H6.8C5.11984 4 4.27976 4 3.63803 4.32698C3.07354 4.6146 2.6146 5.07354 2.32698 5.63803C2 6.27976 2 7.11984 2 8.8V15.2C2 16.8802 2 17.7202 2.32698 18.362C2.6146 18.9265 3.07354 19.3854 3.63803 19.673C4.27976 20 5.11984 20 6.8 20Z"
                      stroke="#4C6EF5" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>

            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M13 7L11.8845 4.76892C11.5634 4.1268 11.4029 3.80573 11.1634 3.57116C10.9516 3.36373 10.6963 3.20597 10.4161 3.10931C10.0992 3 9.74021 3 9.02229 3H5.2C4.0799 3 3.51984 3 3.09202 3.21799C2.71569 3.40973 2.40973 3.71569 2.21799 4.09202C2 4.51984 2 5.0799 2 6.2V7M2 7H17.2C18.8802 7 19.7202 7 20.362 7.32698C20.9265 7.6146 21.3854 8.07354 21.673 8.63803C22 9.27976 22 10.1198 22 11.8V16.2C22 17.8802 22 18.7202 21.673 19.362C21.3854 19.9265 20.9265 20.3854 20.362 20.673C19.7202 21 18.8802 21 17.2 21H6.8C5.11984 21 4.27976 21 3.63803 20.673C3.07354 20.3854 2.6146 19.9265 2.32698 19.362C2 18.7202 2 17.8802 2 16.2V7Z"
                      stroke="#4C6EF5" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>


            <button class="table__add-user">

            </button>
        </div>

    </div>

    <div class="table__subhead">
        <div class="table__search" style="display: flex;align-items: center">
            <svg class="glass" width="20" height="20" viewBox="0 0 20 20" fill="none"
                 xmlns="http://www.w3.org/2000/svg">
                <path d="M17.5 17.5L13.875 13.875M15.8333 9.16667C15.8333 12.8486 12.8486 15.8333 9.16667 15.8333C5.48477 15.8333 2.5 12.8486 2.5 9.16667C2.5 5.48477 5.48477 2.5 9.16667 2.5C12.8486 2.5 15.8333 5.48477 15.8333 9.16667Z"
                      stroke="#A0A5BA" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <input type="text" placeholder="Поиск">
            <div class="table__filter">
                <button class="filter__button">

                </button>
                <p>Фильтр</p>
            </div>
        </div>


        <button  class="table__subhead-button btn">
            Экспорт в Excel
        </button>
    </div>

    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Организация</th>
            <th>Контрагент</th>
            <th>Связанная заявка</th>
            <th>Создатель</th>
            <th>Дата</th>
            <th>Статус</th>
            <th>Управление</th>
        </tr>
        </thead>
        <tbody>


        <?
        $IDs = Lists::getIDs();
        // Получаем элементы смарт-процесса
        $factory = Lists::getSPElements($IDs["SP_claim"]);
        //Получаем списки, которые имитируют 1С
        $arrOrganization = Lists::getEnum($IDs["list_organization"]);
        $arrKontrOrganization = Lists::getEnum($IDs["list_kontrOrganization"]);
        // Выбираем только нужные нам данные из полей СП
        $elements = $factory->getItems(array(
            "select" => array('ID',
                'UF_CRM_3_ORGANISATION',
                'UF_CRM_3_CUSTOMERS',
                'CREATED_BY',
                'CREATED_TIME',
                'STAGE_ID',
            )
        ));
        $arrStages = Lists::getStatusName(139);

        // выводим каждый элемент в виде строки
        foreach ($elements as $el) {
            $data = $el->getData();
            // ID организации поставщика
            $organizationPrimary = $data["UF_CRM_3_ORGANISATION"];
            // ID контрагента
            $kontrOrganization = $data["UF_CRM_3_CUSTOMERS"];
            // ID создателя
            $creatorID = $data["CREATED_BY"];
            $createDate = $data["CREATED_TIME"];
            $stageId = $data["STAGE_ID"];

            ?>
            <tr data-elementId="<?=$data["ID"]?>">

                <td><?= $data["ID"]; ?></td>
                <td><?= $arrOrganization[$organizationPrimary] ?></td>
                <td><?= $arrKontrOrganization[$kontrOrganization]; ?></td>
                <td>-</td>
                <td><?= Lists::getUserName($creatorID) ?></td>
                <td><?= $createDate; ?></td>
                <td><?= $arrStages[$stageId]; ?></td>
                <td>

                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15 8.33334L11.6667 5M2.08331 17.9167L4.90362 17.6033C5.24819 17.565 5.42048 17.5459 5.58152 17.4937C5.72439 17.4475 5.86035 17.3821 5.98572 17.2995C6.12702 17.2063 6.2496 17.0837 6.49475 16.8386L17.5 5.83334C18.4205 4.91286 18.4205 3.42048 17.5 2.5C16.5795 1.57953 15.0871 1.57953 14.1667 2.5L3.16142 13.5052C2.91627 13.7504 2.79369 13.873 2.70051 14.0143C2.61784 14.1396 2.55249 14.2756 2.50624 14.4185C2.45411 14.5795 2.43497 14.7518 2.39668 15.0964L2.08331 17.9167Z"
                              stroke="#4C6EF5" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <button data-delBtnId="<?=$data["ID"]?>" class="del_btn" >
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15 5L5 15M5 5L15 15" stroke="#4C6EF5" stroke-width="1.3" stroke-linecap="round"
                              stroke-linejoin="round"/>
                    </svg>
                    </button>
                </td>
            </tr>
        <? } ?>
        <!-- Дополнительные строки -->
        </tbody>
    </table>
</section>
<div id="test"></div>
</body>


<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap');

    * {
        box-sizing: border-box;
        padding: 0;
        margin: 0;
    }

    body {
        font-family: 'Inter', sans-serif;
    }

    .content {
        width: 100%;
        margin: 0 auto;
        padding: 0 36px;
    }
    button {
        background: none;
        border: none;
        cursor: pointer;
    }
    .btn {
        border-radius: 40px;
        background: #4C6EF5;
        height: 50px;
        padding: 6px 16px;
        color: #fff;
        border: #4C6EF5;
        cursor: pointer;
        font-size: 14px;
        font-style: normal;
        font-weight: 400;
        line-height: 150%;
    }

    .table {
        background-color: #fff;
        border-collapse: separate;
        border-spacing: 0;
        border-radius: 6px;
        margin-top: 35px;
        width: 100%;
    }

    .table tbody tr {
        padding-left: 50px; /* измените это значение, чтобы достичь нужного вам смещения */
    }


    .table th {
        color: #393949;
        font-size: 14px;
        font-style: normal;
        font-weight: 400;
        line-height: 150%; /* 21px */
        border-bottom: 1px solid #E4EAF0;
        padding: 20px 0;
    }

    .table__search {
        position: relative;
        gap: 30px;
    }

    .table__search input {
        width: 30vw;
        padding: 8px 12px 8px 30px;
        border: 1px solid #E4EAF0;
        border-radius: 5px;
    }

    .table__search .glass {
        position: absolute;
        top: 50%;
        left: 5px;
        transform: translateY(-50%);
    }

    .table__search input::placeholder {
        color: #8E92A2;
        font-size: 13px;
        font-style: normal;
        font-weight: 400;
        line-height: 150%; /* 19.5px */
    }


    .table tbody {
        border-top: 1px solid #E4EAF0;
        width: 100%;
    }

    .table tbody td {
        padding: 24px 0;
        text-align: center;
    }

    .table__filter p {
        color: #8E92A2;
        font-size: 14px;
        font-style: normal;
        font-weight: 400;
        line-height: 150%; /* 21px */
    }


    .table__head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 1px solid #E4EAF0;
        width: 100%;
        padding: 20px 0;

    }


    .table__head-order, .table__head-buttons, .table__filter {
        display: flex;
        gap: 50px;
    }

    .table__head-order {
        align-items: center;
    }


    .table__head-order p {
        color: #393949;
        font-size: 14px;
        font-style: normal;
        font-weight: 400;
        line-height: 150%; /* 21px */
    }


    .table__subhead {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 24px 20px;
    }

    .table__search {
        position: relative;
        gap: 30px;
    }

    .table__search input {
        padding: 8px 12px;
        width: 30vw
    }

    .table__search .glass {
        position: absolute;
        top: 50%;
        left: 5px;
        transform: translateY(-50%);
    }

    .table__search input {
        padding-left: 30px;
        border: 1px solid #E4EAF0;
        border-radius: 5px;
    }

    .table__search input::placeholder {
        color: #8E92A2;
        font-size: 13px;
        font-style: normal;
        font-weight: 400;
        line-height: 150%; /* 19.5px */
    }


    .table__filter p {
        color: #8E92A2;
        font-size: 14px;
        font-style: normal;
        font-weight: 400;
        line-height: 150%; /* 21px */
    }


    .order__type p {
        margin-top: 16px;
    }

    .order__type span {
        color: #8E92A2;
        font-size: 14px;
        font-style: normal;
        font-weight: 400;
        line-height: 150%; /* 21px */
    }


    .table__add-user {
        background: url('images/user-plus-01.png') no-repeat center center;
        background-size: contain;
    }

    .filter__button {
        background: url('images/settings-04.png') no-repeat center center;
        background-size: contain;
    }


    .order__organization p {
        color: #393949;
        font-size: 14px;
        font-style: normal;
        font-weight: 400;
        line-height: 150%; /* 21px */
    }
</style>

<?php
CJSCore::Init(['popup']);
?>

<script>

    BX.ready(function () {
        var popup = null;
        BX.bind(BX('add-btn'), 'click', function() {
            if (!popup) {
                BX.ajax.insertToNode('/modals/ajaxClaim.php', BX('test'));
                var popup = BX.PopupWindowManager.create("newClaim", window.body, {
                    content: BX('test'),
                    width: 900, // ширина окна
                    height: 500, // высота окна
                    zIndex: 100, // z-index
                    closeIcon: {
                        // объект со стилями для иконки закрытия, при null - иконки не будет
                        opacity: 1
                    },
                    titleBar: 'Новый заказ',
                    closeByEsc: true, // закрытие окна по esc
                    darkMode: false, // окно будет светлым или темным
                    autoHide: true, // закрытие при клике вне окна
                    draggable: false, // можно двигать или нет
                    resizable: false, // можно ресайзить
                    min_height: 100, // минимальная высота окна
                    min_width: 100, // минимальная ширина окна
                    lightShadow: true, // использовать светлую тень у окна
                    angle: false, // появится уголок
                    overlay: {
                        // объект со стилями фона
                        backgroundColor: 'black',
                        opacity: 500
                    },
                    buttons: [
                        new BX.PopupWindowButton({
                            text: 'Создать заказ', // текст кнопки
                            id: 'save-btn', // идентификатор
                            className: 'ui-btn ui-btn-success', // доп. классы
                            events: {
                                click: function () {
                                    console.log(this)
                                }
                            }
                        }),
                        new BX.PopupWindowButton({
                            text: 'Отменить',
                            id: 'close-btn',
                            className: 'ui-btn ui-btn-primary',
                            events: {
                                click: function () {
                                    popup.close();
                                }
                            }
                        })
                    ],
                    events: {
                        onPopupShow: function () {
                            // Событие при показе окна
                        },
                        onPopupClose: function () {
                            // Событие при закрытии окна
                        }
                    }
                });
                popup.show();
            }

        });
        const fadeOut = (el, timeout) => {
            el.style.opacity = 1;
            el.style.transition = `opacity ${timeout}ms`;
            el.style.opacity = 0;

            setTimeout(() => {
                el.style.display = 'none';
            }, timeout);
        };
        document.querySelectorAll('.del_btn').forEach(el=> {
            el.addEventListener("click", (e) => {
              const elementId =  e.currentTarget.dataset.delbtnid;
                if (confirm("Вы действительно хотите удалить элемент?")) {
                    const SpId = <?Print($IDs["SP_claim"]);?>;
                    const tr = document.querySelector(`tr[data-elementId="${elementId}"]`);
                    fadeOut(tr, 500);
                   BX.rest.callMethod('crm.item.delete', {entityTypeId:SpId, id: elementId})
                }
            })
        })
    });





</script>
