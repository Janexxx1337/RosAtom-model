<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
\Bitrix\Main\Loader::IncludeModule("kvant.order");
\Bitrix\Main\Loader::includeModule('iblock');

use \kvant\Lists\Lists;
use Bitrix\Main\Type\DateTime;

?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">
<link rel="stylesheet" href="/modals/style.css">

<section class="table content">

    <div class="table__head">

        <div style="display: flex;align-items: center;gap: 50px;">
            <p class="list-orders" id="test" >Список заказов</p>
            <button type="submit" class="add-btn" id="add-btn">Создать заказ</button>
        </div>
        <div class="table__head-buttons">
            <div class="add__email" id="add__email">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M21.5 18L14.8571 12M9.14286 12L2.50003 18M2 7L10.1649 12.7154C10.8261 13.1783 11.1567 13.4097 11.5163 13.4993C11.8339 13.5785 12.1661 13.5785 12.4837 13.4993C12.8433 13.4097 13.1739 13.1783 13.8351 12.7154L22 7M6.8 20H17.2C18.8802 20 19.7202 20 20.362 19.673C20.9265 19.3854 21.3854 18.9265 21.673 18.362C22 17.7202 22 16.8802 22 15.2V8.8C22 7.11984 22 6.27976 21.673 5.63803C21.3854 5.07354 20.9265 4.6146 20.362 4.32698C19.7202 4 18.8802 4 17.2 4H6.8C5.11984 4 4.27976 4 3.63803 4.32698C3.07354 4.6146 2.6146 5.07354 2.32698 5.63803C2 6.27976 2 7.11984 2 8.8V15.2C2 16.8802 2 17.7202 2.32698 18.362C2.6146 18.9265 3.07354 19.3854 3.63803 19.673C4.27976 20 5.11984 20 6.8 20Z"
                          stroke="#4C6EF5" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>

            <div class="add-file" id="add-file">
                <input type="file" id="fileInput" style="display: none;"/>
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M13 7L11.8845 4.76892C11.5634 4.1268 11.4029 3.80573 11.1634 3.57116C10.9516 3.36373 10.6963 3.20597 10.4161 3.10931C10.0992 3 9.74021 3 9.02229 3H5.2C4.0799 3 3.51984 3 3.09202 3.21799C2.71569 3.40973 2.40973 3.71569 2.21799 4.09202C2 4.51984 2 5.0799 2 6.2V7M2 7H17.2C18.8802 7 19.7202 7 20.362 7.32698C20.9265 7.6146 21.3854 8.07354 21.673 8.63803C22 9.27976 22 10.1198 22 11.8V16.2C22 17.8802 22 18.7202 21.673 19.362C21.3854 19.9265 20.9265 20.3854 20.362 20.673C19.7202 21 18.8802 21 17.2 21H6.8C5.11984 21 4.27976 21 3.63803 20.673C3.07354 20.3854 2.6146 19.9265 2.32698 19.362C2 18.7202 2 17.8802 2 16.2V7Z"
                          stroke="#4C6EF5" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>


            <div class="table__add-user" id="table__add-user">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 15.5H7.5C6.10444 15.5 5.40665 15.5 4.83886 15.6722C3.56045 16.06 2.56004 17.0605 2.17224 18.3389C2 18.9067 2 19.6044 2 21M19 21V15M16 18H22M14.5 7.5C14.5 9.98528 12.4853 12 10 12C7.51472 12 5.5 9.98528 5.5 7.5C5.5 5.01472 7.51472 3 10 3C12.4853 3 14.5 5.01472 14.5 7.5Z"
                          stroke="#4C6EF5" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>

            </div>
        </div>

    </div>

    <div class="table__subhead">
        <div class="table__search" style="display: flex;align-items: center">
            <svg class="glass" width="20" height="20" viewBox="0 0 20 20" fill="none"
                 xmlns="http://www.w3.org/2000/svg">
                <path d="M17.5 17.5L13.875 13.875M15.8333 9.16667C15.8333 12.8486 12.8486 15.8333 9.16667 15.8333C5.48477 15.8333 2.5 12.8486 2.5 9.16667C2.5 5.48477 5.48477 2.5 9.16667 2.5C12.8486 2.5 15.8333 5.48477 15.8333 9.16667Z"
                      stroke="#A0A5BA" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <input id="searchInput" type="text" placeholder="Поиск по организацие" autocomplete="false">
            <div class="table__filter" id="table__filter">
                <div class="filter__button" id="filter__button">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.5 6.66666L12.5 6.66666M12.5 6.66666C12.5 8.04737 13.6193 9.16666 15 9.16666C16.3807 9.16666 17.5 8.04737 17.5 6.66666C17.5 5.28594 16.3807 4.16666 15 4.16666C13.6193 4.16666 12.5 5.28595 12.5 6.66666ZM7.5 13.3333L17.5 13.3333M7.5 13.3333C7.5 14.714 6.38071 15.8333 5 15.8333C3.61929 15.8333 2.5 14.714 2.5 13.3333C2.5 11.9526 3.61929 10.8333 5 10.8333C6.38071 10.8333 7.5 11.9526 7.5 13.3333Z"
                              stroke="#4C6EF5" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>

                </div>
                <p>Фильтр</p>
            </div>
        </div>


        <button class="table__subhead-button">
            Экспорт в Excel
        </button>
    </div>

    <table class="table" id="table">
        <thead>
        <tr>
            <th>Номер заказа</th>
            <th>Организация</th>
            <th>Тип заказа</th>
            <th>Дата размещения</th>
            <th>Тип доставки</th>
            <th>Регион поставки</th>
            <th>Дата доставки</th>
            <th>Дата отгрузки</th>
            <th>Способ оплаты</th>
            <th>Статус</th>
            <th>Управление</th>
        </tr>
        </thead>
        <tbody id="tableBody">


        <?
        $IDs = Lists::getIDs();
        $factory = Lists::getSPElements($IDs["SP_order"]);
        //Получаем списки, которые имитируют 1С
        $arrOrganization = Lists::getEnum($IDs["list_organization"]);
        $arrStages = Lists::getStatusName($IDs["SP_order"]);
        $elements = $factory->getItems(array(
            "select" => array('TITLE',
                'UF_CRM_2_CONTRACT',
                'UF_CRM_2_ORGANISATION',
                'UF_CRM_2_CUSTOMERS',
                'UF_CRM_2_DEAL',
                'UF_CRM_2_CONTRACT',
                'UF_CRM_2_ORDER',
                'UF_CRM_2_PRODUCTS',
                'UF_CRM_2_DELIVERY',
                'UF_CRM_2_DATE_OF_DELIVERY',
                "UF_CRM_2_TYPE_OF_PAYMENT",
                'STAGE_ID',
                'UF_CRM_2_1690378150134',
                'CREATED_TIME',
                'UF_CRM_2_DATEOFSHIPMENT',
                'UF_CRM_2_KREDIT'
            )
        ));

        // Получаем элементы поля типа список
        $typesShipment = Lists::getUsersFieldsEnum("UF_CRM_2_DELIVERY");
        $orderTypes = Lists::getUsersFieldsEnum("UF_CRM_2_ORDER");
        $paymentTypes = Lists::getUsersFieldsEnum("UF_CRM_2_TYPE_OF_PAYMENT");
        $region = Lists::getUsersFieldsEnum("UF_CRM_2_1690378150134");
        ?>



        <?

        foreach ($elements as $el) {
            $data = $el->getData();
            // ID тип поставка - по кп или прайс
            $orderType = $data["UF_CRM_2_ORDER"];
            // ID товара
            $product = $data["UF_CRM_2_PRODUCTS"];
            // ID организации поставщика
            $organizationPrimary = $data["UF_CRM_2_ORGANISATION"];
            // ID типа поставки
            $typeShipment = $data["UF_CRM_2_DELIVERY"];
            // дата поставки
            $dateDELIVERY = $data["UF_CRM_2_DATE_OF_DELIVERY"];
            // дата отгрузки
            $dateOFSHIPMENT = $data["UF_CRM_2_DATEOFSHIPMENT"];
            // тип оплаты
            $paymentType = $data["UF_CRM_2_TYPE_OF_PAYMENT"];
            $stageId = $data["STAGE_ID"];
            $regionId = $data["UF_CRM_2_1690378150134"];
            $credit_limit = $data["UF_CRM_2_KREDIT"]
            ?>
            <tr data-elementId="<?= $data["ID"] ?>">
                <td><?= $data["TITLE"]; ?></td>
                <td><?= $arrOrganization[$organizationPrimary] ?></td>
                <td><?= $orderTypes[$orderType]; ?></td>
                <td><?= $data['CREATED_TIME']->format("d.m.y H:i") ?></td>
                <td><?= $typesShipment[$typeShipment]; ?></td>
                <td><?= $region[$regionId] ?></td>
                <td><?= $dateDELIVERY/*-> format("d.m.y")*/
                    ; ?></td>
                <td><?= $dateOFSHIPMENT/*-> format("d.m.y")*/
                    ; ?></td>
                <td data-limit="<?= $credit_limit ?>"><?= $paymentTypes[$paymentType]; ?></td>
                <td><?= $arrStages[$stageId] ?></td>
                <td>
                    <div style="display: flex; align-items: center;justify-content: center; gap: 10px;">
                        <div data-redactBtnId="<?= $data["ID"] ?>" class="redact_btn" id="redact_btn">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M15 8.33334L11.6667 5M2.08331 17.9167L4.90362 17.6033C5.24819 17.565 5.42048 17.5459 5.58152 17.4937C5.72439 17.4475 5.86035 17.3821 5.98572 17.2995C6.12702 17.2063 6.2496 17.0837 6.49475 16.8386L17.5 5.83334C18.4205 4.91286 18.4205 3.42048 17.5 2.5C16.5795 1.57953 15.0871 1.57953 14.1667 2.5L3.16142 13.5052C2.91627 13.7504 2.79369 13.873 2.70051 14.0143C2.61784 14.1396 2.55249 14.2756 2.50624 14.4185C2.45411 14.5795 2.43497 14.7518 2.39668 15.0964L2.08331 17.9167Z"
                                      stroke="#4C6EF5" stroke-width="1.3" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                            </svg>
                        </div>


                        <div data-delBtnId="<?= $data["ID"] ?>" class="del_btn">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M15 5L5 15M5 5L15 15" stroke="#4C6EF5" stroke-width="1.3"
                                      stroke-linecap="round"
                                      stroke-linejoin="round"/>
                            </svg>
                        </div>
                    </div>
                </td>
            </tr>
        <? } ?>
        <!-- Дополнительные строки -->
        </tbody>
    </table>

    <div id="test">

    </div>
</section>

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
        padding: 0 36px;
    }

    .table button {
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

    .filter__button {
        background: transparent;
        cursor: pointer;
    }

    .table__subhead-button, .create-btn {
        min-width: 170px;
    }

    .table {
        background-color: #fff;
        border-collapse: separate;
        border-spacing: 0;
        border-radius: 6px;
        margin-top: 35px;
        width: 100%;
    }

    #popupId {
        margin-top: 20px;
    }


    .table th {
        color: #393949;
        font-size: 14px;
        font-style: normal;
        font-weight: 400;
        line-height: 150%; /* 21px */
        border: 1px solid #000;
        padding: 20px 0;
        text-align: center;
    }


    tr:nth-child(even) {
        border-bottom: 1px solid black;
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
        border: 1px solid #E4EAF0;
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
    }

    .table__head-buttons svg, .table__add-user {
        width: 34px;
        height: 34px;
    }


    .table__head-order, .table__head-buttons, .table__filter {
        display: flex;
        align-items: center;
        gap: 50px;
    }

    .table__head-order {
        align-items: center;
    }


    .list-orders {
        color: #4C6EF5;
        font-size: 44px;
        font-style: normal;
        font-weight: 400;
        line-height: 150%; /* 21px */
        text-align: center;
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

    .order__organization p {
        color: #393949;
        font-size: 14px;
        font-style: normal;
        font-weight: 400;
        line-height: 150%; /* 21px */
    }

    .table__head-buttons svg {
        cursor: pointer;
    }

    td svg {
        cursor: pointer;
    }

    .workarea-content-paddings {
        padding: 0;
    }
</style>

<?php
CUtil::InitJSCore(array('ajax', 'popup'));
?>

<script>


</script>

<script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>

<!--credit-red-logic-->
<script>



    const tds = document.querySelectorAll('td[data-limit]');

    // Проходим по каждому элементу td
    for (let td of tds) {
        // Получаем значение атрибута data-limit
        let limit = td.getAttribute('data-limit');

        if (limit === "0") {
            td.style.backgroundColor = 'rgba(0, 128, 0, 0.5)';
            td.style.color = '#fff'
        } else if (limit === "1") {

            td.style.backgroundColor = 'rgba(255, 0, 0, 0.5)';
            td.style.color = '#fff'
        }
    }


</script>
<!--excel func-->

<script>
    document.querySelector('.table__subhead-button').addEventListener('click', function () {
        var table = document.getElementById('table');

        var wb = XLSX.utils.table_to_book(table, {sheet: "Sheet 1"});

        XLSX.writeFile(wb, 'output.xlsx');
    });
</script>

<script type="text/javascript">


    window.onload = function () {
        function showPopup(buttonId, url) {
            var popup;

            BX.bind(BX(buttonId), 'click', function () {
                const elId = this.dataset.redactbtnid;
                fetch(url)
                    .then(response => response.text())
                    .then(data => {
                        popup = BX.PopupWindowManager.create("popupId", null, {
                            autoHide: true,
                            lightShadow: true,
                            closeIcon: true,
                            closeByEsc: true,
                            events: {
                                onPopupClose: function () {
                                    this.destroy();
                                },
                                onPopupShow: function () {

                                    if (buttonId === 'redact_btn') {
                                        this.contentContainer.dataset.id = elId;
                                    }

                                },
                            },
                            content: data,
                        });



                        var event = new Event('popupCreated_' + buttonId);
                        document.dispatchEvent(event);
                        popup.show();
                    });
            });
        }

        showPopup('add-btn', '/modals/ajaxOrder.php');
        showPopup('redact_btn', '/modals/redactOrder.php');
        showPopup('filter__button', '/modals/filterCall.php');
        showPopup('table__add-user', '/modals/addUser.php');
        showPopup('add__email', '/modals/emailCall.php');
        showPopup('add-file', '/modals/news.php');

        const fadeOut = (el, timeout) => {
            el.style.opacity = 1;
            el.style.transition = `opacity ${timeout}ms`;
            el.style.opacity = 0;

            setTimeout(() => {
                el.style.display = 'none';
            }, timeout);
        };

        document.querySelectorAll('.del_btn').forEach(el => {
            el.addEventListener("click", (e) => {
                const elementId = e.currentTarget.dataset.delbtnid;
                if (confirm("Вы действительно хотите удалить элемент?")) {
                    const SpId = <?print($IDs["SP_order"]);?>;
                    const tr = document.querySelector(`tr[data-elementId="${elementId}"]`);
                    fadeOut(tr, 500);
                    BX.rest.callMethod('crm.item.delete', {entityTypeId: SpId, id: elementId})
                }
            })
        })
    };
</script>

<script>

    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('searchInput');
        const tableBody = document.getElementById('tableBody');
        let noResultsDiv = document.getElementById('no-results');

        if (!noResultsDiv) {
            noResultsDiv = document.createElement('div');
            noResultsDiv.id = 'no-results';
            noResultsDiv.textContent = 'Ничего не найдено';
            noResultsDiv.style.display = 'none';
            tableBody.parentNode.insertBefore(noResultsDiv, tableBody.nextSibling);
        }

        searchInput.addEventListener('keyup', function () {
            const value = this.value.toLowerCase();
            const rows = document.querySelectorAll('#tableBody tr');
            let found = false;

            rows.forEach(row => {
                const titleCell = row.children[0];  // Assuming the title cell is the 1st td in the row
                const orgCell = row.children[1];  // Assuming the organization cell is the 2nd td in the row
                const titleText = titleCell.textContent.toLowerCase();
                const orgText = orgCell.textContent.toLowerCase();

                if (orgText.indexOf(value) > -1 || titleText.indexOf(value) > -1) {
                    row.style.display = "";
                    found = true;
                } else {
                    row.style.display = "none";
                }
            });

            noResultsDiv.style.display = found ? 'none' : 'block';
        });
    });
</script>

<script>

    let arrOrganization = <?= json_encode($arrOrganization)?>;
    let arrStages = <?= json_encode($arrStages)?>;
    let typesShipment = <?= json_encode($typesShipment)?>;
    let orderTypes = <?= json_encode($orderTypes)?>;
    let paymentTypes = <?= json_encode($paymentTypes)?>;
    let regions = <?= json_encode($region)?>;
    const formatDateUS = (dateString) => {
        const date = new Date(dateString);
        const day = String(date.getDate()).padStart(2, '0');
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const year = date.getFullYear().toString().slice(2);
        return `${day}.${month}.${year}`;
    };
    // Создание ЭСП заказ


</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Chosen JS library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>

<script src="/modals/createOrder.js"></script>

<script src="/modals/selectSearch.js"></script>

<script src="/modals/search.js">

</script>
<script src="/modals/redactOrder.js"></script>
