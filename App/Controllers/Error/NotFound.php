<?php

namespace App\Controllers\Error;

use App\Controller;

class NotFound extends Controller
{

    public function handle()
    {
        $this->view->error = 'Запрашиваемая запись не найдена!';
        $content = $this->view->redner(__DIR__ . '/../../Templates/Errors/notFound.php');

        echo $content;
    }

}
