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
    num INT NOT NULL,
    admin BOOLEAN NOT NULL DEFAULT false,
    photoProfil MEDIUMBLOB,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    adresseMail VARCHAR(75) NOT NULL,
    numeroTelephone VARCHAR(15),
    motDePasse VARCHAR(100) NOT NULL,
    PRIMARY KEY (num)
);

CREATE TABLE Matiere (
    nomMatiere VARCHAR(50) NOT NULL,
    image MEDIUMBLOB,
    num INT NOT NULL,
    PRIMARY KEY(nomMatiere),
    FOREIGN KEY(num) REFERENCES Utilisateur(num) ON DELETE CASCADE
);

CREATE TABLE EtuMatiere (
    num INT NOT NULL,
    nomMatiere VARCHAR(50) NOT NULL,
    PRIMARY KEY (num, nomMatiere),
    FOREIGN KEY (num) REFERENCES Utilisateur(num) ON DELETE CASCADE,
    FOREIGN KEY (nomMatiere) REFERENCES Matiere(nomMatiere) ON DELETE CASCADE
);

CREATE TABLE SujetForum (
    idSujetForum INT NOT NULL AUTO_INCREMENT,
    nomSujet VARCHAR(50) NOT NULL,
    resolu BOOLEAN NOT NULL DEFAULT false,
    nomMatiere VARCHAR(50) NOT NULL,
    num INT NOT NULL,
    PRIMARY KEY (idSujetForum),
    FOREIGN KEY (nomMatiere) REFERENCES Matiere(nomMatiere),
    FOREIGN KEY (num) REFERENCES Utilisateur(num)
);

CREATE TABLE MessageForum (
    idMessage INT NOT NULL AUTO_INCREMENT,
    contenuMessage VARCHAR(2000) NOT NULL,
    dateHeure DATETIME NOT NULL,
    idSujetForum INT NOT NULL,
    num INT NOT NULL,
    PRIMARY KEY (idMessage),
    FOREIGN KEY (idSujetForum) REFERENCES SujetForum(idSujetForum) ON DELETE CASCADE,
    FOREIGN KEY (num) REFERENCES Utilisateur(num) ON DELETE CASCADE
);

CREATE TABLE Cours (
    idCours INT NOT NULL AUTO_INCREMENT,
    nomCours VARCHAR(50) NOT NULL,
    fichier VARCHAR(512) NOT NULL,
    typeCours ENUM('CM','TD','TP') NOT NULL,
    nomMatiere VARCHAR(50) NOT NULL,
    PRIMARY KEY (idCours),
    FOREIGN KEY (nomMatiere) REFERENCES Matiere(nomMatiere)
);

CREATE TABLE QCM (
    idQCM INT NOT NULL AUTO_INCREMENT,
    nomQCM VARCHAR(50) NOT NULL,
    dateHeureFin DATETIME,
    evalue BOOLEAN NOT NULL,
    publie BOOLEAN NOT NULL DEFAULT false,
    nomMatiere VARCHAR(50) NOT NULL,
    PRIMARY KEY (idQCM),
    FOREIGN KEY (nomMatiere) REFERENCES Matiere(nomMatiere)
);

CREATE TABLE Question (
    idQuestion INT NOT NULL AUTO_INCREMENT,
    intitulé VARCHAR(300) NOT NULL,
    image MEDIUMBLOB,
    reponseALaQuestion TINYINT NOT NULL,
    choix1 VARCHAR(150) NOT NULL,
    choix2 VARCHAR(150) NOT NULL,
    choix3 VARCHAR(150) NOT NULL,
    idQCM INT NOT NULL,
    PRIMARY KEY (idQuestion),
    FOREIGN KEY (idQCM) REFERENCES QCM(idQCM) ON DELETE CASCADE
);

CREATE TABLE ReponseDeEtudiant (
    num INT NOT NULL,
    idQuestion INT NOT NULL,
    reponseChoisie TINYINT,
    PRIMARY KEY (num, idQuestion),
    FOREIGN KEY (num) REFERENCES Utilisateur(num) ON DELETE CASCADE,
    FOREIGN KEY (idQuestion) REFERENCES Question(idQuestion) ON DELETE CASCADE
);

CREATE VIEW ResultatEtudiant AS
    SELECT idQCM, num, nomQCM, nomMatiere, ROUND((nombreReponsesCorrectes/COUNT(*))*20,2) AS moyenne
    FROM qcm NATURAL JOIN question NATURAL JOIN reponsedeetudiant NATURAL JOIN (
        SELECT idQCM, num, COUNT(*) AS nombreReponsesCorrectes
        FROM qcm NATURAL JOIN question NATURAL JOIN reponsedeetudiant
        WHERE reponseALaQuestion = reponseChoisie
        GROUP BY idQCM, num
    ) AS TableNombreReponsesCorrectes
    GROUP BY idQCM, num;

CREATE VIEW MoyenneEtuMatiere AS
    SELECT num, nom, prenom, nomMatiere, ROUND(SUM(moyenne)/COUNT(moyenne),2) AS moyenne
    FROM resultatetudiant NATURAL JOIN utilisateur
    GROUP BY num;

CREATE VIEW MoyenneQCM AS
    SELECT idQCM, nomQCM, nomMatiere, ROUND(SUM(moyenne)/COUNT(moyenne),2) AS moyenne
    FROM resultatetudiant
    GROUP BY idQCM;

CREATE VIEW ListeSujets AS
    SELECT idSujetForum, nomSujet, nom, prenom, nbMessages, resolu, nomMatiere
    FROM sujetforum NATURAL JOIN (
        SELECT idSujetForum, COUNT(*) AS nbMessages
        FROM messageforum
        GROUP BY idSujetForum
    ) AS tableNbMessages NATURAL JOIN utilisateur;

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
