<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
\Bitrix\Main\Loader::IncludeModule("kvant.newOrder");
\Bitrix\Main\Loader::IncludeModule("kvant.order");
\Bitrix\Main\Loader::includeModule('iblock');

use \kvant\Lists\Lists;

$IDs = Lists::getIDs();
$arrOrganization = Lists::getList($IDs["list_organization"]);
$arrKontrOrganization = Lists::getList($IDs["list_kontrOrganization"]);
$typesShipment = Lists::getUsersFieldsEnum("UF_CRM_2_DELIVERY");
$typesPayment = Lists::getUsersFieldsEnum("UF_CRM_2_TYPE_OF_PAYMENT");
$typesOrder = Lists::getUsersFieldsEnum("UF_CRM_2_ORDER");
$regions = Lists::getUsersFieldsEnum("UF_CRM_2_1690378150134");
$iterator = CIBlockElement::GetPropertyValues($IDs["list_organization"], array('ACTIVE' => 'Y'), true, array());
$KontIterator = CIBlockElement::GetPropertyValues($IDs["list_kontrOrganization"], array('ACTIVE' => 'Y'), true, array());
$arrOrgINN = array();
while ($row = $iterator->Fetch()) {
    $arrOrgINN[$row["IBLOCK_ELEMENT_ID"]] = $row[67];
}
$arrKontrOrgINN = array();
while ($row = $KontIterator->Fetch()) {
    $arrKontrOrgINN[$row["IBLOCK_ELEMENT_ID"]] = $row[64];
}
?>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">


<link rel="stylesheet" href="/modals/style.css">
<section class="add__user content">
    <div class="modal">
        <h2>Новый заказ</h2>

        <form class='add__form'>
            <!--Организация поставщик-->
            <div class="custom-select" style="width:100%;">
                <div style="position: relative; display: inline-block; width: 100%;">
                    <input style="width: 100%; padding-right: 20px;" type="text" id="org" placeholder="Организация поставщик" autocomplete="off">
                    <input id="hidden-input" data-orgid="" type="hidden">
                    <svg style="position: absolute; right: 8px; top: 50%; transform: translateY(-50%); width: 12px; height: 12px; fill: #000;" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 407.437 407.437">
                        <polygon points="386.258,91.567 203.718,273.512 21.179,91.567 0,112.815 203.718,315.87 407.437,112.815 "/>
                    </svg>
                </div>
                <div id="mySelect" class="select-items select-hide">
                    <?php foreach ($arrOrganization -> arResult as $el): ?>
                        <div data-ID="<?= $el["ID"] ?>" data-orgINN="<?= $arrOrgINN[$el["ID"]] ?>"><?= $el["NAME"] ?></div>
                    <?php endforeach; ?>
                </div>
            </div>
            <!--Контрагент-покупатель-->
            <div class="custom-select" style="width:100%;">
                <div style="position: relative; display: inline-block; width: 100%;">
                    <input style="width: 100%; padding-right: 20px;" type="text" id="kontOrg" placeholder="Контрагент-покупатель" autocomplete="off">
                    <svg style="position: absolute; right: 8px; top: 50%; transform: translateY(-50%); width: 12px; height: 12px; fill: #000;" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 407.437 407.437">
                        <polygon points="386.258,91.567 203.718,273.512 21.179,91.567 0,112.815 203.718,315.87 407.437,112.815 "/>
                    </svg>
                </div>
                <div id="kontrOrganization" class="select-items select-hide">
                    <?php foreach ($arrKontrOrganization -> arResult as $el):?>
                        <div data-ID="<?= $el["ID"] ?>" data-orgINN="<?= $arrKontrOrgINN[$el["ID"]] ?>"><?= $el["NAME"] ?></div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!--Контрагент-получатель-->
            <div class="custom-select" style="width:100%;">
                <div style="position: relative; display: inline-block; width: 100%;">
                    <input style="width: 100%; padding-right: 20px;" type="text" id="kontOrg2" placeholder="Контрагент-получатель" autocomplete="off">
                    <svg style="position: absolute; right: 8px; top: 50%; transform: translateY(-50%); width: 12px; height: 12px; fill: #000;" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 407.437 407.437">
                        <polygon points="386.258,91.567 203.718,273.512 21.179,91.567 0,112.815 203.718,315.87 407.437,112.815 "/>
                    </svg>
                </div>
                <div id="kontrOrganization2" class="select-items select-hide">
                    <?php foreach ($arrKontrOrganization -> arResult as $el):?>
                        <div data-ID="<?= $el["ID"] ?>" data-orgINN="<?= $arrKontrOrgINN[$el["ID"]] ?>"><?= $el["NAME"] ?></div>
                    <?php endforeach; ?>
                </div>
            </div>



            <div class="custom-select" style="width:100%;">
                <div style="position: relative; display: inline-block; width: 100%;">
                    <input style="width: 100%; padding-right: 20px;" type="text" id="kontOrg21" placeholder="Сделка" autocomplete="off">
                    <svg style="position: absolute; right: 8px; top: 50%; transform: translateY(-50%); width: 12px; height: 12px; fill: #000;" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 407.437 407.437">
                        <polygon points="386.258,91.567 203.718,273.512 21.179,91.567 0,112.815 203.718,315.87 407.437,112.815 "/>
                    </svg>
                </div>
                <div id="kontrOrganization22" class="select-items select-hide">
                    <div >№415</div>
                    <div >№816</div>
                    <div >№420</div>

                </div>
            </div>


            <div class="custom-select" style="width:100%;">
                <div style="position: relative; display: inline-block; width: 100%;">
                    <input style="width: 100%; padding-right: 20px;" type="text" id="kontOrg2222" placeholder="Договор" autocomplete="off">
                    <svg style="position: absolute; right: 8px; top: 50%; transform: translateY(-50%); width: 12px; height: 12px; fill: #000;" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 407.437 407.437">
                        <polygon points="386.258,91.567 203.718,273.512 21.179,91.567 0,112.815 203.718,315.87 407.437,112.815 "/>
                    </svg>
                </div>
                <div id="kontrOrganization222" class="select-items select-hide">
                    <div >№15/2023</div>
                    <div >№46/2020</div>
                    <div >№46/2019</div>
                </div>
            </div>


            <!--Тип заказа-->
            <div class="custom-select" style="width:100%;">
                <div style="position: relative; display: inline-block; width: 100%;">
                    <input style="width: 100%; padding-right: 20px;" type="text" id="ord" placeholder="Тип заказа" autocomplete="off">
                    <svg style="position: absolute; right: 8px; top: 50%; transform: translateY(-50%); width: 12px; height: 12px; fill: #000;" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 407.437 407.437">
                        <polygon points="386.258,91.567 203.718,273.512 21.179,91.567 0,112.815 203.718,315.87 407.437,112.815 "/>
                    </svg>
                </div>
                <div id="orderType" class="select-items select-hide">
                    <?php foreach ($typesOrder  as $el):?>
                        <div data-ID="<?=array_search($el, $typesOrder)?>"><?= $el?></div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div id="productSelect" class="custom-select">
                <p class="search-products">Поиск по товарам</p>
                <select  class="chosen-select" multiple id="products">
                </select>
            </div>

            <!--Тип поставки-->
            <div class="custom-select" style="width:100%;">
                <div style="position: relative; display: inline-block; width: 100%;">
                    <input style="width: 100%; padding-right: 20px;" type="text" id="ship" placeholder="Тип поставки" autocomplete="off">
                    <svg style="position: absolute; right: 8px; top: 50%; transform: translateY(-50%); width: 12px; height: 12px; fill: #000;" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 407.437 407.437">
                        <polygon points="386.258,91.567 203.718,273.512 21.179,91.567 0,112.815 203.718,315.87 407.437,112.815 "/>
                    </svg>
                </div>
                <div id="shipment" class="select-items select-hide">
                    <? foreach ($typesShipment as $el ) {
                        ?>
                        <div data-ID="<?= array_search($el, $typesShipment) ?>"><?=$el?></div>
                    <? } ?>
                </div>
            </div>

            <!--Способ оплаты-->
            <div class="custom-select" style="width:100%;">
                <div style="position: relative; display: inline-block; width: 100%;">
                    <input style="width: 100%; padding-right: 20px;" type="text" id="pay" placeholder="Способ оплаты" autocomplete="off">
                    <svg style="position: absolute; right: 8px; top: 50%; transform: translateY(-50%); width: 12px; height: 12px; fill: #000;" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 407.437 407.437">
                        <polygon points="386.258,91.567 203.718,273.512 21.179,91.567 0,112.815 203.718,315.87 407.437,112.815 "/>
                    </svg>
                </div>
                <div id="payment" class="select-items select-hide">
                    <?php foreach ($typesPayment  as $el):?>
                        <div data-ID="<?= array_search($el, $typesPayment)?>"><?= $el?></div>
                    <?php endforeach; ?>
                </div>
            </div>

            <input id="dateShip" type="text" placeholder="Дата отгрузки" onclick="BX.calendar({node: this, field: this, bTime: false, bSetFocus: false})">
            <input id="dateDelivery" type="text" placeholder="Дата доставки" onclick="BX.calendar({node: this, field: this, bTime: false, bSetFocus: false})">

            <!--Регион поставки-->
            <div class="custom-select" style="width:100%;">
                <div style="position: relative; display: inline-block; width: 100%;">
                    <input style="width: 100%; padding-right: 20px;" type="text" id="reg" placeholder="Регион поставки" autocomplete="off">
                    <svg style="position: absolute; right: 8px; top: 50%; transform: translateY(-50%); width: 12px; height: 12px; fill: #000;" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 407.437 407.437">
                        <polygon points="386.258,91.567 203.718,273.512 21.179,91.567 0,112.815 203.718,315.87 407.437,112.815 "/>
                    </svg>
                </div>
                <div id="region" class="select-items select-hide">
                    <?php foreach ($regions  as $el):?>
                        <div data-ID="<?= array_search($el, $regions)?>"><?= $el?></div>
                    <?php endforeach; ?>
                </div>
            </div>
<!--            <select>
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
-->

            <textarea id="comment" placeholder="Прочие комментарии">
</textarea>
            <p class="total"></p>

           <!-- <div class="form__add-files">
                <p class="comment-text">Приложить файлы</p>
                <div class="add__files-wrapper">

                    <select id="fileType" style="width: 250px; height: 49px">
                        <option value="" disabled selected>Вид файла</option>
                        <option value="Роль">Рекламация</option>
                        <option value="Option 1">Рекламация</option>
                        <option value="Option 2">Option 2</option>
                        <option value="Option 3">Option 3</option>
                    </select>


                    <label for="file-upload"
                           style="cursor: pointer; position: relative; display: inline-block; outline: none">
                        <svg style="position: absolute; top: 50%; left: 5px; transform: translateY(-50%);" width="20"
                             height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17.6271 9.0829L10.1141 16.5959C8.40553 18.3045 5.63544 18.3045 3.92689 16.5959C2.21835 14.8874 2.21835 12.1173 3.92689 10.4087L11.4399 2.89571C12.5789 1.75669 14.4257 1.75669 15.5647 2.89571C16.7037 4.03474 16.7037 5.88147 15.5647 7.0205L8.34631 14.2389C7.7768 14.8084 6.85343 14.8084 6.28392 14.2389C5.7144 13.6694 5.7144 12.746 6.28392 12.1765L12.6184 5.84199"
                                  stroke="#4C6EF5" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <input type="text" placeholder="Приложите файл" style="padding-left: 30px;height: 49px; "/>
                        <input id="file-upload" type="file" style="display: none;"/>
                    </label>
                </div>
            </div>

            <div class="more__files" style="position: relative; width: 100%;border-radius: 5px">
                <input type="file" id="file-add"
                       style="opacity: 0; position: absolute; width: 100%; height: 100%; cursor: pointer;">
                <div style="display: flex; align-items: center; justify-content: space-between; border: 1px solid #ccc; padding: 2px 8px;">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"
                         style="margin-right: 10px;">
                        <path d="M10 4.16663V15.8333M4.16669 9.99996H15.8334" stroke="#8E92A2" stroke-width="1.3"
                              stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <input type="text" placeholder="Добавить еще файл" style="border: none; flex-grow: 1;">
                </div>
            </div>-->

            <div class="access-buttons">
            <button id="createOrder" class="add-btn" type="button">Добавить пользователя</button>
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

   .modal button {
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

    .add__user {
        background-color: #fff;
        border-radius: 12px;
        margin-top: 30px;
        max-width: 650px;
        display: flex;
        flex-direction: column;
        gap: 20px;
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

    .custom-select {
        position: relative;
        display: inline-block;
    }

    .select-items div, .select-selected {
        color: #3c3c3c;
        padding: 14px;
        border: 1px solid #C0C9D2;
        font-size: 17px;
        cursor: pointer;
    }

    .select-hide {
        display: none;
    }

    .select-items {
        position: absolute;
        background-color: White;
        top: 100%;
        left: 0;
        right: 0;
        z-index: 99;
    }

    input, select {
        width: 100%;
    }
    
    #productSelect_chosen > ul > li > input, .search-products {
        color: #8E92A2;
        font-size: 16px;
        font-style: normal;
        font-weight: 400;
        line-height: 150%;
    }

    .chosen-container-multi .chosen-choices {
        height: 110px;
        border-radius: 5px;
        overflow-y: auto;
    }

    .total {
        text-align: center;
        color: red;
        font-size: 22px;
    }

    .chosen-container-multi .chosen-choices li.search-choice {
        border-bottom: 1px solid #8E92A2;
        width: 100%;
        font-size: 12px;
    }

</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>

<script src="/modals/search.js"></script>
<script src="/modals/selectSearch.js"></script>
