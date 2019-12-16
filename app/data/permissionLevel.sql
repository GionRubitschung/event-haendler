DROP TABLE IF EXISTS permissionlevel;
CREATE TABLE  permissionlevel (
  id          INT NOT NULL AUTO_INCREMENT,
  title    VARCHAR(64) NOT NULL,
  PRIMARY KEY  (id)
);

INSERT INTO permissionlevel (title) VALUES ('admin');
INSERT INTO permissionlevel (title) VALUES ('benutzer');