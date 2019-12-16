DROP TABLE IF EXISTS userevent;
CREATE TABLE  userevent (
  idUser        INT NOT NULL,
  idEvent       INT NOT NULL,
  FOREIGN KEY (idEvent) REFERENCES eventplan(id) on delete cascade on update cascade,
  FOREIGN KEY (idUser) REFERENCES user(id) on delete cascade on update cascade
);

INSERT INTO userevent (idUser, idEvent) VALUES (1, 1);
INSERT INTO userevent (idUser, idEvent) VALUES (2, 2);