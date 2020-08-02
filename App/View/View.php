<?php

namespace App\View;

class View implements \Countable, \Iterator
{

    use MagicTrait;

    private $position = 0;
    protected $data = [];

    //phpdoc: специальный комментарий который распознает например phpStorm
    // - @deprecated - использование данного метода мы считаем устаревшим
    /**
     * @deprecated
     */
    //метод для отображения данных в шаблоне
    public function assign($name, $value)
    {
        $this->data[$name] = $value;
    }

    /**
     * @param string $template Имя файла шаблона
     */
    //метод который загружает шаблон
    public function display($template)
    {
        //$this->>data['news']
        //$news
        foreach ($this->data as $index => $value) {
            //присваиваем имя переменной, которое находится в переменной $index
            //$index = 'news';
            //$$index = ${'news'} = $news
            $$index = $value;
        }
        include $template;
    }

    /**
     * @param string $template Имя файла шаблона
     * @return false|string Шаблон
     */
    //построение ответа без отправки
    public function redner($template)
    {
        //стартуем буфферизацию вывода (останавливает весь вывод в поток идущий к клиенту и организует буффер)
        ob_start();
        $this->display($template);
        //получаем то, что накопилось в буффере
        $contents = ob_get_contents();
        //Уничтожает буфер со всем что в него попало
        ob_end_clean();
        return $contents;
    }


    //метод стандартного интерфейса Iterator, для правильного поведения функции count()
    public function count()
    {
        return count($this->data);
    }


    //ниже методы стандартного интерфейса Countable, для правильного поведения функции count()

    // Метод должен вернуть значение текущего элемента
    public function current()
    {
        var_dump(__METHOD__);
        return current($this->data);
    }

    // Метод должен сдвинуть "указатель" на следующий элемент
    public function next()
    {
        var_dump(__METHOD__);
        next($this->data);
    }

    // Метод должен вернуть ключ текущего элемента
    public function key()
    {
        var_dump(__METHOD__);
        return key($this->data);
    }

    // Метод должен проверять - не вышел ли указатель за границы?
    public function valid(): bool
    {
        var_dump(__METHOD__);
        return null !== key($this->data);
    }

    // Метод должен поставить "указатель" на первый элемент
    public function rewind(): void
    {
        var_dump(__METHOD__);
        reset($this->data);
    }
}
