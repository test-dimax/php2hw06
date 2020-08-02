<?php

namespace App\Controllers;

use App\Controller;
use App\Models\Article;

class Admin extends Controller
{

    public function handle()
    {
        $this->view->news = Article::findAll();

        $content = $this->view->redner(__DIR__ . '/../Templates/admin.php');

        echo $content;
    }

}
