<?
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Loader;
use Bitrix\Crm\WebForm\Script;
use Bitrix\Crm\WebForm\Internals\FormTable;

if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)
    die();

Loc::loadMessages(__FILE__);

class CCrmButtonWebFormWidgetComponent extends \CBitrixComponent
{
    public function getPopupContentAction()
    {
        ob_start();

        global $APPLICATION;
        $APPLICATION->IncludeComponent(
            'kvant:forms',
            '.claim',
            array(
                'COMPONENT_TEMPLATE' => '.default',
                'SEF_FOLDER' => SITE_DIR . 'kvant.forms/',
                'SEF_MODE' => 'Y',
                'TYPE' => 'PAGE',
            ),
            false
        );

        $content = ob_get_clean();

        return [
            'data' => $content
        ];
    }

}
