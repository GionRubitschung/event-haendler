<?php

namespace App\Repository;

use App\Database\ConnectionHandler;
use Exception;

class EventsRepository extends Repository
{
    protected $tableName = "eventplan";

    public function readUserEvents($id)
    {
        $query = "SELECT TB1.id, TB1.title, TB1.description, TB1.dateOfEvent, TB1.publishDate, 
                    TB2.id as idOwner, TB2.username, TB2.name, TB2.firstname, TB2.email, 
                    TB3.id as idAdress, TB3.namePlace, TB3.street, TB3.streetNbr, TB3.plz, TB3.place  FROM 
                    (SELECT * FROM `eventplan` WHERE id IN (
                        SELECT idEvent FROM userevent WHERE idUser = $id
                        )
                    ) AS TB1 
                INNER JOIN user AS TB2 ON TB1.idOwner = TB2.id
                INNER JOIN adress AS TB3 on TB1.idAdress = TB3.id";

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

    public function create($title, $description, $date, $idOwner, $idAdress)
    {
        $query = "INSERT INTO {$this->tableName} (title, description, dateOfEvent, idOwner, idAdress) VALUES (?, ?, ?, ?, ?)";
        echo $query;
        echo "</br>";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('sssii', $title, $description, $date, $idOwner, $idAdress);

        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }

        return $statement->insert_id;
    }

    public function createAdress($namePlace, $street, $streetNbr, $place, $plz)
    {
        // Statement zum überprüfen ob die Adresse bereits existiert
        $queryCheck = "SELECT * FROM adress WHERE namePlace=? AND street=? AND streetNbr=? AND place=? AND plz=?";

        $statementCheck = ConnectionHandler::getConnection()->prepare($queryCheck);
        $statementCheck->bind_param('ssisi', $namePlace, $street, $streetNbr, $place, $plz);

        // Execute statement
        $statementCheck->execute();

        // Resultat der Abfrage holen
        $result = $statementCheck->get_result();
        if (!$result) {
            throw new Exception($statementCheck->error);
        }

        // Ersten Datensatz aus dem Reultat holen
        $row = $result->fetch_object();

        if (isset($row)) {
            return $row->id;
        } else {
            $query = "INSERT INTO adress(namePlace, street, streetNbr, place, plz) VALUES(?, ?, ?, ?, ?)";
            $statement = ConnectionHandler::getConnection()->prepare($query);
            $statement->bind_param('ssisi', $namePlace, $street, $streetNbr, $place, $plz);

            if (!$statement->execute()) {
                throw new Exception($statement->error);
            }

            return $statement->insert_id;
        }
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
