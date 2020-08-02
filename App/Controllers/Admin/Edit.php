<?php

namespace App\Controllers\Admin;

use App\Controller;
use App\Models\Article;

class Edit extends Controller
{

    public function handle()
    {
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $this->view->article = Article::findById($_GET['id']);
        }

        $content = $this->view->redner(__DIR__ . '/../../Templates/Admin/edit.php');

        echo $content;
    }

}
