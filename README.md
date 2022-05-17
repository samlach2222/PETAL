<p align="center">
  <img src="https://user-images.githubusercontent.com/89837262/154356870-b1cdaffa-8b03-4cdb-bc8b-62310a50e182.svg" width="40%">
</p>

## Qu'est ce que PETAL ?

PETAL ou **Plateforme d'Education et Travail Accessible en Ligne** est le nom de notre projet de
Développement d’application Web. Ce projet de fin de 6ème semestre de faculté d’informatique prend forme
en groupe de 6 personne. Le projet est open-source et complètement libre de droit.

PETAL est codé de manière conventionnelle pour une application web :
- Pour la partie Front-End (partie visible par l’utilisateur) nous utilisons le trio HTML, CSS et JS.
- Pour la partie Back-End (partie invisible pour l’utilisateur) nous utilisons PHP en version 7.03
- Pour la base de données nous utilisons MySQL en version 5.7.11


Nous utilisons en plus de cela plusieurs autres technologies :
- JQuery, qui permet une utilisation plus facile de JavaScript dans quelques cas et…
- Ajax, qui nous permet de gérer des parties de la page de manière asynchrone.
- SweetAlert, un plugin pour JavaScript permettant de rendre plus belles les alertes montrées à
l’utilisateur

## Comment installer PETAL ?

PETAL est directement hebergé sur un serveur local UWAMP, celui-ci étant directement configuré dans ce repo GitHub
1) Téléchargez le site avec uwamp [ICI](https://github.com/samlach2222/PETAL/releases).
2) Récupérez l’un des deux scripts de remplissage de données (jeux de données) [ICI](https://github.com/samlach2222/PETAL/tree/main/BDD).  


"PETAL données de test.sql" → Jeu de données complet possédant plusieurs utilisateurs et de nombreuse donnée
![image](https://user-images.githubusercontent.com/44367571/168792345-b6424cc2-89c6-4974-9985-9f832dc81a91.png)

"PETAL base" → Jeu de données uniquement composé d’un administrateur possédant les identifiants suivants :
- Id : 1
- Nom : root
- Prenom : root
- Mail : root@mail.com
- MotDePasse : root

3) Lancez uwamp.exe et tapez `localhost` dans un navigateur
4) Cliquez sur phpMyAdmin

![image](https://user-images.githubusercontent.com/44367571/168792710-03dd20f2-0df3-4580-adc6-610106dc8ffd.png)

5) Connectez-vous à PhpMyAdmin en utilisant les identifiants par défaut : root root.
6) Cliquez sur SQL dans la barre de navigation de la page : 

![image](https://user-images.githubusercontent.com/44367571/168792817-65098ac0-62f7-46c7-a78c-ef6080d580af.png)

7) Copiez-collez le contenu du fichier SQL chargé dans le champ SQL puis cliquez sur "Exécuter"
8) Une fois l’exécution terminée, rendez-vous sur la page de connexion de PETAL et connectez-vous [ICI](http://localhost/my-app/PETAL/ALL/HTML/connexion.php).


## Membres du projet :

* **Dorian BARSONI** - [@DorianBarsoni](https://github.com/DorianBarsoni)
* **Zeina-Hélène AL-HALABI** - [@ZHAlHalabi](https://github.com/ZHAlHalabi)
* **Betul SENER** - [@BetulDSENER](https://github.com/BetulDSENER)
* **Orlane TISSERAND** - [@Orlane_TISSERAND](https://github.com/Orlane_TISSERAND)
* **Loïs PAZOLA** - [@Mahtwo](https://github.com/Mahtwo)
* **Samuel LACHAUD** - [@samlach2222](https://github.com/samlach2222)
