<?
Bitrix\Main\Loader::registerAutoloadClasses(
// имя модуля
    "kvant.order",
    array(
        // ключ - имя класса с пространством имен, значение - путь относительно корня сайта к файлу
        "Kvant\\Main\\Main" => "lib/Main.php",
        "Kvant\\Lists\\Lists" => "lib/Lists.php",
    )
);