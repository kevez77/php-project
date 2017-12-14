<?php
namespace Itb;

class adminRepository
{
    private $connection;

    public function __construct()
    {
        $db = new Database();
        $this->connection = $db->getConnection();
    }

    public function dropTableAdmin()
    {
        $sql = "DROP TABLE IF EXISTS Admin";
        $this->connection->exec($sql);
    }

    public function createTableAdmin()
    {
        $sql = "CREATE TABLE IF NOT EXISTS Admin(id integer not null primary key auto_increment, username text, password text)";
        $this->connection->exec($sql);
    }

    public function deleteAllFromAdmin()
    {
        $sql = 'DELETE * FROM Admin';
        $stmt = $this->connection->exec($sql);
    }

    public function insertIntoAdmin($username, $password)
    {
        $sql = 'INSERT INTO Admin(username, password) VALUES(:username, :password)';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $noError = $stmt->execute();
        if($noError)
        {
            return $this->connection->lastInsertId();
        } else
        {
            return false;
        }
    }

    public function getAllFromAdmin()
    {
        $sql = 'SELECT * FROM Admin';
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, 'Itb\\Character');
        $Users = $stmt->fetchAll();
        return $Users;
    }

    public function getOneFromAdmin($id)
    {
        $sql = 'SELECT * FROM Admin WHERE id = :id';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, 'ITB\\CastMembers');
        $Users = $stmt->fetch();
        return $Users;
    }

    public function deleteOneFromAdmin($id)
    {
        $sql = 'DELETE FROM Admin WHERE id = :id';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $id);
        $noError = $stmt->execute();
        return $noError;
    }


    public function updateAdmin($id, $username, $password)
    {
        $sql = "UPDATE Admin SET username = :username, password = :password WHERE id=:id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $noError = $stmt->execute();
        return $noError;
    }
}