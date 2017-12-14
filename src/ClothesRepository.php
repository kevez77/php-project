<?php
namespace Itb;

class ClothesRepository
{
    private $connection;

    public function __construct()
    {
        $db = new Database();
        $this->connection = $db->getConnection();
    }

    public function dropFoodTable()
    {
        $sql = "DROP TABLE IF EXISTS clothes";
        $this->connection->exec($sql);
    }

    public function createClothesTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS clothes(id integer not null primary key AUTO_INCREMENT, id int, description text, price FLOAT )";
        $this->connection->exec($sql);
    }

    public function getAllFromClothes()
    {
        $sql = 'SELECT * FROM clothes';
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, 'Itb\\Product');
        $clothes = $stmt->fetchAll();
        return $clothes;
    }

    public function deleteAllFromClothes()
    {
        $sql = 'DELETE FROM clothes';
        $numRowsAffected = $this->connection->exec($sql);
        return $numRowsAffected;

    }

    public function insertIntoClothes($ID, $description, $price)
    {
        $sql = 'INSERT INTO clothes (description, price) VALUES (:description, :price)';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':ID', $description);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->execute();
    }

    public function dropTableClothes(){
        $sql = 'DROP TABLE clothes';
        $this->connection->exec($sql);
    }

    public function deleteOneFromClothes($id)
    {
        $sql = 'DELETE FROM clothes WHERE id = :id';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $id);
        $noError = $stmt->execute();
        return $noError;
    }

    public function getOneFromClothes($id)
    {
        $sql = 'SELECT * FROM clothes WHERE id = :id';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, 'Itb\\clothes');
        $clothes = $stmt->fetch();
        return $clothes;
    }

    public function updateClothes($id, $description, $price)
    {
        $sql = "UPDATE clothes SET description = :description, price = :price WHERE id=:id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $noError = $stmt->execute();
        return $noError;
    }

}