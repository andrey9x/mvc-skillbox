<?php


namespace Core\Database;


class QueryBuilder
{
    protected Connect $connect;

    protected string $table = '';
    protected array $selects = ['*'];
    protected array $wheres = [];

    public function __construct()
    {
        $this->connect = new Connect();
    }

    /**
     * @param string $table
     * @return QueryBuilder
     */
    public function table(string $table): QueryBuilder
    {
        $this->table = $table;
        return $this;
    }

    public function model(string $model): QueryBuilder
    {
        $this->connect->setFetchMode([Connect::AS_OBJECT, $model]);
        return $this;
    }

    /**
     * @param array $selects
     * @return QueryBuilder
     */
    public function select(array $selects = ['*']): QueryBuilder
    {
        $this->selects = $selects;
        return $this;
    }

    /**
     * @param string $field
     * @param $op
     * @param null $value
     * @return QueryBuilder
     */
    public function where(string $field, $op, $value = null): QueryBuilder
    {
        if (is_null($value)) {
            [$op, $value] = ['=', $op];
        }
        $this->wheres[] = [[$field, $op], $value];
        return $this;
    }

    public function toSql()
    {
        $sql = "SELECT " . implode(', ', $this->selects) . " FROM " . $this->table;
        if (count($this->wheres)) {
            $sql .= " WHERE " . implode(' AND ', array_map(fn($where) => "{$where[0]} {$where[1]} ?", array_column($this->wheres, 0)));
        }
        return $sql;
    }

    public function getWhereValues()
    {
        return array_column($this->wheres, 1);
    }

    public function get()
    {
        return $this->connect->fetch($this->toSql(), $this->getWhereValues());
    }

    public function all()
    {
        return $this->connect->fetchAll($this->toSql(), $this->getWhereValues());
    }

    public function lazyAll(): \Generator
    {
        yield $this->connect->fetchLazy($this->toSql(), $this->getWhereValues());
    }
}