<?php

namespace App\Controllers\Error;

use App\Controller;

class Sql extends Controller
{

    public function handle()
    {
        $this->view->error = 'Неправильный запрос!';
        $content = $this->view->redner(__DIR__ . '/../../Templates/Errors/sql.php');

        echo $content;
    }

}
