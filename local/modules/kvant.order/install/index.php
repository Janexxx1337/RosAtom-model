<?
// пространство имен для подключений ланговых файлов
use Bitrix\Main\Copy\Container;
use Bitrix\Main\Localization\Loc;

// пространство имен для управления (регистрации/удалении) модуля в системе/базе
use Bitrix\Main\ModuleManager;
use Bitrix\Main\Loader;

// пространство имен для работы с параметрами модулей хранимых в базе данных
use Bitrix\Main\Config\Option;

// пространство имен с абстрактным классом для любых приложений, любой конкретный класс приложения является наследником этого абстрактного класса
use Bitrix\Main\Application;

// пространство имен для работы с директориями
use Bitrix\Main\IO\Directory;
use Bitrix\Crm\Service;
use   Bitrix\Crm\UserField;
use Bitrix\Main\Result;
use  Bitrix\Crm\Model\Dynamic\Type;
use Bitrix\Crm\Model\Dynamic\TypeTable;
use Bitrix\Crm\Automation\Engine\Template;
use Bitrix\Crm\Automation\Engine\TemplateTable;
use Bitrix\Main\UserFieldTable;
CModule::IncludeModule("iblock");
// подключение ланговых файлов
Loc::loadMessages(__FILE__);
Loader::includeModule("crm");
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

class kvant_order extends CModule
{
    // переменные модуля
    public $MODULE_ID;
    public $MODULE_VERSION;
    public $MODULE_VERSION_DATE;
    public $MODULE_NAME;
    public $COMPONENT_NAME;
    public $MODULE_DESCRIPTION;
    public $PARTNER_NAME;
    public $PARTNER_URI;
    public $errors;
    public $container;
    public $typeDataClass;
    public $type;
    public $result;
    public $list_id;

    // конструктор класса, вызывается автоматически при обращении к классу
    function __construct(/*$title, $symbol, $userFieldsAgree*/)
    {

        // создаем пустой массив для файла version.php
        $arModuleVersion = array();
        // подключаем файл version.php
        include_once(__DIR__ . '/version.php');
        // версия модуля
        $this->MODULE_VERSION = $arModuleVersion['VERSION'];
        // дата релиза версии модуля
        $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
        // id модуля
        $this->MODULE_ID = "kvant.order";
        // название модуля
        $this->MODULE_NAME = "Список заказов";
        $this->COMPONENT_NAME = "kvant";
        // описание модуля
        $this->MODULE_DESCRIPTION = "Модуль для просмoтра и создания заказов";
        // имя партнера выпустившего модуль
        $this->PARTNER_NAME = "КВАНТ";
        // ссылка на ресурс партнера выпустившего модуль
        $this->PARTNER_URI = "https://www.kvant-is.ru/";

    }

    function DoInstall()
    {
        // глобальная переменная с абстрактным классом
        global $APPLICATION;
        // создаем таблицы баз данных, необходимые для работы модуля
        $this->InstallDB();
        // регистрируем обработчики событий
        $this->InstallEvents();
        // копируем файлы, необходимые для работы модуля
        $this->InstallFiles();
        // регистрируем модуль в системе
        ModuleManager::RegisterModule("kvant.order");

        // Создание нового инфоблока
        $iblockOrg = new CIBlock;
        $arFieldsOrg = array(
            "ACTIVE" => 'Y',
            "NAME" => 'Орг-пост',
            "IBLOCK_TYPE_ID" => 'lists',
            "SITE_ID" => array("s1"),
            "SORT" => 500,
            "GROUP_ID" => array("2" => "W"), // Права доступа
            "API_CODE" => "ORGANISATION2",
            "REST_ON" => "Y",
            "WF_TYPE" => "N"
        );

        // Проверка на ошибки
        $this->listOrg_id = $iblockOrg->Add($arFieldsOrg);

        if (!$this->listOrg_id) {
            echo 'Ошибка: ' . $iblockOrg->LAST_ERROR . '<br>';
        } else {
            Option::set($this->MODULE_ID, "list_organization", $this->listOrg_id);
            $IDs = Option::getForModule($this->MODULE_ID);
            echo 'Список организаций-поставщиков успешно создан с ID: ' . (int)$IDs["list_organization"];


            global $DB;
            global $USER_FIELD_MANAGER;

            $DB->Add("b_lists_field", array(
                "ID" => 1,
                "IBLOCK_ID" => $IDs["list_organization"],
                "SORT" => 50,
                "NAME" => "test",
                "FIELD_ID" => "TEST",
                "SETTINGS" => serialize(array(
                    'SHOW_ADD_FORM' => 'Y',
                    'SHOW_EDIT_FORM' => 'Y',
                    'ADD_READ_ONLY_FIELD' => 'N',
                    'EDIT_READ_ONLY_FIELD' => 'N',
                    'SHOW_FIELD_PREVIEW' => 'N',
                ))
            ));
            $arrINN = array(
                "ACTIVE" => "Y",
                "NAME" => 'ИНН',
                "CODE" => "INN",
                "IS_REQUIRED" => "Y",
                "PROPERTY_TYPE" => "N",
                "DEFAULT_VALUE" => "",
                "VISIBLE" => "Y"
            );


            $tewst = $iblockOrg->GetByID((int)$IDs["list_organization"]);
            if($ar_res = $tewst->GetNext()) {
                echo "<pre>";
                print_r($ar_res);
                echo "</pre>";
            }




            /* $obList = new CList($IDs["list_organization"]);
             $obList->AddField($arrINN);*/


            /*


                         $arrOPF = Array(
                             "ACTIVE" => "Y",
                             "NAME" => 'ОПФ',
                             "CODE "=> "OPF",
                             "IS_REQUIRED"=> "Y",
                             "PROPERTY_TYPE"=>"L",
                             "IBLOCK_ID" => (int)$IDs["list_organization"],
                             "SORT"=> 500,
                             "MULTIPLE"=> "N",
                             "LIST_TYPE" => "L",

                         );
                         $arrOPF["VALUES"][0] = Array(
                             "VALUE" => "ООО",
                             "DEF" => "N",
                             "SORT" => "100",
                             "PROPERTY_ID"=> "OOO"
                         );
                         $arrOPF["VALUES"][1] = Array(
                             "VALUE" => "ИП",
                             "DEF" => "N",
                             "SORT" => "200",
                             "PROPERTY_ID"=> "OPF"
                         );
                         $arrOPF["VALUES"][2] = Array(
                             "VALUE" => "ЗАО",
                             "DEF" => "Y",
                             "SORT" => "300",
                             "PROPERTY_ID"=> "ZAO"
                         );

                         $ibp = new CIBlockProperty;
                         $PropID = $ibp->Add($arrOPF);*/
        }


        // подключаем скрипт с административным прологом и эпилогом
        $APPLICATION->includeAdminFile(
            Loc::getMessage('INSTALL_TITLE'),
            __DIR__ . '/instalInfo.php'
        );


        // для успешного завершения, метод должен вернуть true
        return true;
    }


    // метод отрабатывает при удалении модуля
    function DoUninstall()
    {
        // глобальная переменная с абстрактным классом
        global $APPLICATION;
        // удаляем таблицы баз данных, необходимые для работы модуля
        $this->UnInstallDB();
        // удаляем обработчики событий
        $this->UnInstallEvents();
        // удаляем файлы, необходимые для работы модуля
        $this->UnInstallFiles();
        // удаляем регистрацию модуля в системе
        $IDs = Option::getForModule("kvant.order");
        CIBlock::Delete((int)$IDs["list_organization"]);
        ModuleManager::UnRegisterModule("kvant.order");
        // подключаем скрипт с административным прологом и эпилогом
        $APPLICATION->includeAdminFile(
            Loc::getMessage('DEINSTALL_TITLE'),
            __DIR__ . '/deInstalInfo.php'
        );


        // для успешного завершения, метод должен вернуть true
        return true;
    }
    // метод для создания таблицы баз данных
//    function InstallDB()
//    {
//        // глобальный объект $DB для работы с базой данных
//        global $DB;
//        // изначально устанавливаем переменной errors булево значение false
//        $this->errors = false;
//        // метод выполняет пакет запросов из файла install.sql и возвращает false в случае успеха или массив ошибок
//        $this->errors = $DB->RunSQLBatch($_SERVER['DOCUMENT_ROOT'] . "/local/modules/kvant.order/install/db/install.sql");
//        // проверяем ответ, если ответ вернул false, значит таблица успешно создана
//        if (!$this->errors) {
//            // для успешного завершения, метод должен вернуть true
//            return true;
//        } else
//            return $this->errors;
//    }
//    // метод для удаления таблицы баз данных
//    function UnInstallDB()
//    {
//        // глобальный объект $DB для работы с базой данных
//        global $DB;
//        // изначально устанавливаем переменной errors булево значение false
//        $this->errors = false;
//        // метод выполняет пакет запросов из файла uninstall.sql и возвращает false в случае успеха или массив ошибок
//        $this->errors = $DB->RunSQLBatch($_SERVER['DOCUMENT_ROOT'] . "/local/modules/hmarketing.d7/install/db/uninstall.sql");
//        // проверяем ответ, если ответ вернул false, значит таблица успешно удалена
//        if (!$this->errors) {
//            // для успешного завершения, метод должен вернуть true
//            return true;
//        } else
//            return $this->errors;
//    }
    // метод для создания обработчика событий
    function InstallEvents()
    {
        // регистрируем обработчик события, когда в модуле kvant.order возникнет событие OnSomeEvent, будет подключен модуль kvant.order, вызван класс Kvant\Main::Main и метод get
        RegisterModuleDependences("kvant.order", "OnSomeEvent", "kvant.order", "\\Kvant\\Main\\Main", "get");
        // для успешного завершения, метод должен вернуть true
        return true;
    }

    // метод для удаления обработчика событий
    function UnInstallEvents()
    {
        // удаляем зарегистрированный обработчик события при удалении модуля
        UnRegisterModuleDependences("kvant.order", "OnSomeEvent", "kvant.order", "\\Kvant\\Main\\Main", "get");
        // для успешного завершения, метод должен вернуть true
        return true;
    }

    // метод для копирования файлов модуля при установке
    function InstallFiles()
    {
        CopyDirFiles(
            __DIR__ . '/copy_files/kvant',
            Application::getDocumentRoot() . '/local/components/' . $this->COMPONENT_NAME . '/',
            true,
            true,
            false,
            "claim order"

        );
        // копируем файлы, которые устанавливаем вместе с модулем, копируем в пространство имен для компонентов которое будет иметь имя модуля hmarketing.7d
        CopyDirFiles(
            __DIR__ . '/copy_files',
            Application::getDocumentRoot() . '/' . $this->MODULE_ID . '/',
            true,
            true,
            false,
            "kvant"
        );
        CopyDirFiles(
            __DIR__ . '/copy_files/modals',
            Application::getDocumentRoot() . '/modals/',
            true,
            true,
            false

        );
        // для успешного завершения, метод должен вернуть true
        return true;
    }

    // метод для удаления файлов модуля при удалении
    function UnInstallFiles()
    {
        // удаляем директорию по указанному пути до папки
        Directory::deleteDirectory(
            Application::getDocumentRoot() . '/' . $this->MODULE_ID
        );
        Directory::deleteDirectory(
            Application::getDocumentRoot() . '/local/components/' . $this->COMPONENT_NAME
        );
        Directory::deleteDirectory(
            Application::getDocumentRoot() . '/modals/'
        );
        // для успешного завершения, метод должен вернуть true
        return true;

    }
}

