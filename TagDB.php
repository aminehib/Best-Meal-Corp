<?php

namespace gdb;

// Classe pour gérer les tags dans la base de données
class TagDB
{
    // Variable pour la connexion à la base
    private \PDO $pdo;

    // Constructeur : se connecte à la base dès qu'on crée l'objet
    public function __construct()
    {
        $db_name = "bestmeal";
        $db_host = "127.0.0.1";
        $db_port = "3307";
        $db_user = "root";
        $db_pwd = "";

        try {
            // Connexion à MySQL avec PDO
            $dsn = "mysql:dbname=$db_name;host=$db_host;port=$db_port;charset=utf8";
            $this->pdo = new \PDO($dsn, $db_user, $db_pwd);

            // Permet d'afficher les erreurs SQL
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        } catch (\Exception $e) {
            // Si la connexion échoue
            die("Erreur connexion : " . $e->getMessage());
        }
    }

    // Récupère tous les tags de la table
    public function getAllTags(): array
    {
        $statement = $this->pdo->prepare("SELECT * FROM tag");

        if ($statement !== false) {
            $statement->execute(); // exécute la requête
            return $statement->fetchAll(\PDO::FETCH_OBJ); // retourne tous les résultats
        }

        return [];
    }

    // Récupère un tag en fonction de son id
    public function getById(int $id): object|null
    {
        $statement = $this->pdo->prepare("SELECT * FROM tag WHERE id = :id");

        if ($statement !== false) {
            // on passe la valeur de l'id de manière sécurisée
            $statement->execute([
                ":id" => $id
            ]);

            $result = $statement->fetch(\PDO::FETCH_OBJ); // un seul résultat
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
            // exécute la requête avec le nom donné
            return $statement->execute([
                ":name" => $name
            ]);
        }

        return false;
    }

    // Modifie le nom d’un tag existant
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

    // Supprime un tag grâce à son id
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
}
