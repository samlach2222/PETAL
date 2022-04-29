USE PETAL_DB;  -- Utilise la base de données du projet

-- Supprime d'abord les tables n'ayant pas ON DELETE CASCADE
DELETE FROM sujetforum;
DELETE FROM cours;
DELETE FROM qcm;

DELETE FROM utilisateur;  -- Enlève toutes les tables restantes car elles sont "reliées" à utilisateur


-- Insertion des données
--Création prof & matières
INSERT INTO utilisateur VALUES (1, 1, NULL, "De Gaulle", "Charles", "charlesdegaulle@gmail.com", NULL, "123");
INSERT INTO matiere VALUES ('Matiere 1', NULL, 1);
INSERT INTO matiere VALUES ('Matiere 2', NULL, 1);
INSERT INTO matiere VALUES ('Matiere 3', NULL, 1);
INSERT INTO matiere VALUES ('Matiere 4', NULL, 1);
INSERT INTO matiere VALUES ('Matiere 5', NULL, 1);
INSERT INTO matiere VALUES ('Matiere 6', NULL, 1);
INSERT INTO matiere VALUES ('Matiere 7', NULL, 1);
INSERT INTO matiere VALUES ('Matiere 8', NULL, 1);

--Création étudiant & lien étudiant-matière
INSERT INTO utilisateur VALUES (2, 0, NULL, "Haubin", "Jacques", "jacqueshaubin@gmail.com", NULL, "123");
INSERT INTO etumatiere VALUES (2, "Matiere 1");
INSERT INTO etumatiere VALUES (2, "Matiere 2");
INSERT INTO etumatiere VALUES (2, "Matiere 3");
INSERT INTO etumatiere VALUES (2, "Matiere 4");
INSERT INTO etumatiere VALUES (2, "Matiere 5");
INSERT INTO etumatiere VALUES (2, "Matiere 6");
INSERT INTO etumatiere VALUES (2, "Matiere 7");
INSERT INTO etumatiere VALUES (2, "Matiere 8");

--Création des CM-TD-TP-QCM-Evaluations Matière 1
INSERT INTO cours VALUES (NULL, "CM 1", ..., "Matiere 1")

SELECT nomsCours FROM cours WHERE nomMatiere=$nomMatiere ! AND typeCours='CM';