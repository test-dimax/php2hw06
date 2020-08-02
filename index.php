<?php

use App\Exceptions\ErrorsException;
use App\Exceptions\SqlException;
use App\Logger;

require __DIR__ . '/autoload.php';

try {
    $url = $_SERVER['REQUEST_URI'];
    //Делим запрос до $_GET параметров
    $ctrlUrl = explode("?", $url);
    if (count($ctrlUrl) > 1) {
        //Убираем $_GET параметры если они есть
        $getParams = array_pop($ctrlUrl);
    }
    //разбиваем url
    $arrCtrlUrl = explode("/", $ctrlUrl[0]);
    //собираем правильный url с заглавными буквами для составления класса
    $classParts = [];
    foreach ($arrCtrlUrl as $item) {
        if (!empty($item)) {
            $classParts[] = ucfirst($item);
        }
    }
    //склеиваем части в единый класс
    $classFinal = implode('\\', $classParts);

    $ctrlName = !empty($classFinal) ? $classFinal : 'Index';
    $ctrlClass = '\App\Controllers\\' . $ctrlName;
    $ctrl = new $ctrlClass;
    $ctrl->action();
} catch (SqlException $ex) {
    Logger::addToLog($ex);
    $ctrl = new \App\Controllers\Error\Sql();
    $ctrl->action();
} catch (\App\Exceptions\NotFoundException $ex) {
    Logger::addToLog($ex);
    $ctrl = new \App\Controllers\Error\NotFound();
    $ctrl->action();
}
