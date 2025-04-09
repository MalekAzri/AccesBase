<?php
include 'autoloader.php';
class Repository implements iRepository{
    public function __construct(public String $tableName="",public PDO $connexion){
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

    public function create(array $data):void {
        // Validation et formatage de la date
        if (isset($data['birthday'])) {
            $data['birthday'] = DateTime::createFromFormat('Y-m-d', $data['birthday'])->format('Y-m-d');
        }
        
        // Requête d'insertion
        $query = "INSERT INTO " . $this->tableName . " (id, name, email, birthday, image, section) 
                  VALUES (:id, :name, :email, :birthday, :image, :section)";
        $stmt = $this->connexion->prepare($query);
        $stmt->execute($data);
    }
    

    public function delete(int $id): void
    {
        $query = "DELETE FROM " . $this->tableName . " WHERE id = :id";
        $stmt = $this->connexion->prepare($query);//pour eviter les injections SQL
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
    
    public function update(int $id, array $data): bool
    {
        // Construire la partie SET de la requête SQL
        $setClause = [];
        foreach ($data as $column => $value) {
            $setClause[] = "$column = :$column";
        }
        $setClause = implode(", ", $setClause); // Concaténer les colonnes et valeurs

        // Construire la requête SQL avec WHERE pour spécifier quel enregistrement mettre à jour
        $query = "UPDATE " . $this->tableName . " SET $setClause WHERE id = :id";
        $stmt = $this->connexion->prepare($query);

        // Lier les valeurs de chaque colonne à la requête
        foreach ($data as $column => $value) {
            $stmt->bindValue(":$column", $value);
        }

        // Lier l'ID pour la condition WHERE
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);

        // Exécuter la requête et retourner le résultat
        return $stmt->execute();
    }

    

}


