-- Initialisation de la base de données
DROP DATABASE IF EXISTS PETAL_DB;
CREATE DATABASE PETAL_DB;
USE PETAL_DB;

-- Destruction des tables si existantes
DROP TABLE IF EXISTS Utilisateur;
DROP TABLE IF EXISTS Administrateur;
DROP TABLE IF EXISTS Etudiant;
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
    id INT NOT NULL AUTO_INCREMENT,
    photoProfil LONGBLOB,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    adresseMail VARCHAR(75) NOT NULL,
    numeroTelephone VARCHAR(15),
    motDePasse VARCHAR(100) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE Administrateur (
    idAdmin INT NOT NULL,
    numAdministrateur INT NOT NULL,
    PRIMARY KEY (idAdmin),
    FOREIGN KEY (idAdmin) REFERENCES Utilisateur(id) ON DELETE CASCADE
);

CREATE TABLE Etudiant (
    idEtu INT NOT NULL,
    numEtudiant INT NOT NULL,
    PRIMARY KEY (idEtu),
    FOREIGN KEY (idEtu) REFERENCES Utilisateur(id) ON DELETE CASCADE
);

CREATE TABLE Matiere (
    nomMatiere VARCHAR(50) NOT NULL,
    image LONGBLOB,
    idAdmin INT NOT NULL,
    PRIMARY KEY(nomMatiere),
    FOREIGN KEY(idAdmin) REFERENCES Administrateur(idAdmin) ON DELETE CASCADE
);

CREATE TABLE EtuMatiere (
    idEtu INT NOT NULL,
    nomMatiere VARCHAR(50) NOT NULL,
    PRIMARY KEY (idEtu, nomMatiere),
    FOREIGN KEY (idEtu) REFERENCES Etudiant(idEtu) ON DELETE CASCADE,
    FOREIGN KEY (nomMatiere) REFERENCES Matiere(nomMatiere) ON DELETE CASCADE
);

CREATE TABLE SujetForum (
    idSujetForum INT NOT NULL AUTO_INCREMENT,
    nomSujet VARCHAR(50) NOT NULL,
    resolu BOOLEAN NOT NULL DEFAULT false,
    nomMatiere VARCHAR(50) NOT NULL,
    idEtu INT NOT NULL,
    PRIMARY KEY (idSujetForum),
    FOREIGN KEY (nomMatiere) REFERENCES Matiere(nomMatiere) ON DELETE CASCADE,
    FOREIGN KEY (idEtu) REFERENCES Etudiant(idEtu) ON DELETE CASCADE
);

CREATE TABLE MessageForum (
    idMessage INT NOT NULL AUTO_INCREMENT,
    contenuMessage VARCHAR(2000) NOT NULL,
    dateHeure DATETIME NOT NULL,
    idSujetForum INT NOT NULL,
    idEtu INT NOT NULL,
    PRIMARY KEY (idMessage),
    FOREIGN KEY (idSujetForum) REFERENCES SujetForum(idSujetForum) ON DELETE CASCADE,
    FOREIGN KEY (idEtu) REFERENCES Etudiant(idEtu) ON DELETE CASCADE
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
    moyenne DECIMAL(4,2),
    publie BOOLEAN NOT NULL DEFAULT false,
    nomMatiere VARCHAR(50) NOT NULL,
    PRIMARY KEY (idQCM),
    FOREIGN KEY (nomMatiere) REFERENCES Matiere(nomMatiere) ON DELETE CASCADE
);

CREATE TABLE ResultatEtudiant (
    idEtu INT NOT NULL,
    idQCM INT NOT NULL,
    noteExamen DECIMAL(4,2),
    PRIMARY KEY(idEtu, idQCM),
    FOREIGN KEY(idEtu) REFERENCES Etudiant(idEtu) ON DELETE CASCADE,
    FOREIGN KEY(idQCM) REFERENCES QCM(idQCM) ON DELETE CASCADE
);

CREATE TABLE Question (
    idQuestion INT NOT NULL AUTO_INCREMENT,
    intitulé VARCHAR(200) NOT NULL,
    image LONGBLOB,
    reponseALaQuestion VARCHAR(90) NOT NULL,
    idQCM INT NOT NULL,
    PRIMARY KEY (idQuestion),
    FOREIGN KEY (idQCM) REFERENCES QCM(idQCM) ON DELETE CASCADE
);

CREATE TABLE ReponseDeEtudiant (
    idEtu INT NOT NULL,
    idQuestion INT NOT NULL,
    reponseChoisie VARCHAR(7),
    reponseJuste BOOLEAN NOT NULL,
    PRIMARY KEY (idEtu, idQuestion),
    FOREIGN KEY (idEtu) REFERENCES Etudiant(idEtu) ON DELETE CASCADE,
    FOREIGN KEY (idQuestion) REFERENCES Question(idQuestion) ON DELETE CASCADE
);

CREATE VIEW MoyenneEtuMatiere AS
  SELECT idEtu, SUM(noteExamen)/COUNT(noteExamen), nomMatiere
  FROM ResultatEtudiant NATURAL JOIN QCM
  WHERE 1 = 1;
