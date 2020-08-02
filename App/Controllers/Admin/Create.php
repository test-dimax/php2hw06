<?php

namespace App\Controllers\Admin;

use App\Controller;
use App\Models\Article;

class Create extends Controller
{

    public function handle()
    {
        $content = $this->view->redner(__DIR__ . '/../../Templates/Admin/create.php');

        echo $content;
    }

}
