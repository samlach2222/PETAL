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
    idUtilisateur INT NOT NULL AUTO_INCREMENT,
    photoProfil LONGBLOB,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    adresseMail VARCHAR(75) NOT NULL,
    numeroTelephone VARCHAR(15),
    motDePasse VARCHAR(100) NOT NULL,
    PRIMARY KEY (idUtilisateur)
);

CREATE TABLE Administrateur (
    idAdministrateur INT NOT NULL,
    numAdministrateur INT NOT NULL,
    PRIMARY KEY (idAdministrateur),
    FOREIGN KEY (idAdministrateur) REFERENCES Utilisateur(idUtilisateur) ON DELETE CASCADE
);

CREATE TABLE Etudiant (
    idEtudiant INT NOT NULL,
    numEtudiant INT NOT NULL,
    PRIMARY KEY (idEtudiant),
    FOREIGN KEY (idEtudiant) REFERENCES Utilisateur(idUtilisateur) ON DELETE CASCADE
);

CREATE TABLE Matiere (
    nomMatiere VARCHAR(50) NOT NULL,
    image LONGBLOB,
    idAdministrateur INT NOT NULL,
    PRIMARY KEY(nomMatiere),
    FOREIGN KEY(idAdministrateur) REFERENCES Administrateur(idAdministrateur) ON DELETE CASCADE
);

CREATE TABLE MoyenneEtuMatiere (
    idEtudiant INT NOT NULL AUTO_INCREMENT,
    nomMatiere VARCHAR(50) NOT NULL,
    moyenne DECIMAL(4,2),
    PRIMARY KEY(idEtudiant, nomMatiere),
    FOREIGN KEY(idEtudiant) REFERENCES Etudiant(idEtudiant) ON DELETE CASCADE,
    FOREIGN KEY(nomMatiere) REFERENCES Matiere(nomMatiere) ON DELETE CASCADE
);

CREATE TABLE SujetForum (
    nomSujet VARCHAR(50) NOT NULL,
    nomMatiere VARCHAR(50) NOT NULL,
    resolu BOOLEAN NOT NULL DEFAULT false,
    PRIMARY KEY (nomSujet),
    FOREIGN KEY (nomMatiere) REFERENCES Matiere(nomMatiere) ON DELETE CASCADE
);

CREATE TABLE MessageForum (
    idMessage INT NOT NULL AUTO_INCREMENT,
    contenuMessage VARCHAR(2000) NOT NULL,
    dateHeure DATETIME NOT NULL,
    nomSujet VARCHAR(50) NOT NULL,
    idEtudiant INT NOT NULL,
    PRIMARY KEY (idMessage),
    FOREIGN KEY (nomSujet) REFERENCES SujetForum(nomSujet) ON DELETE CASCADE,
    FOREIGN KEY (idEtudiant) REFERENCES Etudiant(idEtudiant) ON DELETE CASCADE
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
    idEtudiant INT NOT NULL AUTO_INCREMENT,
    nomQCM VARCHAR(50) NOT NULL,
    noteExam DECIMAL(4,2),
    PRIMARY KEY(idEtudiant, nomQCM),
    FOREIGN KEY(idEtudiant) REFERENCES Etudiant(idEtudiant) ON DELETE CASCADE,
    FOREIGN KEY(nomQCM) REFERENCES QCM(nomQCM) ON DELETE CASCADE
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
    idEtudiant INT NOT NULL,
    idQuestion INT NOT NULL,
    reponseChoisie VARCHAR(7),
    reponseJuste BOOLEAN,
    PRIMARY KEY (idEtudiant, idQuestion),
    FOREIGN KEY (idEtudiant) REFERENCES Etudiant(idEtudiant) ON DELETE CASCADE,
    FOREIGN KEY (idQuestion) REFERENCES Question(idQuestion) ON DELETE CASCADE
);
