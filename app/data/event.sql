DROP TABLE IF EXISTS eventPlan;
CREATE TABLE  eventPlan (
    id      INT NOT NULL AUTO_INCREMENT,
    title VARCHAR(64)  NOT NULL,
    description  TEXT  NOT NULL,
    dateOfEvent  DATETIME NOT NULL,
    publishDate  DATETIME NOT NULL 
        DEFAULT CURRENT_TIMESTAMP,
    idOwner INT NOT NULL,
    idAdress INT NOT NULL,
    PRIMARY KEY  (id),
    FOREIGN KEY (idOwner) REFERENCES user(id) on delete cascade on update cascade,
    FOREIGN KEY (idAdress) REFERENCES adress(id) on delete cascade on update cascade
);

INSERT INTO eventPlan (title, description, dateOfEvent, idOwner, idAdress) VALUES ('Heiliger Bimbam Weihnachtsmarkt', 'Kurz vor Weihnachten findet der grosse Heiliger Bimbam! Weihnachtsmarkt in der Halle 622 in Oerlikon statt. In den ehemaligen Fabrikhallen am Bahnhof Oerlikon warten neben 180 kreativen Kleinproduzenten noch andere Überraschungen. Zum Beispiel kreative Workshops, ein feines Street Food Angebot, musikalische Untermalung von DJs Bandura, Cosmiss und John Doe, Live Hang-Musik, Kinderschminken, 7-minute-Portraits, die Aktion Geistige Güter und vieles mehr.', CURRENT_TIMESTAMP, 1, 1);
INSERT INTO eventPlan (title, description, dateOfEvent, idOwner, idAdress) VALUES ('Filmabend im BBC: The Human Element', 'The Human Element“ identifiziert neben Feuer, Wasser, Luft und Erde den Menschen als fünftes Element und zeigt in eindrücklicher Manier, wie weit die Auswirkungen der Klimakrise auf der Erde bereits fortgeschritten sind. Dies gelingt mit sinnlich anregenden, ästhetischen und emotionalen Bildern, hohem journalistischen Anspruch und technischer Perfektion. Mit diesem Film wird die SDG-Filmreihe vom Impact Hub Bern weitergeführt. Gleichzeitig ist dies der Beginn von lokalen Filmabenden des Klimastreik Bern in Zusammenarbeit mit Filme für die Erde. Mit bewegenden, spannenden und visionären Filme in den schönsten Berner Locations möchten wir die Menschen erreichen.', CURRENT_TIMESTAMP, 2, 2);
