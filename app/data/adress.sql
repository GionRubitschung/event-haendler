DROP TABLE IF EXISTS adress;

CREATE TABLE adress(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    namePlace VARCHAR(64),
    street VARCHAR(64)  NOT NULL,
    streetNbr INT,
    plz INT(4) NOT NULL,
    place VARCHAR(64) NOT NULL
);

INSERT INTO adress (namePlace, street, streetNbr, plz, place) VALUES ("Halle 622", "Therese-Giehse-Strasse", 10, 8050, "Zürich");
INSERT INTO adress (street, streetNbr, plz, place) VALUES ("Bahnhöheweg", 70, 3018, "Bern");