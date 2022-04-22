-- Initialisation de la base de données
DROP DATABASE IF EXISTS PETAL_DB;
CREATE DATABASE PETAL_DB;
USE PETAL_DB;

-- Destruction des tables si existantes
DROP TABLE IF EXISTS Utilisateur;
DROP TABLE IF EXISTS Administrateur;
DROP TABLE IF EXISTS Etudiant;
DROP TABLE IF EXISTS Matiere;
DROP TABLE IF EXISTS MoyenneEtuMatiere;
DROP TABLE IF EXISTS SujetForum;
DROP TABLE IF EXISTS MessageForum;
DROP TABLE IF EXISTS Cours;
DROP TABLE IF EXISTS QCM;
DROP TABLE IF EXISTS ResultatEtudiant;
DROP TABLE IF EXISTS Question;
DROP TABLE IF EXISTS ReponseDeEtudiant;

-- Creation des tables
CREATE TABLE Utilisateur (
    num INT NOT NULL,
    admin BOOLEAN NOT NULL DEFAULT false,
    photoProfil LONGBLOB,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    adresseMail VARCHAR(75) NOT NULL,
    numeroTelephone VARCHAR(15),
    motDePasse VARCHAR(100) NOT NULL,
    PRIMARY KEY (num)
);

CREATE TABLE Administrateur (
    numAdministrateur INT NOT NULL,
    id INT NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (id) REFERENCES Utilisateur(id) ON DELETE CASCADE
);

CREATE TABLE Etudiant (
    id INT NOT NULL,
    numEtudiant INT NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (id) REFERENCES Utilisateur(id) ON DELETE CASCADE
);

CREATE TABLE Matiere (
    nomMatiere VARCHAR(50) NOT NULL,
    image LONGBLOB,
    id INT NOT NULL,
    PRIMARY KEY(nomMatiere),
    FOREIGN KEY(id) REFERENCES Utilisateur(num) ON DELETE CASCADE
);

CREATE TABLE MoyenneEtuMatiere (
    id INT NOT NULL AUTO_INCREMENT,
    nomMatiere VARCHAR(50) NOT NULL,
    moyenne DECIMAL(4,2),
    PRIMARY KEY(id, nomMatiere),
    FOREIGN KEY(id) REFERENCES Utilisateur(id) ON DELETE CASCADE,
    FOREIGN KEY(nomMatiere) REFERENCES Matiere(nomMatiere) ON DELETE CASCADE
);

CREATE TABLE SujetForum (
    nomSujet VARCHAR(50) NOT NULL,
    nomMatiere VARCHAR(50) NOT NULL,
    id INT NOT NULL,
    PRIMARY KEY (idSujetForum),
    FOREIGN KEY (nomMatiere) REFERENCES Matiere(nomMatiere) ON DELETE CASCADE,
    FOREIGN KEY (id) REFERENCES Utilisateur(num) ON DELETE CASCADE
);

CREATE TABLE MessageForum (
    idMessage INT NOT NULL AUTO_INCREMENT,
    contenuMessage VARCHAR(2000) NOT NULL,
    dateHeure DATETIME NOT NULL,
    nomSujet VARCHAR(50) NOT NULL,
    id INT NOT NULL,
    PRIMARY KEY (idMessage),
    FOREIGN KEY (idSujetForum) REFERENCES SujetForum(idSujetForum) ON DELETE CASCADE,
    FOREIGN KEY (id) REFERENCES Utilisateur(num) ON DELETE CASCADE
);

CREATE TABLE Cours (
    nomCours VARCHAR(50) NOT NULL,
    fichier VARCHAR(2083) NOT NULL,
    nomMatiere VARCHAR(50) NOT NULL,
    typeCours ENUM('CM','TD','TP') NOT NULL,
    PRIMARY KEY (nomCours),
    FOREIGN KEY (nomMatiere) REFERENCES Matiere(nomMatiere) ON DELETE CASCADE
);

CREATE TABLE QCM (
    nomQCM VARCHAR(50) NOT NULL,
    nomMatiere VARCHAR(50) NOT NULL,
    dateHeureFin DATETIME,
    evalue BOOLEAN NOT NULL,
    moyenne DECIMAL(4,2),
    nomCours VARCHAR(50),
    PRIMARY KEY (nomQCM),
    FOREIGN KEY (nomMatiere) REFERENCES Matiere(nomMatiere) ON DELETE CASCADE,
    FOREIGN KEY (nomCours) REFERENCES Cours(nomCours) ON DELETE CASCADE
);

CREATE TABLE ResultatEtudiant (
    id INT NOT NULL,
    idQCM INT NOT NULL,
    noteExamen DECIMAL(4,2),
    PRIMARY KEY(id, idQCM),
    FOREIGN KEY(id) REFERENCES Utilisateur(num) ON DELETE CASCADE,
    FOREIGN KEY(idQCM) REFERENCES QCM(idQCM) ON DELETE CASCADE
);

CREATE TABLE Question (
    idQuestion INT NOT NULL AUTO_INCREMENT,
    intitulé VARCHAR(200) NOT NULL,
    image LONGBLOB,
    reponseALaQuestion VARCHAR(90) NOT NULL,
    nomQCM VARCHAR(50) NOT NULL,
    PRIMARY KEY (idQuestion),
    FOREIGN KEY (nomQCM) REFERENCES QCM(nomQCM) ON DELETE CASCADE
);

CREATE TABLE ReponseDeEtudiant (
    id INT NOT NULL,
    idQuestion INT NOT NULL,
    reponseChoisie VARCHAR(7),
    reponseJuste BOOLEAN,
    PRIMARY KEY (id, idQuestion),
    FOREIGN KEY (id) REFERENCES Utilisateur(num) ON DELETE CASCADE,
    FOREIGN KEY (idQuestion) REFERENCES Question(idQuestion) ON DELETE CASCADE
);

CREATE VIEW MoyenneEtuMatiere AS
    SELECT ResultatEtudiant.id, nom, prenom, ROUND(SUM(noteExamen)/COUNT(noteExamen), 2) AS moyenne, nomMatiere
    FROM QCM NATURAL JOIN ResultatEtudiant LEFT JOIN Utilisateur ON ResultatEtudiant.id = Utilisateur.num
    GROUP BY id;

CREATE VIEW MoyenneQCM AS
    SELECT idQCM, nomQCM, ROUND(SUM(noteExamen)/COUNT(noteExamen), 2) AS moyenne, nomMatiere
    FROM QCM NATURAL JOIN ResultatEtudiant
    GROUP BY idQCM;


-- Initialisation de la fonction IsAdmin
DROP FUNCTION IF EXISTS IsAdmin;
DELIMITER $$
CREATE FUNCTION IsAdmin(p_id INT) RETURNS tinyint(1)
BEGIN
    RETURN (SELECT admin FROM Utilisateur WHERE num = p_id);
END$$
DELIMITER ;

-- Creation des triggers pour vérifier que l'utilisateur est ou n'est pas un admin
DROP TRIGGER IF EXISTS trigger_matiere_admin_insert;
delimiter $$
CREATE TRIGGER trigger_matiere_admin_insert BEFORE INSERT
ON matiere
FOR EACH ROW
IF IsAdmin(NEW.id) != 1 THEN
    SIGNAL SQLSTATE '50001' SET MESSAGE_TEXT = 'Un étudiant ne peut pas gérer une matière';
END IF; $$
delimiter ;

DROP TRIGGER IF EXISTS trigger_matiere_admin_insert;
delimiter $$
CREATE TRIGGER trigger_matiere_admin_insert BEFORE UPDATE
ON matiere
FOR EACH ROW
IF IsAdmin(NEW.id) != 1 THEN
    SIGNAL SQLSTATE '50001' SET MESSAGE_TEXT = 'Un étudiant ne peut pas gérer une matière';
END IF; $$
delimiter ;
