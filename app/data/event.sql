DROP TABLE IF EXISTS eventplan;
CREATE TABLE  eventplan (
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

INSERT INTO eventplan (title, description, dateOfEvent, idOwner, idAdress) VALUES ('Gold, Geld, Glück', 'In der Schweiz hat fast jeder ein Bankkonto im Rücken – auch wenn das Bankgeheimnis wankt, wie es in humoristischer Weise eine erfolgreiche Kampagne der Appenzeller Käse GmbH thematisiert. Geld ist ein Lebensthema und gleichzeitig ein grosses Tabu. In den Nachkriegsjahren, als viele mit existentiellen Schwierigkeiten kämpften, war dies noch anders, wie fotorealistische Sachplakate der Basler Gestalter Peter Birkhäuser und Herbert Leupin mit ihrer Werbung für Rabattmarken von 1945 zeigen. Mit ausgewählten Beispielen gibt die Plakatausstellung Einblicke in die Entwicklung der hiesigen Konsumgesellschaft. Bereits seit dem Jahr 2000 werden in den Schaufenstern des zentral gelegenen Gebäudes der Schweizerischen Nationalbank in Zürich thematisch ausgewählte Plakate aus den reichen Beständen der Plakatsammlung des Museum für Gestaltung Zürich präsentiert. Die Plakate können in den Fenstern des Erdgeschosses entlang des Stadthausquais, der Börsenstrasse und der Fraumünsterstrasse besichtigt werden. Quelle: https://events.ch/de/Veranstaltung/Gold%2C-Geld%2C-Gl%C3%BCck/e-3653562', CURRENT_TIMESTAMP, 1, 1);
INSERT INTO eventplan (title, description, dateOfEvent, idOwner, idAdress) VALUES ('Der Wolf ist da', 'Kein Tier ist den Ängsten und Sehnsüchten der Menschen so nah wie der Wolf. Die Ausstellung lässt deshalb Menschen sprechen: Den Schafhalter, die Tierpräparatorin, den Wildhüter, den Gen-Analytiker und andere mehr. Die Rückkehr des Wolfs in die Schweiz betrifft uns alle. Ganz direkt oder durch die damit verbundenen Debatten um das Verhältnis von Stadt und Land, um Ökologie, Sicherheit, Natur und Kultur. Was macht der Wolf mit uns und was machen wir mit dem Wolf? Die Ausstellung «Der Wolf ist da. Eine Menschenausstellung» des Alpinen Museums zeigt Mechanismen auf und lässt Menschen zu Wort kommen, die sich von Berufs wegen mit dem Wolf befassen – Gelegenheit, sich abseits des Arbeitsalltags und der polarisierten Diskussionen Zeit zu nehmen für verschiedene Bilder, Sichtweisen, Argumente.', CURRENT_TIMESTAMP, 2, 2);
