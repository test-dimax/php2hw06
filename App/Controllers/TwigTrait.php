<?php

namespace App\Controllers;

trait TwigTrait
{

    public function __construct()
    {
        $loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../Templates');
        $this->twig = new \Twig\Environment($loader, [
            'debug' => true,
        ]);
        $this->twig->addExtension(new \Twig\Extension\DebugExtension());
    }

}