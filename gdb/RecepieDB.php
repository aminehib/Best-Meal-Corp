<?php

namespace gdb;

class RecepieDB
{
    private \PDO $recepies;

    public function __construct()
    {
        $db_name = "bestmeal";
        $db_host = "127.0.0.1";
        $db_port = "3306";
        $db_user = "root";
        $db_pwd = "";

        try {
            $dsn = "mysql:dbname=$db_name;host=$db_host;port=$db_port;charset=utf8";
            $this->recepies = new \PDO($dsn, $db_user, $db_pwd);
            $this->recepies->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\Exception $e) {
            die("Erreur connexion : " . $e->getMessage());
        }
    }

    // Récupérer toutes les recettes
    public function getAllRecepies(): array
    {
        $statement = $this->recepies->prepare("SELECT * FROM recipe");

        if ($statement !== false) {
            $statement->execute();
            return $statement->fetchAll(\PDO::FETCH_CLASS , "\classe\Recepie");
        }

        return [];
    }

    // Récupérer une recette par son id
    public function getById(int $id): object|null
    {
        $statement = $this->recepies->prepare("SELECT * FROM recipe WHERE id = :id");

        if ($statement !== false) {
            $statement->bindParam(":id", $id, \PDO::PARAM_INT);
            $statement->execute();
            $statement->setFetchMode(\PDO::FETCH_CLASS, "\classe\Recepie");
            $result = $statement->fetch();
            return $result ?: null;
        }

        return null;
    }

    // Recherche par titre
    public function getRecepiesByTitle(string $title): array
    {
        $statement = $this->recepies->prepare(
            "SELECT * FROM recipe WHERE title LIKE :title"
        );

        if ($statement !== false) {
            $search = "%" . $title . "%";
            $statement->bindParam(":title", $search, \PDO::PARAM_STR);
            $statement->execute();

            return $statement->fetchAll(\PDO::FETCH_CLASS , "\classe\Recepie");
        }

        return [];
    }

    // Recherche par ingrédient
    public function getRecepiesByIngredients(string $ingredient): array
    {
        $statement = $this->recepies->prepare(
            "SELECT DISTINCT r.*
             FROM recipe r
             INNER JOIN recipe_ingredient ri ON r.id = ri.recipe_id
             INNER JOIN ingredient i ON ri.ingredient_id = i.id
             WHERE i.name LIKE :ingredient"
        );

        if ($statement !== false) {
            $search = "%" . $ingredient . "%";
            $statement->bindParam(":ingredient", $search, \PDO::PARAM_STR);
            $statement->execute();

            return $statement->fetchAll(\PDO::FETCH_CLASS , "\classe\Recepie");
        }

        return [];
    }

    // Recherche par tag
    public function getRecepiesByTags(string $tag): array
    {
        $statement = $this->recepies->prepare(
            "SELECT DISTINCT r.*
             FROM recipe r
             INNER JOIN recipe_tag rt ON r.id = rt.recipe_id
             INNER JOIN tag t ON rt.tag_id = t.id
             WHERE t.name LIKE :tag"
        );

        if ($statement !== false) {
            $search = "%" . $tag . "%";
            $statement->bindParam(":tag", $search, \PDO::PARAM_STR);
            $statement->execute();

            return $statement->fetchAll(\PDO::FETCH_CLASS , "\classe\Recepie");
        }

        return [];
    }

    // Ajouter une recette
    public function addRecepie(
        string $title,
        string $description,
        ?string $image_url = null,
        ?int $preparation_time = null,
        ?int $cooking_time = null,
        ?int $servings = null
    ): bool {
        $statement = $this->recepies->prepare(
            "INSERT INTO recipe
            (title, description, image_url, preparation_time, cooking_time, servings)
            VALUES
            (:title, :description, :image_url, :preparation_time, :cooking_time, :servings)"
        );

        if ($statement !== false) {
            return $statement->execute([
                ":title" => $title,
                ":description" => $description,
                ":image_url" => $image_url,
                ":preparation_time" => $preparation_time,
                ":cooking_time" => $cooking_time,
                ":servings" => $servings
            ]);
        }

        return false;
    }

    // Modifier une recette
    public function update(
        int $id,
        string $title,
        string $description,
        ?string $image_url = null,
        ?int $preparation_time = null,
        ?int $cooking_time = null,
        ?int $servings = null
    ): bool {
        $statement = $this->recepies->prepare(
            "UPDATE recipe
             SET title = :title,
                 description = :description,
                 image_url = :image_url,
                 preparation_time = :preparation_time,
                 cooking_time = :cooking_time,
                 servings = :servings
             WHERE id = :id"
        );

        if ($statement !== false) {
            return $statement->execute([
                ":id" => $id,
                ":title" => $title,
                ":description" => $description,
                ":image_url" => $image_url,
                ":preparation_time" => $preparation_time,
                ":cooking_time" => $cooking_time,
                ":servings" => $servings
            ]);
        }

        return false;
    }

    // Supprimer une recette
    public function delete(int $id): bool
    {
        $statement = $this->recepies->prepare(
            "DELETE FROM recipe WHERE id = :id"
        );

        if ($statement !== false) {
            return $statement->execute([
                ":id" => $id
            ]);
        }

        return false;
    }
}