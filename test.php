<?php

use App\Exceptions\ErrorsException;
use App\Models\Article;

require __DIR__ . '/autoload.php';

//Код для проверки метода fill() !!!!
$test = new Article();
$data = [
    'title' => '',
    'contents' => '',
    'abracadabra' => 'abracadabra'
];
try {
    $test->fill($data);
} catch (ErrorsException $ex) {
    $allEx = $ex->all();
    foreach ($allEx as $itemEx) {
        var_dump($itemEx->getMessage());
    }
}
