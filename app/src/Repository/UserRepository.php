<?php

namespace App\Repository;

use App\Database\ConnectionHandler;
use Exception;

/**
 * Das UserRepository ist zuständig für alle Zugriffe auf die Tabelle "user".
 *
 * Die Ausführliche Dokumentation zu Repositories findest du in der Repository Klasse.
 */
class UserRepository extends Repository
{
    /**
     * Diese Variable wird von der Klasse Repository verwendet, um generische
     * Funktionen zur Verfügung zu stellen.
     */
    protected $tableName = 'user';

    /**
     * Erstellt einen neuen benutzer mit den gegebenen Werten.
     *
     * Das Passwort wird vor dem ausführen des Queries noch mit dem SHA1
     *  Algorythmus gehashed.
     *
     * @param $firstName Wert für die Spalte firstName
     * @param $lastName Wert für die Spalte lastName
     * @param $email Wert für die Spalte email
     * @param $password Wert für die Spalte password
     * @param $username Wert für den Benutzernamen
     *
     * @throws Exception falls das Ausführen des Statements fehlschlägt
     */
    public function create($firstName, $lastName, $email, $password, $username)
    {
        $password = password_hash($password, PASSWORD_BCRYPT);

        $query = "INSERT INTO $this->tableName (username, password, name, firstName, email, idPermission) VALUES (?, ?, ?, ?, ?, 2)";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('sssss', $username, $password, $lastName, $firstName, $email);

        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }

        return $statement->insert_id;
    }

    /**
     * Get user name by email
     *
     * @param $email Value for Column email
     */
    public function readByEmail($email)
    {
        // Create query
        $query = "SELECT id, username, firstname, name, email, password FROM {$this->tableName} WHERE email=?";

        // Prepary DB connection
        // bind parameters to query
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('s', $email);

        // Execute statement
        $statement->execute();

        // Resultat der Abfrage holen
        $result = $statement->get_result();
        if (!$result) {
            throw new Exception($statement->error);
        }

        // Ersten Datensatz aus dem Reultat holen
        $row = $result->fetch_object();

        // Datenbankressourcen wieder freigeben
        $result->close();

        // Den gefundenen Datensatz zurückgeben
        return $row;
    }

    /**
     * This function updates .
     *
     * @param $id id of currently logged in user
     * @param $username username to update
     * @param $password password to hash
     * @param $name name to update
     * @param $firstname updated firstname of user
     * @param $email updated email of user
     * 
     * @throws Exception if statement calls an error
     *
     * @return updated user
     */
    public function updateUser($id, $username, $password, $name, $firstname, $email)
    {
        // Create Query
        $query = "UPDATE {$this->tableName} SET username=?, password=?, name=?, firstname=?, email=? WHERE id=?";

        // hash new password
        $password_hash = password_hash($password, PASSWORD_BCRYPT);

        // Prepary DB connection
        // bind parameters to query
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('sssssi', $username, $password_hash, $name, $firstname, $email, $id);

        // Execute statement
        $statement->execute();

        // Get result of query
        $result = $statement->affected_rows;

        // return true is 1 row was affected
        if ($result == 1) {
            return true;
        }
        return false;
    }

    /**
     * Get password of currently logged-in user
     * @param id user id 
     */
    public function checkPassword($id)
    {
        // Create query
        $query = "SELECT password FROM {$this->tableName} WHERE id=?";

        // Prepary DB connection
        // bind parameters to query
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('i', $id);

        // Execute statement
        $statement->execute();

        // Resultat der Abfrage holen
        $result = $statement->get_result();
        if (!$result) {
            throw new Exception($statement->error);
        }

        // Ersten Datensatz aus dem Reultat holen
        $row = $result->fetch_object();

        // Close DB connection
        $result->close();

        // Den gefundenen Datensatz zurückgeben
        return $row;
    }


    /**
     * Get password of currently logged-in user
     * @param email email from user
     */
    public function checkEmail($email)
    {
        // Create query
        $query = "SELECT email FROM {$this->tableName} WHERE email=?";

        // Prepary DB connection
        // bind parameters to query
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('s', $email);

        // Execute statement
        $statement->execute();

        // Resultat der Abfrage holen
        $result = $statement->get_result();
        if (!$result) {
            throw new Exception($statement->error);
        }

        // Ersten Datensatz aus dem Reultat holen
        $row = $result->fetch_object();

        // Close DB connection
        $result->close();

        // Den gefundenen Datensatz zurückgeben
        return $row;
    }
}
