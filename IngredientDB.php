<?php
namespace gdb;

require_once __DIR__ . "/DB.php";

// Classe pour gerer les ingredients
class IngredientDB extends DB{
    // Recupere tous les ingredients
    public function getAllIngredients(): array
    {
        $statement = $this->pdo->prepare("SELECT * FROM ingredient");

        if ($statement !== false) {
            $statement->execute();
            return $statement->fetchAll(\PDO::FETCH_OBJ);
        }

        return [];
    }

    // Recupere un ingredient par son id
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

    // Ajoute un ingredient
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

    public function getOrCreateIngredientIdByName(string $name, ?string $image_url = null): int
    {
        $normalizedName = trim($name);

        if ($normalizedName === '') {
            throw new \InvalidArgumentException("Le nom de l'ingredient ne peut pas etre vide.");
        }

        $statement = $this->pdo->prepare(
            "SELECT id FROM ingredient WHERE name = :name LIMIT 1"
        );

        if ($statement === false) {
            throw new \Exception("Erreur preparation recherche ingredient");
        }

        $statement->execute([
            ":name" => $normalizedName
        ]);

        $ingredientId = $statement->fetchColumn();

        if ($ingredientId !== false) {
            return (int) $ingredientId;
        }

        $insertStatement = $this->pdo->prepare(
            "INSERT INTO ingredient (name, image_url) VALUES (:name, :image_url)"
        );

        if ($insertStatement === false) {
            throw new \Exception("Erreur preparation ajout ingredient");
        }

        $insertStatement->execute([
            ":name" => $normalizedName,
            ":image_url" => $image_url
        ]);

        return (int) $this->pdo->lastInsertId();
    }

    // Modifie un ingredient
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

    // Supprime un ingredient
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

    public function rechercherIngredient(string|array $names): array
    {
        return $this->getIngredientByName($names);
    }
}

