<?php

namespace App;

use App\Exceptions\SqlException;

class Db
{
    protected $dbh;

    public function __construct()
    {
        //data base handler
        //$dsn - строка соединения
        //тип базы:сервер базы данных;имя схемы базы данных
        $config = Config::getConfig();
        $config = $config->data['db'];

        $dsn = $config['dbtype'] . ':host=' . $config['host'] . ';dbname=' . $config['dbname'];
        $this->dbh = new \PDO($dsn, $config['username'], $config['password']);
    }

    //принимает sql запрос и возвращает его результат
    public function query(string $sql, string $class, array $data = [])
    {
        //$sth - указатель на подготовленный запрос
        $sth = $this->dbh->prepare($sql);
        //исполняем подготовленный запрос
        $result = $sth->execute($data);
        if (false === $result) {
            throw new SqlException('Неверный запрос sql: ' . $sql);
        }
        //fetchAll - метод с помощью которого мы получаем все данные
        if (!empty($class)) {
            $data = $sth->fetchAll(\PDO::FETCH_CLASS, $class);
        } else {
            $data = $sth->fetchAll();
        }

        return $data;
    }

    public function execute(string $sql, array $data = [])
    {
        //$sth - указатель на подготовленный запрос
        $sth = $this->dbh->prepare($sql);
        //возвращаем результат выполнения (bool)
        return $sth->execute($data);
    }

    //метод возвращает id последней записи из базы данных
    public function lastInsertId()
    {
        return $this->dbh->lastInsertId();
    }
}
