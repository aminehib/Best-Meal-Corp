<?php

namespace gdb;

require_once __DIR__ . "/IngredientDB.php";
require_once __DIR__ . "/TagDB.php";
require_once __DIR__ . "/DB.php";
require_once __DIR__ . "/../classe/Recepie.php";

class RecepieDB extends DB{
    private function linkIngredients(int $recipe_id, array $ingredient_ids): void
    {
        $statement = $this->pdo->prepare(
            "INSERT INTO recipe_ingredient (recipe_id, ingredient_id)
             VALUES (:recipe_id, :ingredient_id)"
        );

        if ($statement === false) {
            throw new \Exception("Erreur preparation recipe_ingredient");
        }

        foreach ($ingredient_ids as $ingredient_id) {
            $statement->execute([
                ":recipe_id" => $recipe_id,
                ":ingredient_id" => $ingredient_id
            ]);
        }
    }

    private function linkTags(int $recipe_id, array $tag_ids): void
    {
        $statement = $this->pdo->prepare(
            "INSERT INTO recipe_tag (recipe_id, tag_id)
             VALUES (:recipe_id, :tag_id)"
        );

        if ($statement === false) {
            throw new \Exception("Erreur preparation recipe_tag");
        }

        foreach ($tag_ids as $tag_id) {
            $statement->execute([
                ":recipe_id" => $recipe_id,
                ":tag_id" => $tag_id
            ]);
        }
    }


    // Recuperer toutes les recettes
    public function getAllRecepies(): array
    {
        $statement = $this->pdo->prepare("SELECT * FROM recipe");

        if ($statement !== false) {
            $statement->execute();
            return $statement->fetchAll(\PDO::FETCH_CLASS, "\classe\Recepie");
        }

        return [];
    }

    // Recuperer une recette par son id
    public function getById(int $id): object|null
    {
        $statement = $this->pdo->prepare("SELECT * FROM recipe WHERE id = :id");

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
        $statement = $this->pdo->prepare(
            "SELECT * FROM recipe WHERE title LIKE :title"
        );

        if ($statement !== false) {
            $search = "%" . $title . "%";
            $statement->bindParam(":title", $search, \PDO::PARAM_STR);
            $statement->execute();

            return $statement->fetchAll(\PDO::FETCH_CLASS, "\classe\Recepie");
        }

        return [];
    }

    // Recherche par ingredient
    public function getRecepiesByIngredients(array $ingredients): array
    {
        if ($ingredients === []) {
            return [];
        }

        $conditions = [];
        $params = [];

        foreach ($ingredients as $index => $ingredient) {
            $conditions[] = "i.name LIKE :ingredient$index";
            $params[":ingredient$index"] = "%" . $ingredient . "%";
        }

        $statement = $this->pdo->prepare(
            "SELECT DISTINCT r.*
             FROM recipe r
             INNER JOIN recipe_ingredient ri ON r.id = ri.recipe_id
             INNER JOIN ingredient i ON ri.ingredient_id = i.id
             WHERE " . implode(" OR ", $conditions)
        );

        if ($statement !== false) {
            $statement->execute($params);

            return $statement->fetchAll(\PDO::FETCH_CLASS, "\classe\Recepie");
        }

        return [];
    }

    // Recherche par tag
    public function getRecepiesByTags(array $tags): array
    {
        if ($tags === []) {
            return [];
        }

        $conditions = [];
        $params = [];

        foreach ($tags as $index => $tag) {
            $conditions[] = "t.name LIKE :tag$index";
            $params[":tag$index"] = "%" . $tag . "%";
        }

        $statement = $this->pdo->prepare(
            "SELECT DISTINCT r.*
             FROM recipe r
             INNER JOIN recipe_tag rt ON r.id = rt.recipe_id
             INNER JOIN tag t ON rt.tag_id = t.id
             WHERE " . implode(" OR ", $conditions)
        );

        if ($statement !== false) {
            $statement->execute($params);

            return $statement->fetchAll(\PDO::FETCH_CLASS, "\classe\Recepie");
        }

        return [];
    }

    // Ajouter une recette
    public function addRecepie(
        string $title,
        ?string $description = null,
        array $ingredients = [],
        array $tags = [],
        ?string $image_url = null,
        ?int $preparation_time = null,
        ?string $preparation = null,
        ?int $cooking_time = null,
        ?int $servings = null
    ): bool {
        $statement = $this->pdo->prepare(
            "INSERT INTO recipe
            (title, description, image_url, preparation_time, preparation, cooking_time, servings)
            VALUES
            (:title, :description, :image_url, :preparation_time, :preparation, :cooking_time, :servings)"
        );

        if ($statement !== false) {
            try {
                $ingredient_ids = [];
                $tag_ids = [];

                foreach ($ingredients as $ingredientName) {
                    $ingredient_ids[] = (new IngredientDB())->getOrCreateIngredientIdByName((string) $ingredientName);
                }

                foreach ($tags as $tagName) {
                    $tag_ids[] = (new TagDB())->getOrCreateTagIdByName((string) $tagName);
                }

                $this->pdo->beginTransaction();

                $statement->execute([
                    ":title" => $title,
                    ":description" => $description,
                    ":image_url" => $image_url,
                    ":preparation_time" => $preparation_time,
                    ":preparation" => $preparation,
                    ":cooking_time" => $cooking_time,
                    ":servings" => $servings
                ]);

                $recipe_id = (int) $this->pdo->lastInsertId();
                $this->linkIngredients($recipe_id, $ingredient_ids);
                $this->linkTags($recipe_id, $tag_ids);

                $this->pdo->commit();
                return true;
            } catch (\Exception $e) {
                if ($this->pdo->inTransaction()) {
                    $this->pdo->rollBack();
                }

                return false;
            }
        }

        return false;
    }

    // Modifier une recette
    public function updateRecepie(
        int $id,
        string $title,
        string $description,
        array $ingredients = [],
        array $tags = [],
        ?string $image_url = null,
        ?int $preparation_time = null,
        ?string $preparation = null,
        ?int $cooking_time = null,
        ?int $servings = null
    ): bool {
        $statement = $this->pdo->prepare(
            "UPDATE recipe
             SET title = :title,
                 description = :description,
                 image_url = :image_url,
                 preparation_time = :preparation_time,
                 preparation = :preparation,
                 cooking_time = :cooking_time,
                 servings = :servings
             WHERE id = :id"
        );

        if ($statement !== false) {
            try {
                $ingredient_ids = [];
                $tag_ids = [];

                foreach ($ingredients as $ingredientName) {
                    $ingredient_ids[] = (new IngredientDB())->getOrCreateIngredientIdByName((string) $ingredientName);
                }

                foreach ($tags as $tagName) {
                    $tag_ids[] = (new TagDB())->getOrCreateTagIdByName((string) $tagName);
                }

                $this->pdo->beginTransaction();

                $statement->execute([
                    ":id" => $id,
                    ":title" => $title,
                    ":description" => $description,
                    ":image_url" => $image_url,
                    ":preparation_time" => $preparation_time,
                    ":preparation" => $preparation,
                    ":cooking_time" => $cooking_time,
                    ":servings" => $servings
                ]);

                $this->pdo->prepare(
                    "DELETE FROM recipe_ingredient WHERE recipe_id = :recipe_id"
                )->execute([
                    ":recipe_id" => $id
                ]);

                $this->pdo->prepare(
                    "DELETE FROM recipe_tag WHERE recipe_id = :recipe_id"
                )->execute([
                    ":recipe_id" => $id
                ]);

                $this->linkIngredients($id, $ingredient_ids);
                $this->linkTags($id, $tag_ids);

                $this->pdo->commit();
                return true;
            } catch (\Exception $e) {
                if ($this->pdo->inTransaction()) {
                    $this->pdo->rollBack();
                }

                return false;
            }
        }

        return false;
    }

    // Supprimer une recette
    public function delete(int $id): bool
    {
        $statement = $this->pdo->prepare(
            "DELETE FROM recipe WHERE id = :id"
        );

        if ($statement !== false) {
            return $statement->execute([
                ":id" => $id
            ]);
        }

        return false;
    }

    public function rechercherRecepie(string|array $titles): array
    {
        return $this->getRecepiesByTitle($titles);
    }
}