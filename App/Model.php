<?php


namespace App;

use App\Exceptions\ErrorsException;
use App\Exceptions\FillException;
use App\Exceptions\NotFoundException;
use App\Exceptions\ValidationException;

//делаем абстрактный класс (объекты абстрактного класса нельзя создавать)
abstract class Model
{
    protected static $table = null;

    public $id;

    /**
     * @param int|null $id - идентификатор удаляемой/редактируемой щаписи
     * метод решающий новая модель (insert) или редактируемая модель (update)
     */
    public function save(int $id = null)
    {
        if (!empty($id)) {
            //если передан id, то обновляем запись
            $this->update($id);
        } else {
            //иначе создаем новую
            $this->insert();
        }
    }

    /**
     * @param int $id - идентификатор удаляемой записи
     * метод удаляющий запись из базы данных
     */
    public static function delete(int $id)
    {
        if (!empty($id)) {
            $sql = 'DELETE FROM ' . static::$table . ' WHERE id=:id';
            //$data - массив данных
            $data = [':id' => $id];

            $db = new Db();
            $db->execute($sql, $data);
        }
    }

    /**
     * метод вставки новой записи в базу данных
     */
    public function insert()
    {
        $props = get_object_vars($this);
        //$fields - массив полей которые нужно вставить в базу данных
        $fields = [];
        //$binds - массив вставок
        $binds = [];
        //$data - массив данных
        $data = [];
        foreach ($props as $name => $value) {
            //поле id пропускаем за ненадобностью
            if ('id' == $name) {
                continue;
            }
            $fields[] = $name;
            $binds[] = ':' . $name;
            $data[':' . $name] = $value;
        }
        $sql = '
        INSERT INTO ' . static::$table . '
        (' . implode(',', $fields) . ') 
        VALUES (' . implode(',', $binds) . ')';

        $db = new Db();
        $db->execute($sql, $data);

        $this->id = $db->lastInsertId();
    }

    /**
     * @param int $id - идентификатор редактируемой записи
     */
    public function update(int $id)
    {
        $props = get_object_vars($this);
        //$fields - массив полей которые нужно редактировать (сразу делаем со вставками title=:title)
        $fields = [];
        //$data - массив данных
        $data = [];
        foreach ($props as $name => $value) {
            //поле id пропускаем за ненадобностью
            if ('id' == $name) {
                $data[':' . $name] = $id;
                continue;
            }
            $fields[] = $name . '=:' . $name;
            $data[':' . $name] = $value;
        }
        $sql = '
        UPDATE ' . static::$table . '
        SET ' . implode(',', $fields) . ' 
        WHERE id=:id';

        $db = new Db();
        $db->execute($sql, $data);
    }

    /**
     * @param $id - идентификатор записи
     * @return object|false - возвращает запись из базы данных в виде объекта
     */
    public static function findById($id)
    {
        $db = new Db;
        $data = $db->query(
            'SELECT * FROM ' . static::$table . ' WHERE id=:id',
            static::class,
            [':id' => $id]
        );
        if (!empty($data)) {
            return $data[0];
        } else {
            throw new NotFoundException('Ошибка 404 - не найдено');
        }
        return false;
    }

    /**
     * @return array - все записи из базы данных
     */
    public static function findAll()
    {
        $db = new Db;
        $data = $db->query(
            'SELECT * FROM ' . static::$table,
            static::class
        );
        return $data;
    }

    /**
     * @param int $limit - к-во записей которое нужно вытащить
     * @return array - массив с записями из базы данных
     */
    public static function findSomeRecords(int $limit)
    {
        $db = new Db;
        $sql = 'SELECT * from ' . static::$table . ' ORDER by id desc LIMIT ' . (int)$limit;
        $data = $db->query($sql, static::class);

        return $data;
    }

    /**
     * @param array $data
     *
     * @throws ErrorsException
     *
     * Метод заполняет свойства модели данными из массива, валидируя их
     */
    public function fill(array $data)
    {
        $errors = new ErrorsException();

        $props = get_object_vars($this);
        foreach ($data as $key => $value) {
            if (array_key_exists($key, $props)) {
                $this->$key = $value;
            } else {
                $errors->add(new FillException('Свойство ' . $key . ' не найдено!'));
            }

            $validationMethod = 'validate' . ucfirst($key);
            if (method_exists($this, $validationMethod)) {
                $validResult = $this->$validationMethod();
                if ($validResult) {
                    $errors->add($validResult);
                }
            }
        }
        if ($errors->emptyExceptions()) {
            throw $errors;
        }
    }

}
