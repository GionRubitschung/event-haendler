DROP TABLE IF EXISTS userEvent;
CREATE TABLE  userEvent (
  idUser        INT NOT NULL,
  idEvent       INT NOT NULL,
  FOREIGN KEY (idEvent) REFERENCES eventPlan(id) on delete cascade on update cascade,
  FOREIGN KEY (idUser) REFERENCES user(id) on delete cascade on update cascade
);

INSERT INTO userEvent (idUser, idEvent) VALUES (1, 1);
INSERT INTO userEvent (idUser, idEvent) VALUES (2, 2);