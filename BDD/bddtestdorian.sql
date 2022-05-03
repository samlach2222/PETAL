USE PETAL_DB;  -- Utilise la base de données du projet

-- Supprime d'abord les tables n'ayant pas ON DELETE CASCADE
DELETE FROM sujetforum;
DELETE FROM cours;
DELETE FROM qcm;

DELETE FROM utilisateur;  -- Enlève toutes les tables restantes car elles sont "reliées" à utilisateur


-- Insertion des données
-- Création prof & matières
INSERT INTO utilisateur VALUES (1, 1, NULL, "De Gaulle", "Charles", "charlesdegaulle@gmail.com", NULL, "123");
INSERT INTO matiere VALUES ('Matiere 1', '/my-app/PETAL/Cours/Matiere 1/bdd.png', 1);
INSERT INTO matiere VALUES ('Matiere 2', NULL, 1);
INSERT INTO matiere VALUES ('Matiere 3', NULL, 1);
INSERT INTO matiere VALUES ('Matiere 4', NULL, 1);
INSERT INTO matiere VALUES ('Matiere 5', '/my-app/PETAL/Cours/Matiere 5/sr.jpeg', 1);
INSERT INTO matiere VALUES ('Matiere 6', NULL, 1);
INSERT INTO matiere VALUES ('Matiere 7', NULL, 1);
INSERT INTO matiere VALUES ('Matiere 8', NULL, 1);

-- Création étudiant & lien étudiant-matière
INSERT INTO utilisateur VALUES (2, 0, NULL, "Haubin", "Jacques", "jacqueshaubin@gmail.com", NULL, "123");
INSERT INTO etumatiere VALUES (2, "Matiere 1");
INSERT INTO etumatiere VALUES (2, "Matiere 2");
INSERT INTO etumatiere VALUES (2, "Matiere 3");
INSERT INTO etumatiere VALUES (2, "Matiere 4");
INSERT INTO etumatiere VALUES (2, "Matiere 5");
INSERT INTO etumatiere VALUES (2, "Matiere 6");
INSERT INTO etumatiere VALUES (2, "Matiere 7");
INSERT INTO etumatiere VALUES (2, "Matiere 8");

-- Création CM/TD/TP/QCM/Eval
INSERT INTO cours VALUES (NULL, "CM 1", '/my-app/PETAL/Cours/Matiere 1/CM 1.pdf', 'CM', "Matiere 1");
INSERT INTO cours VALUES (NULL, "CM 2", '/my-app/PETAL/Cours/Matiere 1/CM 2.pdf', 'CM', "Matiere 1");
INSERT INTO cours VALUES (NULL, "CM 3", '/my-app/PETAL/Cours/Matiere 1/CM 3.pdf', 'CM', "Matiere 1");
INSERT INTO cours VALUES (NULL, "TD 1", '/my-app/PETAL/Cours/Matiere 1/TD 1.pdf', 'TD', "Matiere 1");
INSERT INTO cours VALUES (NULL, "TD 2", '/my-app/PETAL/Cours/Matiere 1/TD 2.pdf', 'TD', "Matiere 1");
INSERT INTO cours VALUES (NULL, "TP 1", '/my-app/PETAL/Cours/Matiere 1/TP 1.pdf', 'TP', "Matiere 1");