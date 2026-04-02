<?php

namespace gdb;

require_once __DIR__ . "/DB.php";
// Classe pour gerer les tags dans la base de donnees
class TagDB extends DB{
    // Recupere tous les tags de la table
    public function getAllTags(): array
    {
        $statement = $this->pdo->prepare("SELECT * FROM tag");

        if ($statement !== false) {
            $statement->execute();
            return $statement->fetchAll(\PDO::FETCH_OBJ);
        }

        return [];
    }

    // Recupere un tag en fonction de son id
    public function getById(int $id): object|null
    {
        $statement = $this->pdo->prepare("SELECT * FROM tag WHERE id = :id");

        if ($statement !== false) {
            $statement->execute([
                ":id" => $id
            ]);

            $result = $statement->fetch(\PDO::FETCH_OBJ);
            return $result ?: null;
        }

        return null;
    }

    // Recherche un tag avec son nom (partiellement grâce à LIKE)
    public function getTagByName(string $name): array
    {
        $statement = $this->pdo->prepare(
            "SELECT * FROM tag WHERE name LIKE :name"
        );

        if ($statement !== false) {
            // permet de chercher même si le mot est partiel
            $search = "%" . $name . "%";

            $statement->execute([
                ":name" => $search
            ]);

            return $statement->fetchAll(\PDO::FETCH_OBJ);
        }

        return [];
    }

    // Ajoute un nouveau tag dans la base
    public function addTag(string $name): bool
    {
        $statement = $this->pdo->prepare(
            "INSERT INTO tag (name) VALUES (:name)"
        );

        if ($statement !== false) {
            return $statement->execute([
                ":name" => $name
            ]);
        }

        return false;
    }

    public function getOrCreateTagIdByName(string $name): int
    {
        $normalizedName = trim($name);

        if ($normalizedName === '') {
            throw new \InvalidArgumentException("Le nom du tag ne peut pas etre vide.");
        }

        $statement = $this->pdo->prepare(
            "SELECT id FROM tag WHERE name = :name LIMIT 1"
        );

        if ($statement === false) {
            throw new \Exception("Erreur preparation recherche tag");
        }

        $statement->execute([
            ":name" => $normalizedName
        ]);

        $tagId = $statement->fetchColumn();

        if ($tagId !== false) {
            return (int) $tagId;
        }

        $insertStatement = $this->pdo->prepare(
            "INSERT INTO tag (name) VALUES (:name)"
        );

        if ($insertStatement === false) {
            throw new \Exception("Erreur preparation ajout tag");
        }

        $insertStatement->execute([
            ":name" => $normalizedName
        ]);

        return (int) $this->pdo->lastInsertId();
    }

    // Modifie le nom d'un tag existant
    public function updateTag(int $id, string $name): bool
    {
        $statement = $this->pdo->prepare(
            "UPDATE tag SET name = :name WHERE id = :id"
        );

        if ($statement !== false) {
            return $statement->execute([
                ":id" => $id,
                ":name" => $name
            ]);
        }

        return false;
    }

    // Supprime un tag grace a son id
    public function deleteTag(int $id): bool
    {
        $statement = $this->pdo->prepare(
            "DELETE FROM tag WHERE id = :id"
        );

        if ($statement !== false) {
            return $statement->execute([
                ":id" => $id
            ]);
        }

        return false;
    }

    public function rechercherTag(string|array $names): array
    {
        return $this->getTagByName($names);
    }

    public function removeTagLink(int $tag_id): bool
    {
        $statement = $this->pdo->prepare(
            "DELETE FROM recipe_tag WHERE tag_id = :tag_id"
        );

        if ($statement !== false) {
            return $statement->execute([
                ":tag_id" => $tag_id
            ]);
        }

        return false;
    }

}
