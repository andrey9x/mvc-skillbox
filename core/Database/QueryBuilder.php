<?php


namespace Core\Database;


class QueryBuilder
{
    protected Connect $connect;

    public function __construct()
    {
        $this->connect = new Connect();
    }
}