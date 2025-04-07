<?php
include 'autoloader.php';
class Repository implements iRepository{
    public function __construct(public String $tableName="",public ConnexionBD $connexion){
    }
    
    public function findAll(): array
    {
        $query = "SELECT * FROM " . $this->tableName;
        $stmt = $this->connexion->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById(int $id): ?array
    {
        $query = "SELECT * FROM " . $this->tableName . " WHERE id = :id";
        $stmt = $this->connexion->prepare($query);//pour eviter les injections SQL
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function create(array $data): void
    {
        $columns = implode(", ", array_keys($data));//on obtient la chaine key_name1,key_name2
        $placeholders = ":" . implode(", :", array_keys($data));//on obtient la chaine :key_name1,:key_name2
        $query = "INSERT INTO " . $this->tableName . " ($columns) VALUES ($placeholders)";//on obtient la chaine INSERT INTO table_name (key_name1,key_name2) VALUES (:key_name1,:key_name2)
        $stmt = $this->connexion->prepare($query);//pour eviter les injections SQL
        foreach ($data as $key => $value) {
            $stmt->bindParam(":$key", $value);
        }
        $stmt->execute();
    }

    public function delete(int $id): void
    {
        $query = "DELETE FROM " . $this->tableName . " WHERE id = :id";
        $stmt = $this->connexion->prepare($query);//pour eviter les injections SQL
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
    


    

}


