<?php

namespace App;

use App\View\View;

abstract class Controller
{

    protected $view;

    public function __construct()
    {
        $this->view = new View();
    }

    protected function access()
    {
        return true;
    }

    public function action()
    {
        if ($this->access()) {
            return $this->handle();
        } else {
            die('Доступ закрыт');
        }
    }

    abstract protected function handle();

    //магический __invoke() метод вызывается, когда скрипт пытается выполнить объект как функцию.
    //ctrl(); - вот так
    //abstract public function __invoke();

}
