<?php

/**
 *
 * @property $author
 */

namespace App\Models;

use App\Exceptions\ValidationException;
use App\Model;

class Article extends Model
{

    //статическое св-во
    protected static $table = 'news';

    public $title;
    public $contents;
    public $author_id;

    /**
     * @param $name
     * @return object|null
     */
    public function __get($name)
    {
        if ('author' === $name && !empty($this->author_id)) {
            $author = Author::findById($this->author_id);
            if (!empty($author)) {
                return $author;
            }
        }
        return null;
    }

    /**
     * @param $name
     * @return bool
     */
    public function __isset($name)
    {
        if ('author' == $name) {
            return true;
        }
        return false;
    }

    /**
     * @return ValidationException
     */
    public function validateTitle()
    {
        if (empty($this->title)) {
            return new ValidationException('Свойство $title не прошло валидацию!');
        }
    }

    /**
     * @return ValidationException
     */
    public function validateContents()
    {
        if (empty($this->contents)) {
            return new ValidationException('Свойство $contents не прошло валидацию!');
        }
    }

}
