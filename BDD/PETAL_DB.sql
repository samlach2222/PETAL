-- Initialisation de la base de données
DROP DATABASE IF EXISTS PETAL_DB;
CREATE DATABASE PETAL_DB;
USE PETAL_DB;

-- Destruction des tables si existantes
DROP TABLE IF EXISTS Utilisateur;
DROP TABLE IF EXISTS Matiere;
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

CREATE TABLE Matiere (
    nomMatiere VARCHAR(50) NOT NULL,
    image LONGBLOB,
    id INT NOT NULL,
    PRIMARY KEY(nomMatiere),
    FOREIGN KEY(id) REFERENCES Utilisateur(num) ON DELETE CASCADE
);

CREATE TABLE EtuMatiere (
    id INT NOT NULL,
    nomMatiere VARCHAR(50) NOT NULL,
    PRIMARY KEY (id, nomMatiere),
    FOREIGN KEY (id) REFERENCES Utilisateur(id) ON DELETE CASCADE,
    FOREIGN KEY (nomMatiere) REFERENCES Matiere(nomMatiere) ON DELETE CASCADE
);

CREATE TABLE SujetForum (
    idSujetForum INT NOT NULL AUTO_INCREMENT,
    nomSujet VARCHAR(50) NOT NULL,
    resolu BOOLEAN NOT NULL DEFAULT false,
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
    idSujetForum INT NOT NULL,
    id INT NOT NULL,
    PRIMARY KEY (idMessage),
    FOREIGN KEY (idSujetForum) REFERENCES SujetForum(idSujetForum) ON DELETE CASCADE,
    FOREIGN KEY (id) REFERENCES Utilisateur(num) ON DELETE CASCADE
);

CREATE TABLE Cours (
    idCours INT NOT NULL AUTO_INCREMENT,
    nomCours VARCHAR(50) NOT NULL,
    fichier VARCHAR(2083) NOT NULL,
    typeCours ENUM('CM','TD','TP') NOT NULL,
    nomMatiere VARCHAR(50) NOT NULL,
    PRIMARY KEY (idCours),
    FOREIGN KEY (nomMatiere) REFERENCES Matiere(nomMatiere) ON DELETE CASCADE
);

CREATE TABLE QCM (
    idQCM INT NOT NULL AUTO_INCREMENT,
    nomQCM VARCHAR(50) NOT NULL,
    dateHeureFin DATETIME,
    evalue BOOLEAN NOT NULL,
    publie BOOLEAN NOT NULL DEFAULT false,
    nomMatiere VARCHAR(50) NOT NULL,
    PRIMARY KEY (idQCM),
    FOREIGN KEY (nomMatiere) REFERENCES Matiere(nomMatiere) ON DELETE CASCADE
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
    reponseALaQuestion VARCHAR(7) NOT NULL,
    idQCM INT NOT NULL,
    PRIMARY KEY (idQuestion),
    FOREIGN KEY (idQCM) REFERENCES QCM(idQCM) ON DELETE CASCADE
);

CREATE TABLE ReponseDeEtudiant (
    id INT NOT NULL,
    idQuestion INT NOT NULL,
    reponseChoisie VARCHAR(7),
    reponseJuste BOOLEAN NOT NULL,
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
