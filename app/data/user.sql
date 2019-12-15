DROP TABLE IF EXISTS user;
CREATE TABLE  user (
  id          INT NOT NULL AUTO_INCREMENT,
  username    VARCHAR(64) NOT NULL,
  password    VARCHAR(255)  NOT NULL,
  name        VARCHAR(64)  NOT NULL,
  firstname   VARCHAR(64)  NOT NULL,
  email       VARCHAR(128) NOT NULL UNIQUE,
  idPermission  INT NOT NULL,
  PRIMARY KEY  (id)
);

ALTER TABLE user
ADD FOREIGN KEY (idPermission) REFERENCES permissionLevel(id) ON DELETE NO ACTION ON UPDATE CASCADE;

INSERT INTO user (username, password, name, firstName, email, idPermission) VALUES ('userName1', sha2('ramon', 256), 'Ramon', 'Firstname', 'eine@mail.com', 1);
INSERT INTO user (username, password, name, firstName, email, idPermission) VALUES ('userName2', sha2('samuel', 256), 'Samuel', 'Firstname', 'eine@mai33.com', 1);
