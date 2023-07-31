<?
// пространство имен для подключений ланговых файлов
use Bitrix\Main\Localization\Loc;
// пространство имен для получения ID модуля
use Bitrix\Main\HttpApplication;
// пространство имен для загрузки необходимых файлов, классов, модулей
use Bitrix\Main\Loader;
// пространство имен для работы с параметрами модулей хранимых в базе данных
use Bitrix\Main\Config\Option;
// подключение ланговых файлов
Loc::loadMessages(__FILE__);
// получаем id модуля
$request = HttpApplication::getInstance()->getContext()->getRequest();
$module_id = htmlspecialcharsbx($request["mid"] != "" ? $request["mid"] : $request["id"]);
// подключение модуля
Loader::includeModule($module_id);
// настройки модуля для админки, в том числе значения по умолчанию
$aTabs = array(
    array(
        // значение будет вставлено во все элементы вкладки для идентификации
        "DIV" => "edit",
        // название вкладки в табах
        "TAB" => "Название вкладки в табах",
        // название вкладки в админке
        "TITLE" => "Главное название в админке",
        // массив с опциями секции
        "OPTIONS" => array(
            "ID Смарт-процесса с заказами",
            array(
                // имя элемента формы
                "SP_order",
                // поясняющий текст
                "ID",
                // значение text по умолчанию "50"
                "157",
                // тип элемента формы "text"
                array("text", 5)
            ),
            "ID Смарт-процесса с претензиями",
            array(
                // имя элемента формы
                "SP_claim",
                // поясняющий текст
                "ID",
                // значение text по умолчанию "50"
                "139",
                // тип элемента формы "text"
                array("text", 5)
            ),
            "ID списка организаций-поставщиков",
            array(
                // имя элемента формы
                "list_organization",
                // поясняющий текст
                "ID",
                // значение text по умолчанию "50"
                "17",
                // тип элемента формы "text"
                array("text", 5)
            ),
            "ID списка контрагентов-покупателей",
            array(
                // имя элемента формы
                "list_kontrOrganization",
                // поясняющий текст
                "ID",
                // значение text по умолчанию "50"
                "16",
                // тип элемента формы "text"
                array("text", 5)
            ),
        )
    )
);
// проверяем текущий POST запрос и сохраняем выбранные пользователем настройки
if ($request->isPost() && check_bitrix_sessid()) {
    // цикл по заполненым пользователем вкладкам
    foreach ($aTabs as $aTab) {
        foreach ($aTab["OPTIONS"] as $arOption) {
            // если это название секции, переходим к следующий итерации цикла
            if (!is_array($arOption)) {
                continue;
            }
            // Проверяем POST запрос, если инициатором выступила кнопка с name="apply" сохраняем введенные настройки в базу данных
            if ($request["apply"]) {
                // получаем в переменную $optionValue введенные пользователем данные
                $optionValue = $request->getPost($arOption[0]);
                // метод getPost() не работает с input типа checkbox, для работы сделал этот костыль
                if ($arOption[0] == "kvant_checkbox") {
                    if ($optionValue == "") {
                        $optionValue = "N";
                    }
                }
                // устанавливаем выбранные значения параметров и сохраняем в базу данных, перед сохранением проверяем если массив то соединяем данные, если не массив сохраняем как есть
                Option::set($module_id, $arOption[0], is_array($optionValue) ? implode(",", $optionValue) : $optionValue);
            }
            // Проверяем POST запрос, если инициатором выступила кнопка с name="default" сохраняем дефолтные настройки в базу данных
            if ($request["default"]) {
                // устанавливаем дефолтные значения параметров и сохраняем в базу данных
                Option::set($module_id, $arOption[0], $arOption[2]);
            }
        }
    }
    // редирект на прежнию страницу
    LocalRedirect($APPLICATION->GetCurPage() . "?mid=" . $module_id . "&lang=" . LANG);
}
// отрисовываем форму, для этого создаем новый экземпляр класса CAdminTabControl, куда и передаём массив с настройками
$tabControl = new CAdminTabControl(
    "tabControl",
    $aTabs
);
// отображаем заголовки закладок
$tabControl->Begin();
?>
    <form action="<? echo ($APPLICATION->GetCurPage()); ?>?mid=<? echo ($module_id); ?>&lang=<? echo (LANG); ?>" method="post">
        <? foreach ($aTabs as $aTab) {
            if ($aTab["OPTIONS"]) {
                // завершает предыдущую закладку, если она есть, начинает следующую
                $tabControl->BeginNextTab();
                // отрисовываем форму из массива
                __AdmSettingsDrawList($module_id, $aTab["OPTIONS"]);
            }
        }
        // выводит стандартные кнопки отправки формы
        $tabControl->Buttons();
        // выводим скрытый input с идентификатором сессии
        echo (bitrix_sessid_post()); ?>
        <input class="adm-btn-save" type="submit" name="apply" value="Применить" />
        <input type="submit" name="default" value="По умолчанию" />
    </form>
<?
// обозначаем конец отрисовки формы
$tabControl->End();