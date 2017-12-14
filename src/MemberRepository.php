<?php
namespace Itb;

class MemberRepository
{
    private $connection;

    public function __construct()
    {
        $db = new Database();
        $this->connection = $db->getConnection();
    }

    public function dropmemberTable()
    {
        $sql = "DROP TABLE IF EXISTS member";
        $this->connection->exec($sql);
    }

    public function creatememberTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS member(id integer not null primary key AUTO_INCREMENT, name text, gender text, age FLOAT )";
        $this->connection->exec($sql);
    }

    public function getAllFrommember()
    {
        $sql = 'SELECT * FROM member';
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, 'Itb\\Product');
        $member = $stmt->fetchAll();
        return $member;
    }

    public function deleteAllFromMember()
    {
        $sql = 'DELETE FROM member';
        $numRowsAffected = $this->connection->exec($sql);
        return $numRowsAffected;

    }

    public function insertIntoMember($name, $gender, $age)
    {
        $sql = 'INSERT INTO member (name, gender,age) VALUES (:name, :gender,:age)';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':age', $age);
        $stmt->execute();
    }

    public function deleteOneFromMember($id)
    {
        $sql = 'DELETE FROM member WHERE id = :id';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $id);
        $noError = $stmt->execute();
        return $noError;
    }

    public function getOneFromMember($id)
    {
        $sql = 'SELECT * FROM member WHERE id = :id';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, 'Itb\\member');
        $member = $stmt->fetch();
        return $member;
    }

    public function updateMember($id,$name, $gender, $age)
    {
        $sql = "UPDATE member SET gender = :gender, age = : WHERE id=:id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':age', $age);
        $stmt->bindParam(':id', $id);
        $noError = $stmt->execute();
        return $noError;
    }

}