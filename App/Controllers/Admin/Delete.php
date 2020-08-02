<?php

namespace App\Controllers\Admin;

use App\Controller;
use App\Models\Article;
use App\Models\Article as ArticleModel;
use App\View\View;

class Delete extends Controller
{

    public function handle()
    {

        if (isset($_GET['id']) && !empty($_GET['id'])) {
            Article::delete($_GET['id']);
            header('Location: /admin');
            exit;
        } else {
            echo 'Статьи которую вы пытаетесь удалить не существует. Вернитесь в <a href="/admin">панель администратора</a>';
        }

    }

}
