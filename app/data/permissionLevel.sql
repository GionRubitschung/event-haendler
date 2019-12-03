DROP TABLE IF EXISTS permissionLevel;
CREATE TABLE  permissionLevel (
  id          INT NOT NULL AUTO_INCREMENT,
  title    VARCHAR(64) NOT NULL,
  PRIMARY KEY  (id)
);

INSERT INTO permissionLevel (title) VALUES ('admin');
INSERT INTO permissionLevel (title) VALUES ('benutzer');