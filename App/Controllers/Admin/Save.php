<?php

namespace App\Controllers\Admin;

use App\Controller;
use App\Models\Article;

class Save extends Controller
{

    public function handle()
    {

        if (!empty($_POST)) {
            $article = new Article();
            $article->title = $_POST['title'];
            $article->contents = $_POST['contents'];
            $article->author_id = $_POST['author_id'];
            if (isset($_POST['id']) && !empty($_POST['id'])) {
                $article->save($_POST['id']);
            } else {
                $article->save();
            }
        }

        header('Location: /admin');
        exit;
    }

}
