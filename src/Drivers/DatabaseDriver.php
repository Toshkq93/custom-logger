<?php

namespace Logger\Drivers;

use PDO;

class DatabaseDriver extends Driver
{
    /** @var string $dsn */
    public $dsn;
    /** @var string $username */
    public $username;
    /** @var string $password */
    public $password;
    /** @var string $table */
    public $table;
    /** @var PDO $connection */
    private $connection;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->connection = new PDO($this->dsn, $this->username, $this->password);
    }

    /**
     * @inheritDoc
     */
    public function log($level, $message, array $context = []): void
    {
        $statement = $this->connection->prepare(
            'INSERT INTO ' . $this->table . ' (date, level, message, context) ' .
            'VALUES (:date, :level, :message, :context)'
        );

        $date = $this->getDate();
        $contextStringify = $this->contextStringify($context);

        $statement->bindParam(':date', $date);
        $statement->bindParam(':level',     $level);
        $statement->bindParam(':message',   $message);
        $statement->bindParam(':context', $contextStringify);

        $statement->execute();
    }
}