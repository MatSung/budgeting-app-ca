<?php

namespace App\Repositories;

class BaseRepository
{
    //PDO connection object

    private \PDO $dbh;

    function __construct()
    {

        try {
            $dsn = 'mysql:host=mariadb;dbname=' . getenv('MYSQL_DATABASE');

            $this->dbh = new \PDO($dsn, getenv('MYSQL_USER'), getenv('MYSQL_PASSWORD'), [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
            ]);
        } catch (\PDOException $e) {
            // error handling
        }
    }

    public function fetchAll(int $limit = 20): array
    {
        $query = '
        SELECT 
            entries.id, entries.date_time, types.name as type, entries.amount, entries.note
        FROM 
            entries
        LEFT JOIN
            types ON entries.type_id = types.id
        ORDER BY `date_time` DESC
        LIMIT :limit
        ';

        $stmt = $this->dbh->prepare($query);

        $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);

        $stmt->execute();

        $all = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $all;
    }
}
