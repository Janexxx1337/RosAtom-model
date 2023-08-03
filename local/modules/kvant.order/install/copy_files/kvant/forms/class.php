<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();
class MyComponent extends CBitrixComponent
{
    // Метод, выполняющий общую логику компонента
    public function executeComponent()
    {
        // Используем Bitrix API для обработки AJAX-запросов
        if ($this->request->isAjaxRequest()) {
            // Получаем имя действия из запроса
            $action = $this->request->get('action');

            // Если метод для этого действия существует, вызываем его
            if (method_exists($this, $action.'Action')) {
                $response = $this->{$action.'Action'}();

                // Возвращаем ответ в формате JSON
                $GLOBALS['APPLICATION']->RestartBuffer();
                echo Json::encode($response);
                die();
            }
        }

        // Обычная логика компонента здесь...
    }

    // Ваш метод для AJAX-действия
    public function getPopupContentAction()
    {
        // Ваша логика для генерации содержимого всплывающего окна
        ob_start(); // Начинаем буферизацию вывода

        $this->getApplication()->IncludeComponent(
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

        $content = ob_get_clean(); // Получаем все, что было выведено с момента вызова ob_start(), и очищаем буфер

        return [
            'data' => $content
        ];
    }

}
