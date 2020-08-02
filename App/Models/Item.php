<?php


namespace App\Models;

use App\Model;

class Item extends Model implements HasTitleInterface, HasPriceInterface
{

    use HasPriceTrait;

    //статическое св-во
    protected static $table = 'items';

    public $title;

    public function getTitle(): string
    {
        return $this->title;
    }
}
