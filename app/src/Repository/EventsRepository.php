<?php

namespace App\Repository;

use App\Database\ConnectionHandler;
use Exception;

class EventsRepository extends Repository
{
    protected $tableName = "eventplan";

    /**
     * Diese Funktion gibt alle Datensätze eines Benutzers zurück
     *
     * @param $id Die id des Benutzers
     *
     * @throws Exception falls das Ausführen des Statements fehlschlägt
     *
     * @return Ein array mit den gefundenen Datensätzen
     */
    public function readUserEvents($id)
    {
        // Query damit der Benutzer alle seine Events erhält
        $query = "SELECT TB1.id, TB1.title, TB1.description, TB1.dateOfEvent, TB1.publishDate, 
                    TB2.id as idOwner, TB2.username, TB2.name, TB2.firstname, TB2.email, 
                    TB3.id as idAdress, TB3.namePlace, TB3.street, TB3.streetNbr, TB3.plz, TB3.place  FROM 
                    (SELECT * FROM `eventplan` WHERE id IN (
                        SELECT idEvent FROM userevent WHERE idUser = $id
                        )
                    ) AS TB1 
                INNER JOIN user AS TB2 ON TB1.idOwner = TB2.id
                INNER JOIN adress AS TB3 on TB1.idAdress = TB3.id";

        // Das query wird vorbereitet und die Parameter werden eingefügt
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
        
        // Gibt die datensätze zurück
        return $rows;
    }


    /**
     * Diese Funktion erstellt ein neues Event
     *
     * @param $title Der Titel des Events
     * 
     * @param $description Die Beschreibung des Events
     * 
     * @param $date Das Datum an dem das Event stattfindet
     * 
     * @param $idOwner Die id des Benutzers der das Event erstellt hat
     * 
     * @param $idAdress Die id der Adresse an dem das Event stattfinden wird
     *
     * @throws Exception falls das Ausführen des Statements fehlschlägt
     *
     * @return $statement->insert_id Die id des erstellten Datensatzes wird zurückgegeben
     */
    public function create($title, $description, $date, $idOwner, $idAdress)
    {
        $query = "INSERT INTO {$this->tableName} (title, description, dateOfEvent, idOwner, idAdress) VALUES (?, ?, ?, ?, ?)";
        
        // Das query wird vorbereitet und die Parameter werden eingefügt
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('sssii', $title, $description, $date, $idOwner, $idAdress);

        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }

        return $statement->insert_id;
    }

    /**
     * Diese Funktion überprüft ob eine Adresse bereits existiert und erstellt eine neue
     * falls keine Exisitert
     *
     * @param $namePlace Der Name des Platzes
     * 
     * @param $street Die Strasse
     * 
     * @param $streetNbr Das Strassen Nummer
     * 
     * @param $place Die Ortschaft
     * 
     * @param $plz Die Postleihzahl
     *
     * @throws Exception falls das Ausführen des Statements fehlschlägt
     *
     * @return $row->id Die ID einer bestehenden Adresse wird zurückgegeben
     * 
     * @return $statement->insert_id Die id des erstellten Datensatzes wird zurückgegeben
     */
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
            // Wenn die Adresse bereits existiert wird dessen ID zurückgegeben
            return $row->id;
        } else {
            $query = "INSERT INTO adress(namePlace, street, streetNbr, place, plz) VALUES(?, ?, ?, ?, ?)";

            // Das query wird vorbereitet und die Parameter werden eingefügt
            $statement = ConnectionHandler::getConnection()->prepare($query);
            $statement->bind_param('ssisi', $namePlace, $street, $streetNbr, $place, $plz);

            if (!$statement->execute()) {
                throw new Exception($statement->error);
            }

            // Wenn die Adresse nicht existiert, wird die ID der neu erstellten Adresse zurückgegeben
            return $statement->insert_id;
        }
    }

    /**
     * Diese Funktion erstellt die Referenz des neuen events in der Zwischentabelle
     *
     * @param $idUser Die ID des Benutzers der das Event erstellt hat
     * 
     * @param $idEvent Die ID des Events
     *
     * @throws Exception falls das Ausführen des Statements fehlschlägt
     */
    public function createJoin($idUser, $idEvent)
    {
        $query = "INSERT INTO userevent (idUser, idEvent) VALUES (?, ?)";

        // Das query wird vorbereitet und die Parameter werden eingefügt
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('ii', $idUser, $idEvent);

        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
    }

    /**
     * Diese Funktion gibt alle Events mit dessen Adressen zurück
     *
     * @param $id Die id des Events
     *
     * @throws Exception falls das Ausführen des Statements fehlschlägt
     *
     * @return Ein array mit den gefundenen Datensätzen
     */
    public function readByIdByAddressJoin($id)
    {
        // Query erstellen
        $query = "SELECT TB1.*, TB2.namePlace, TB2.street, TB2.streetNbr, TB2.place, TB2.plz FROM {$this->tableName} as TB1
                    INNER JOIN adress as TB2 ON TB1.idAdress = TB2.id
                     WHERE TB1.id=?";

        // Datenbankverbindung anfordern und, das Query "preparen" (vorbereiten)
        // und die Parameter "binden"
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('i', $id);

        // Das Statement absetzen
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
     * Diese Funktion updatet ein neues Event
     *
     * @param $title Der Titel des Events
     * 
     * @param $description Die Beschreibung des Events
     * 
     * @param $date Das Datum an dem das Event stattfindet
     * 
     * @param $idOwner Die id des Benutzers der das Event erstellt hat
     * 
     * @param $idAdress Die id der Adresse an dem das Event stattfinden wird
     *
     * @throws Exception falls das Ausführen des Statements fehlschlägt
     */
    public function update($title, $description, $dateOfEvent, $id, $idAdress)
    {
        $query = "UPDATE {$this->tableName} SET title=?, description=?, dateOfEvent=?, idAdress=? WHERE id=?";

        // Das query wird vorbereitet und die Parameter werden eingefügt
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('sssii', $title, $description, $dateOfEvent, $idAdress, $id);

        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
    }
}
