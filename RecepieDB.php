<?php

namespace gdb;

class RecepieDB
{
    private \PDO $recepies;

    public function __construct()
    {
        $db_name = "bestmeal";
        $db_host = "127.0.0.1";
        $db_port = "3307";
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

    // Recuperer toutes les recettes
    public function getAllRecepies(): array
    {
        $statement = $this->recepies->prepare("SELECT * FROM recipe");

        if ($statement !== false) {
            $statement->execute();
            return $statement->fetchAll(\PDO::FETCH_OBJ);
        }

        return [];
    }

    // Recuperer une recette par son id
    public function getById(int $id): object|null
    {
        $statement = $this->recepies->prepare("SELECT * FROM recipe WHERE id = :id");

        if ($statement !== false) {
            $statement->bindParam(":id", $id, \PDO::PARAM_INT);
            $statement->execute();

            $result = $statement->fetch(\PDO::FETCH_OBJ);
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

            return $statement->fetchAll(\PDO::FETCH_OBJ);
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

        $statement = $this->recepies->prepare(
            "SELECT DISTINCT r.*
             FROM recipe r
             INNER JOIN recipe_ingredient ri ON r.id = ri.recipe_id
             INNER JOIN ingredient i ON ri.ingredient_id = i.id
             WHERE " . implode(" OR ", $conditions)
        );

        if ($statement !== false) {
            $statement->execute($params);

            return $statement->fetchAll(\PDO::FETCH_OBJ);
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

        $statement = $this->recepies->prepare(
            "SELECT DISTINCT r.*
             FROM recipe r
             INNER JOIN recipe_tag rt ON r.id = rt.recipe_id
             INNER JOIN tag t ON rt.tag_id = t.id
             WHERE " . implode(" OR ", $conditions)
        );

        if ($statement !== false) {
            $statement->execute($params);

            return $statement->fetchAll(\PDO::FETCH_OBJ);
        }

        return [];
    }

    // Ajouter une recette
    public function addRecepie(
        string $title,
        string $description,
        array $ingredient_ids = [],
        array $tag_ids = [],
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
            try {
                $this->recepies->beginTransaction();

                $statement->execute([
                    ":title" => $title,
                    ":description" => $description,
                    ":image_url" => $image_url,
                    ":preparation_time" => $preparation_time,
                    ":cooking_time" => $cooking_time,
                    ":servings" => $servings
                ]);

                $recipe_id = (int) $this->recepies->lastInsertId();

                if ($ingredient_ids !== []) {
                    $ingredientStatement = $this->recepies->prepare(
                        "INSERT INTO recipe_ingredient (recipe_id, ingredient_id)
                         VALUES (:recipe_id, :ingredient_id)"
                    );

                    if ($ingredientStatement === false) {
                        $this->recepies->rollBack();
                        return false;
                    }

                    foreach ($ingredient_ids as $ingredient_id) {
                        $ingredientStatement->execute([
                            ":recipe_id" => $recipe_id,
                            ":ingredient_id" => $ingredient_id
                        ]);
                    }
                }

                if ($tag_ids !== []) {
                    $tagStatement = $this->recepies->prepare(
                        "INSERT INTO recipe_tag (recipe_id, tag_id)
                         VALUES (:recipe_id, :tag_id)"
                    );

                    if ($tagStatement === false) {
                        $this->recepies->rollBack();
                        return false;
                    }

                    foreach ($tag_ids as $tag_id) {
                        $tagStatement->execute([
                            ":recipe_id" => $recipe_id,
                            ":tag_id" => $tag_id
                        ]);
                    }
                }

                $this->recepies->commit();
                return true;
            } catch (\Exception $e) {
                if ($this->recepies->inTransaction()) {
                    $this->recepies->rollBack();
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
        array $ingredient_ids = [],
        array $tag_ids = [],
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
            try {
                $this->recepies->beginTransaction();

                $statement->execute([
                    ":id" => $id,
                    ":title" => $title,
                    ":description" => $description,
                    ":image_url" => $image_url,
                    ":preparation_time" => $preparation_time,
                    ":cooking_time" => $cooking_time,
                    ":servings" => $servings
                ]);

                $deleteIngredientStatement = $this->recepies->prepare(
                    "DELETE FROM recipe_ingredient WHERE recipe_id = :recipe_id"
                );

                $deleteTagStatement = $this->recepies->prepare(
                    "DELETE FROM recipe_tag WHERE recipe_id = :recipe_id"
                );

                if ($deleteIngredientStatement === false || $deleteTagStatement === false) {
                    $this->recepies->rollBack();
                    return false;
                }

                $deleteIngredientStatement->execute([
                    ":recipe_id" => $id
                ]);

                $deleteTagStatement->execute([
                    ":recipe_id" => $id
                ]);

                if ($ingredient_ids !== []) {
                    $ingredientStatement = $this->recepies->prepare(
                        "INSERT INTO recipe_ingredient (recipe_id, ingredient_id)
                         VALUES (:recipe_id, :ingredient_id)"
                    );

                    if ($ingredientStatement === false) {
                        $this->recepies->rollBack();
                        return false;
                    }

                    foreach ($ingredient_ids as $ingredient_id) {
                        $ingredientStatement->execute([
                            ":recipe_id" => $id,
                            ":ingredient_id" => $ingredient_id
                        ]);
                    }
                }

                if ($tag_ids !== []) {
                    $tagStatement = $this->recepies->prepare(
                        "INSERT INTO recipe_tag (recipe_id, tag_id)
                         VALUES (:recipe_id, :tag_id)"
                    );

                    if ($tagStatement === false) {
                        $this->recepies->rollBack();
                        return false;
                    }

                    foreach ($tag_ids as $tag_id) {
                        $tagStatement->execute([
                            ":recipe_id" => $id,
                            ":tag_id" => $tag_id
                        ]);
                    }
                }

                $this->recepies->commit();
                return true;
            } catch (\Exception $e) {
                if ($this->recepies->inTransaction()) {
                    $this->recepies->rollBack();
                }

                return false;
            }
        }

        return false;
    }

    // Supprimer une recette
    public function deleteRecepie(int $id): bool
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

    public function rechercherRecepie(string|array $titles): array
    {
        return $this->getRecepiesByTitle($titles);
    }
}
