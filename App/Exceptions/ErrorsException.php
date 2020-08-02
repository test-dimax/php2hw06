<?php


namespace App\Exceptions;


class ErrorsException extends \Exception
{

    protected $errors = [];

    /**
     * @param \Exception $ex
     */
    public function add(\Exception $ex)
    {
        $this->errors[] = $ex;
    }

    /**
     * @return array
     */
    public function all()
    {
        return $this->errors;
    }

    /**
     * @return bool
     */
    public function emptyExceptions()
    {
        return empty($this->errors);
    }

}
