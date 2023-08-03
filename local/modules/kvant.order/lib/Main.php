<?
// пространство имен для класса
namespace Kvant\Main;

class Main
{
    // метод для получения строки из таблицы базы данных hmarketing_test
    public static function get()
    {
        $row = "work";
        // распечатываем массив с ответом на экран
        print "<pre>";
        print_r($row);
        print "</pre>";
        // возвращаем ответ от баззы
        return $row;
    }
}