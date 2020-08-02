<?php


namespace App\Models;

use App\Model;

class Author extends Model
{

    //статическое св-во
    protected static $table = 'authors';

    public $name;

}
