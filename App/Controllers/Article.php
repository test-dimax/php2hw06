<?php

namespace App\Controllers;

use App\Controller;
use App\Models\Article as ArticleModel;
use App\View\View;

class Article extends Controller
{

    use TwigTrait;

    public function handle()
    {

        echo $this->twig->render('article.html.twig', ['article' => ArticleModel::findById($_GET['id'])] );

    }


}