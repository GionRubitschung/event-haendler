DROP TABLE IF EXISTS adress;

CREATE TABLE adress(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    namePlace VARCHAR(64),
    street VARCHAR(64)  NOT NULL,
    streetNbr INT,
    plz INT(4) NOT NULL,
    place VARCHAR(64) NOT NULL
);

INSERT INTO adress (namePlace, street, streetNbr, plz, place) VALUES ("Schweizerische Nationalbank", "Börsenstrasse", 15, 8001, "Zürich");
INSERT INTO adress (namePlace, street, streetNbr, plz, place) VALUES ("Nationalparkzentrum", "Urtatsch", 2, 7530, "Zernez");