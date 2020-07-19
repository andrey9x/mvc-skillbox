<?php


namespace Core\Database;


class Model
{
    protected array $attributes = [];

    protected static function table(): string
    {
        return 'table';
    }

    public static function query(): QueryBuilder
    {
        $query = new QueryBuilder();
        return $query->table(static::table())->model(static::class);
    }

    public function __set($name, $value)
    {
        $this->attributes[$name] = $value;
    }

    public function __get($name)
    {
        return $this->attributes[$name] ?? null;
    }
}