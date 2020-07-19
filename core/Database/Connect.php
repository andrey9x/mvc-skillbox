<?php


namespace Core\Database;


use Core\App;
use PDO;

class Connect
{
    public const AS_ARRAY = PDO::FETCH_ASSOC;
    public const AS_OBJECT = PDO::FETCH_CLASS;

    protected const AVAILABLE_MODES = [self::AS_ARRAY, self::AS_OBJECT];

    protected PDO $pdo;
    protected array $fetchMode = [self::AS_ARRAY];

    public function __construct()
    {
        $config = App::config('database');
        $dsn = "{$config['driver']}:host={$config['host']};port={$config['port']};dbname={$config['dbname']}";

        $this->pdo = new PDO($dsn, $config['user'], $config['password']);

        var_dump(PDO::getAvailableDrivers());
        var_dump($this->pdo->errorInfo());
    }

    public function setFetchMode(array $fetchMode): Connect
    {
        $this->fetchMode = $fetchMode;
        return $this;
    }

    /**
     * @param string $sql = "SELECT * FROM users WHERE id = ?"
     * @param array $params
     */
    protected function execute(string $sql, array $params)
    {
        $statement = $this->pdo->prepare($sql);
        $statement->setFetchMode(...$this->fetchMode);
        $statement->execute($params);

        return $statement;
    }

    public function fetch(string $sql, array $params)
    {
        return $this->execute($sql, $params)->fetch();
    }

    public function fetchAll(string $sql, array $params)
    {
        return $this->execute($sql, $params)->fetchAll();
    }

    public function fetchLazy(string $sql, array $params)
    {
        $statement = $this->execute($sql, $params);
        while ($row = $statement->fetch()) {
            yield $row;
        }
    }
}