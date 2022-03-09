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
    numAdministrateur INT NOT NULL,
    id INT NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (id) REFERENCES Utilisateur(id)
);

CREATE TABLE Etudiant (
    id INT NOT NULL,
    numEtudiant INT NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (id) REFERENCES Utilisateur(id)
);

CREATE TABLE Matiere (
    nomMatiere VARCHAR(50) NOT NULL,
    image LONGBLOB,
    numAdministrateur INT NOT NULL,
    id INT NOT NULL,
    PRIMARY KEY(nomMatiere),
    FOREIGN KEY(numAdministrateur) REFERENCES Administrateur(numAdministrateur),
    FOREIGN KEY(id) REFERENCES Utilisateur(id)
);

CREATE TABLE MoyenneEtuMatiere (
    id INT NOT NULL AUTO_INCREMENT,
    nomMatiere VARCHAR(50) NOT NULL,
    moyenne DECIMAL(4,2),
    PRIMARY KEY(id, nomMatiere),
    FOREIGN KEY(id) REFERENCES Utilisateur(id),
    FOREIGN KEY(nomMatiere) REFERENCES Matiere(nomMatiere)
);

CREATE TABLE SujetForum (
    nomSujet VARCHAR(50) NOT NULL,
    nomMatiere VARCHAR(50) NOT NULL,
    PRIMARY KEY (nomSujet),
    FOREIGN KEY (nomMatiere) REFERENCES Matiere(nomMatiere)
);

CREATE TABLE MessageForum (
    idMessage INT NOT NULL AUTO_INCREMENT,
    contenuMessage VARCHAR(2000) NOT NULL,
    dateHeure DATETIME NOT NULL,
    nomSujet VARCHAR(50) NOT NULL,
    id INT NOT NULL,
    PRIMARY KEY (idMessage),
    FOREIGN KEY (nomSujet) REFERENCES SujetForum(nomSujet),
    FOREIGN KEY (id) REFERENCES Utilisateur(id)
);

CREATE TABLE Cours (
    nomCours VARCHAR(50) NOT NULL,
    fichier VARCHAR(2083) NOT NULL,
    nomMatiere VARCHAR(50) NOT NULL,
    typeCours VARCHAR(2) NOT NULL CHECK (typeCours="CM"| typeCours="TD" | typeCours="TP"),
    PRIMARY KEY (nomCours),
    FOREIGN KEY (nomMatiere) REFERENCES Matiere(nomMatiere)
);

CREATE TABLE QCM (
    nomQCM VARCHAR(50) NOT NULL,
    nomMatiere VARCHAR(50) NOT NULL,
    dateHeureFin DATETIME,
    evalue BOOL NOT NULL,
    moyenne DECIMAL(4,2),
    nomCours VARCHAR(50),
    PRIMARY KEY (nomQCM),
    FOREIGN KEY (nomMatiere) REFERENCES Matiere(nomMatiere),
    FOREIGN KEY (nomCours) REFERENCES Cours(nomCours)
);

CREATE TABLE ResultatEtudiant (
    id INT NOT NULL AUTO_INCREMENT,
    nomQCM VARCHAR(50) NOT NULL,
    noteExam DECIMAL(4,2),
    PRIMARY KEY(id, nomQCM),
    FOREIGN KEY(id) REFERENCES Utilisateur(id),
    FOREIGN KEY(nomQCM) REFERENCES QCM(nomQCM)
);

CREATE TABLE Question (
    idQuestion INT NOT NULL AUTO_INCREMENT,
    intitulé VARCHAR(200) NOT NULL,
    image LONGBLOB,
    reponseALaQuestion VARCHAR(90) NOT NULL,
    nomQCM VARCHAR(50) NOT NULL,
    PRIMARY KEY (idQuestion),
    FOREIGN KEY (nomQCM) REFERENCES QCM(nomQCM)
);

CREATE TABLE ReponseDeEtudiant (
    id INT NOT NULL,
    idQuestion INT NOT NULL,
    reponseChoisie VARCHAR(7),
    reponseJuste BOOL,
    PRIMARY KEY (id, idQuestion),
    FOREIGN KEY id REFERENCES Etudiant(id),
    FOREIGN KEY idQuestion REFERENCES Question(idQuestion)
);
