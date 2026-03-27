<?php
namespace gdb;

// Classe pour gérer les ingrédients
class IngredientDB
{
    // Connexion à la base
    private \PDO $pdo;

    // Constructeur : connexion automatique
    public function __construct()
    {
        $db_name = "bestmeal";
        $db_host = "127.0.0.1";
        $db_port = "3306";
        $db_user = "root";
        $db_pwd = "";

        try {
            // Connexion PDO
            $dsn = "mysql:dbname=$db_name;host=$db_host;port=$db_port;charset=utf8";
            $this->pdo = new \PDO($dsn, $db_user, $db_pwd);

            // Affiche les erreurs SQL
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        } catch (\Exception $e) {
            die("Erreur connexion : " . $e->getMessage());
        }
    }

    // Récupère tous les ingrédients
    public function getAllIngredients(): array
    {
        $statement = $this->pdo->prepare("SELECT * FROM ingredient");

        if ($statement !== false) {
            $statement->execute();
            return $statement->fetchAll(\PDO::FETCH_OBJ);
        }

        return [];
    }

    // Récupère un ingrédient par son id
    public function getById(int $id): object|null
    {
        $statement = $this->pdo->prepare("SELECT * FROM ingredient WHERE id = :id");

        if ($statement !== false) {
            $statement->execute([
                ":id" => $id
            ]);

            return $statement->fetch(\PDO::FETCH_OBJ);
        }

        return null;
    }

    // Recherche un ingrédient par nom
    public function getIngredientByName(string $name): array
    {
        $statement = $this->pdo->prepare(
            "SELECT * FROM ingredient WHERE name LIKE :name"
        );

        if ($statement !== false) {
            $search = "%" . $name . "%";

            $statement->execute([
                ":name" => $search
            ]);

            return $statement->fetchAll(\PDO::FETCH_OBJ);
        }

        return [];
    }

    // Ajoute un ingrédient
    public function addIngredient(string $name, ?string $image_url = null): bool
    {
        $statement = $this->pdo->prepare(
            "INSERT INTO ingredient (name, image_url) VALUES (:name, :image_url)"
        );

        if ($statement !== false) {
            return $statement->execute([
                ":name" => $name,
                ":image_url" => $image_url
            ]);
        }

        return false;
    }

    // Modifie un ingrédient
    public function updateIngredient(int $id, string $name, ?string $image_url = null): bool
    {
        $statement = $this->pdo->prepare(
            "UPDATE ingredient SET name = :name, image_url = :image_url WHERE id = :id"
        );

        if ($statement !== false) {
            return $statement->execute([
                ":id" => $id,
                ":name" => $name,
                ":image_url" => $image_url
            ]);
        }

        return false;
    }

    // Supprime un ingrédient
    public function deleteIngredient(int $id): bool
    {
        $statement = $this->pdo->prepare(
            "DELETE FROM ingredient WHERE id = :id"
        );

        if ($statement !== false) {
            return $statement->execute([
                ":id" => $id
            ]);
        }

        return false;
    }


    public function getIngredients(int $id):array{

    $statement = $this->pdo->prepare(
        "SELECT ing.* 
         FROM ingredient ing 
         INNER JOIN recipe_ingredient ri ON ing.id = ri.ingredient_id
         INNER JOIN recipe r ON r.id = ri.recipe_id
         WHERE r.id = :id"
    );

    if($statement !== false){
        $statement->execute([
            'id' => $id
        ]);

        return $statement->fetchAll(\PDO::FETCH_CLASS, "\classe\Ingredient");
    }

    return [];
}

    












}