<?php

namespace App\Controllers;

use App\Controller;
use App\Models\Article;
use App\View\View;

class Index extends Controller
{
    use TwigTrait;

    protected $twig;

    public function handle()
    {

        echo $this->twig->render('news.html.twig', ['news' => Article::findAll()] );

    }

}
