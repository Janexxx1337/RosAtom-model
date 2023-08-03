<?


// пространство имен для класса
namespace Kvant\Lists;
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use Bitrix\Crm\Service;
use Bitrix\Crm\Service\Container;
use Bitrix\Crm\Service\Factory;
use Bitrix\Main\Loader;
use \Bitrix\Main\Config\Option;
Loader::includeModule('crm');
Loader::includeModule('iblock');
class Lists
{
    private function __construct()
    {

    }
    // метод для получения строки из таблицы базы данных
    public static function getSPElements($id) {
        $factory = Container::getInstance()->getFactory($id);
        return $factory;
    }
    public static function getList($id) {
        return GetIBlockElementList($id, false, Array(), 100);
    }
    /*Не видит класс CUser*/
    public static function getUserName($id) {
        $rsUser = \CUser::GetByID($id);
        $arUser = $rsUser->Fetch();
        return $arUser["NAME"] . " " . $arUser["LAST_NAME"];
    }

    public static function getEnum($id) {
        $arr = array();
        $listOrganization = self::getList($id);
        foreach ($listOrganization -> arResult as $org) {
            $arr[$org["ID"]] = $org["NAME"];
        }
        return $arr;
    }
    public static function getUsersFieldsEnum($field) {
        $arr = array();
        $res = \CUserFieldEnum::GetList(array(), array(
            "USER_FIELD_NAME" => $field,
        ));

        while($row = $res->Fetch()) {
            $arr[$row["ID"]] = $row["VALUE"];
        }
        return $arr;
    }
    // Получаем стадии сущности из фабрики формируем массив
    public static function getStatusName($id) {
        $factory = self::getSPElements($id);
        $arrStages = array();
        if ($factory && $factory->isStagesSupported()){
            $stages = $factory->getStages()->getAll();
            foreach( $stages as $stage){
                $arrStages[$stage->getStatusId()] = $factory -> getStage($stage->getStatusId()) -> getName();
            }}
        return $arrStages;
    }

    public static function getIDs () {
       return  Option::getForModule("kvant.order");

    }


}



