DROP TABLE IF EXISTS eventPlan;
CREATE TABLE  eventPlan (
    id      INT NOT NULL AUTO_INCREMENT,
    title VARCHAR(64)  NOT NULL,
    description  VARCHAR(64)  NOT NULL,
    dateOfEvent  DATETIME NOT NULL,
    publishDate  DATETIME NOT NULL 
        DEFAULT CURRENT_TIMESTAMP,
    idOwner INT NOT NULL,
    PRIMARY KEY  (id),
    FOREIGN KEY (idOwner) REFERENCES user(id) on delete cascade on update cascade
);

INSERT INTO eventPlan (title, description, dateOfEvent, idOwner) VALUES ('TestEvent', 'Lorem Ipsum', CURRENT_TIMESTAMP, 1);
INSERT INTO eventPlan (title, description, dateOfEvent, idOwner) VALUES ('TestEvent2', 'Lorem Ipsum2', CURRENT_TIMESTAMP, 2);
