-- Initialisation de la base de données
DROP DATABASE IF EXISTS PETAL_DB;
CREATE DATABASE PETAL_DB;
USE PETAL_DB;

-- Destruction des tables si existantes
DROP TABLE IF EXISTS Utilisateur;
DROP TABLE IF EXISTS Matiere;
DROP TABLE IF EXISTS EtuMatiere;
DROP TABLE IF EXISTS SujetForum;
DROP TABLE IF EXISTS MessageForum;
DROP TABLE IF EXISTS Cours;
DROP TABLE IF EXISTS QCM;
DROP TABLE IF EXISTS Question;
DROP TABLE IF EXISTS ReponseDeEtudiant;

-- Creation des tables
CREATE TABLE Utilisateur (
    num INT UNSIGNED NOT NULL,
    admin BOOLEAN NOT NULL DEFAULT false,
    photoProfil MEDIUMBLOB,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    adresseMail VARCHAR(75) NOT NULL UNIQUE,
    numeroTelephone VARCHAR(15) UNIQUE,
    motDePasse VARCHAR(255) NOT NULL, /*Recommandé par PHP pour être hachage futur-proof*/
    PRIMARY KEY (num)
);

CREATE TABLE Matiere (
    nomMatiere VARCHAR(50) NOT NULL,
    image MEDIUMBLOB,
    num INT UNSIGNED NOT NULL,
    PRIMARY KEY(nomMatiere),
    FOREIGN KEY(num) REFERENCES Utilisateur(num) ON DELETE CASCADE
);

CREATE TABLE EtuMatiere (
    num INT UNSIGNED NOT NULL,
    nomMatiere VARCHAR(50) NOT NULL,
    PRIMARY KEY (num, nomMatiere),
    FOREIGN KEY (num) REFERENCES Utilisateur(num) ON DELETE CASCADE,
    FOREIGN KEY (nomMatiere) REFERENCES Matiere(nomMatiere) ON DELETE CASCADE
);

CREATE TABLE SujetForum (
    idSujetForum INT UNSIGNED NOT NULL AUTO_INCREMENT,
    nomSujet VARCHAR(50) NOT NULL,
    resolu BOOLEAN NOT NULL DEFAULT false,
    nomMatiere VARCHAR(50) NOT NULL,
    num INT UNSIGNED,
    PRIMARY KEY (idSujetForum),
    FOREIGN KEY (nomMatiere) REFERENCES Matiere(nomMatiere) ON DELETE CASCADE,
    FOREIGN KEY (num) REFERENCES Utilisateur(num)
);

CREATE TABLE MessageForum (
    idMessage INT UNSIGNED NOT NULL AUTO_INCREMENT,
    contenuMessage VARCHAR(2000) NOT NULL,
    dateHeure DATETIME NOT NULL,
    idSujetForum INT UNSIGNED NOT NULL,
    num INT UNSIGNED,
    PRIMARY KEY (idMessage),
    FOREIGN KEY (idSujetForum) REFERENCES SujetForum(idSujetForum) ON DELETE CASCADE,
    FOREIGN KEY (num) REFERENCES Utilisateur(num)
);

CREATE TABLE Cours (
    idCours INT UNSIGNED NOT NULL AUTO_INCREMENT,
    nomCours VARCHAR(50) NOT NULL,
    fichier VARCHAR(512) NOT NULL,
    typeCours ENUM('CM','TD','TP') NOT NULL,
    nomMatiere VARCHAR(50) NOT NULL,
    PRIMARY KEY (idCours),
    FOREIGN KEY (nomMatiere) REFERENCES Matiere(nomMatiere) ON DELETE CASCADE
);

CREATE TABLE QCM (
    idQCM INT UNSIGNED NOT NULL AUTO_INCREMENT,
    nomQCM VARCHAR(50) NOT NULL,
    dateHeureFin DATETIME,
    publie BOOLEAN NOT NULL DEFAULT false,
    nomMatiere VARCHAR(50) NOT NULL,
    PRIMARY KEY (idQCM),
    FOREIGN KEY (nomMatiere) REFERENCES Matiere(nomMatiere) ON DELETE CASCADE
);

CREATE TABLE Question (
    idQuestion INT UNSIGNED NOT NULL AUTO_INCREMENT,
    intitulé VARCHAR(300) NOT NULL,
    image MEDIUMBLOB,
    reponseALaQuestion TINYINT NOT NULL,
    choix1 VARCHAR(150) NOT NULL,
    choix2 VARCHAR(150) NOT NULL,
    choix3 VARCHAR(150) NOT NULL,
    idQCM INT UNSIGNED NOT NULL,
    PRIMARY KEY (idQuestion),
    FOREIGN KEY (idQCM) REFERENCES QCM(idQCM) ON DELETE CASCADE
);

CREATE TABLE ReponseDeEtudiant (
    num INT UNSIGNED NOT NULL,
    idQuestion INT UNSIGNED NOT NULL,
    reponseChoisie TINYINT,
    PRIMARY KEY (num, idQuestion),
    FOREIGN KEY (num) REFERENCES Utilisateur(num) ON DELETE CASCADE,
    FOREIGN KEY (idQuestion) REFERENCES Question(idQuestion) ON DELETE CASCADE
);

CREATE VIEW ResultatEtudiant AS
    SELECT idQCM, num, nomQCM, nomMatiere, ROUND((nombreReponsesCorrectes/nombreQuestions)*20,2) AS moyenne
    FROM (
        SELECT TableTousLesReponses.idQCM, TableTousLesReponses.num, COALESCE(reponsesCorrectes, 0) AS nombreReponsesCorrectes
        FROM (
            SELECT * FROM reponsedeetudiant NATURAL JOIN question
        ) AS TableTousLesReponses LEFT JOIN (
            SELECT idQCM, num, COUNT(*) AS reponsesCorrectes
            FROM reponsedeetudiant NATURAL JOIN question
            WHERE reponseALaQuestion = reponseChoisie
            GROUP BY idQCM, num
        ) AS TableNombreReponsesCorrectes ON (TableTousLesReponses.idQCM = TableNombreReponsesCorrectes.idQCM && TableTousLesReponses.num = TableNombreReponsesCorrectes.num)
        GROUP BY TableTousLesReponses.idQCM, TableTousLesReponses.num
    ) AS TableNombreReponsesCorrectes NATURAL JOIN (
        SELECT idQCM, num, nomQCM, nomMatiere, COUNT(*) AS nombreQuestions
        FROM qcm NATURAL JOIN question NATURAL JOIN reponsedeetudiant
        WHERE publie = true
        GROUP BY idQCM, num
    ) AS TableNombreQuestions;

CREATE VIEW MoyenneEtuMatiere AS
    SELECT num, nom, prenom, nomMatiere, ROUND(SUM(moyenne)/COUNT(moyenne),2) AS moyenne
    FROM resultatetudiant NATURAL JOIN utilisateur
    GROUP BY num;

CREATE VIEW MoyenneQCM AS
    SELECT idQCM, nomQCM, nomMatiere, ROUND(SUM(moyenne)/COUNT(moyenne),2) AS moyenne
    FROM resultatetudiant
    GROUP BY idQCM;

CREATE VIEW ListeSujets AS
    SELECT idSujetForum, nomSujet, nom, prenom, nbMessages, resolu, nomMatiere, sujetforum.num
    FROM sujetforum NATURAL JOIN (
        SELECT idSujetForum, COUNT(*) AS nbMessages
        FROM messageforum
        GROUP BY idSujetForum
    ) AS tableNbMessages LEFT JOIN utilisateur ON sujetforum.num = utilisateur.num;

-- Initialisation de la fonction IsAdmin
DROP FUNCTION IF EXISTS IsAdmin;
DELIMITER $$
CREATE FUNCTION IsAdmin(p_num INT) RETURNS tinyint(1)
BEGIN
    RETURN (SELECT admin FROM Utilisateur WHERE num = p_num);
END$$
DELIMITER ;

-- Creation des triggers pour vérifier que l'utilisateur est ou n'est pas un admin
DROP TRIGGER IF EXISTS trigger_matiere_admin_insert;
delimiter $$
CREATE TRIGGER trigger_matiere_admin_insert BEFORE INSERT
ON matiere
FOR EACH ROW
IF IsAdmin(NEW.num) != 1 THEN
    SIGNAL SQLSTATE '50001' SET MESSAGE_TEXT = 'Un étudiant ne peut pas gérer une matière';
END IF; $$
delimiter ;

DROP TRIGGER IF EXISTS trigger_matiere_admin_update;
delimiter $$
CREATE TRIGGER trigger_matiere_admin_update BEFORE UPDATE
ON matiere
FOR EACH ROW
IF IsAdmin(NEW.num) != 1 THEN
    SIGNAL SQLSTATE '50001' SET MESSAGE_TEXT = 'Un étudiant ne peut pas gérer une matière';
END IF; $$
delimiter ;
