<?php

namespace App\Repository;

use App\Database\ConnectionHandler;
use Exception;

class EventsRepository extends Repository
{
    protected $tableName = "eventplan";

    public function readUserEvents($id)
    {
        $query = "SELECT TB1.id, TB1.title, TB1.description, TB1.dateOfEvent, TB1.publishDate, TB2.id as idOwner, TB2.username, TB2.name, TB2.firstname, TB2.email  FROM 
                    (SELECT * FROM `eventplan` WHERE id IN (
                        SELECT idEvent FROM userevent WHERE idUser = $id
                        )
                    ) AS TB1 
                INNER JOIN user AS TB2 ON TB1.idOwner = TB2.id";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->execute();

        $result = $statement->get_result();
        if (!$result) {
            throw new Exception($statement->error);
        }

        // Datensätze aus dem Resultat holen und in das Array $rows speichern
        $rows = array();
        while ($row = $result->fetch_object()) {
            $rows[] = $row;
        }

        return $rows;
    }

    public function create($title, $description, $date, $idOwner)
    {
        $query = "INSERT INTO $this->tableName (title, description, dateOfEvent, idOwner) VALUES (?, ?, ?, ?)";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('sssi', $title, $description, $date, $idOwner);

        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }

        return $statement->insert_id;
    }

    public function createJoin($idUser, $idEvent)
    {
        $query = "INSERT INTO userevent (idUser, idEvent) VALUES (?, ?)";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('ii', $idUser, $idEvent);

        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }

        return $statement->insert_id;
    }

    public function update($title, $description, $dateOfEvent, $id)
    {
        $query = "UPDATE {$this->tableName} SET title=?, description=?, dateOfEvent=? WHERE id=?";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('sssi', $title, $description, $dateOfEvent, $id);

        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
    }

    public function deleteReference($id)
    {
        $query = "DELETE FROM userevent WHERE idEvent=?";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('i', $id);

        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
    }
}
