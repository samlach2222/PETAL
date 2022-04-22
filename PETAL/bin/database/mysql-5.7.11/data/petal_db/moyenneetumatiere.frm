TYPE=VIEW
query=select `petal_db`.`resultatetudiant`.`num` AS `num`,`petal_db`.`utilisateur`.`nom` AS `nom`,`petal_db`.`utilisateur`.`prenom` AS `prenom`,round((sum(`petal_db`.`resultatetudiant`.`noteExamen`) / count(`petal_db`.`resultatetudiant`.`noteExamen`)),2) AS `moyenne`,`petal_db`.`qcm`.`nomMatiere` AS `nomMatiere` from ((`petal_db`.`qcm` join `petal_db`.`resultatetudiant` on((`petal_db`.`qcm`.`idQCM` = `petal_db`.`resultatetudiant`.`idQCM`))) left join `petal_db`.`utilisateur` on((`petal_db`.`resultatetudiant`.`num` = `petal_db`.`utilisateur`.`num`))) group by `petal_db`.`resultatetudiant`.`num`
md5=84e02c71e157e2a9204cad3873775e55
updatable=0
algorithm=0
definer_user=root
definer_host=localhost
suid=2
with_check_option=0
timestamp=2022-04-22 14:07:37
create-version=1
source=SELECT ResultatEtudiant.num, nom, prenom, ROUND(SUM(noteExamen)/COUNT(noteExamen), 2) AS moyenne, nomMatiere\n    FROM QCM NATURAL JOIN ResultatEtudiant LEFT JOIN Utilisateur ON ResultatEtudiant.num = Utilisateur.num\n    GROUP BY num
client_cs_name=utf8mb4
connection_cl_name=utf8mb4_unicode_ci
view_body_utf8=select `petal_db`.`resultatetudiant`.`num` AS `num`,`petal_db`.`utilisateur`.`nom` AS `nom`,`petal_db`.`utilisateur`.`prenom` AS `prenom`,round((sum(`petal_db`.`resultatetudiant`.`noteExamen`) / count(`petal_db`.`resultatetudiant`.`noteExamen`)),2) AS `moyenne`,`petal_db`.`qcm`.`nomMatiere` AS `nomMatiere` from ((`petal_db`.`qcm` join `petal_db`.`resultatetudiant` on((`petal_db`.`qcm`.`idQCM` = `petal_db`.`resultatetudiant`.`idQCM`))) left join `petal_db`.`utilisateur` on((`petal_db`.`resultatetudiant`.`num` = `petal_db`.`utilisateur`.`num`))) group by `petal_db`.`resultatetudiant`.`num`
