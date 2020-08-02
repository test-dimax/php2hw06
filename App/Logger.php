<?php


namespace App;


class Logger
{

    /**
     * @param \Throwable $ex - Исключение
     * Метод добавляющий в файл с логом информацию об ошибках
     */
    public static function addToLog(\Throwable $ex)
    {

        $content = [];
        $content[] = PHP_EOL . $ex->getMessage();
        $content[] = 'Дата: ' . date("d.m.y");
        $content[] = 'Файл: ' . $ex->getFile();
        $content[] = 'Строка: ' . $ex->getLine();

        $finalContent = implode("\n", $content);
        $homepage = file_get_contents('log.txt');
        file_put_contents('log.txt', $finalContent, FILE_APPEND);

    }

}
