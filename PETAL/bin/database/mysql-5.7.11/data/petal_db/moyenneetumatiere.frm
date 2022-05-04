TYPE=VIEW
query=select `resultatetudiant`.`num` AS `num`,`petal_db`.`utilisateur`.`nom` AS `nom`,`petal_db`.`utilisateur`.`prenom` AS `prenom`,`resultatetudiant`.`nomMatiere` AS `nomMatiere`,round((sum(`resultatetudiant`.`moyenne`) / count(`resultatetudiant`.`moyenne`)),2) AS `moyenne` from (`petal_db`.`resultatetudiant` join `petal_db`.`utilisateur` on((`resultatetudiant`.`num` = `petal_db`.`utilisateur`.`num`))) group by `resultatetudiant`.`num`
md5=4fd6088b4e684fc68112f0f39cada61c
updatable=0
algorithm=0
definer_user=root
definer_host=localhost
suid=2
with_check_option=0
timestamp=2022-05-04 15:45:45
create-version=1
source=SELECT num, nom, prenom, nomMatiere, ROUND(SUM(moyenne)/COUNT(moyenne),2) AS moyenne\n    FROM resultatetudiant NATURAL JOIN utilisateur\n    GROUP BY num
client_cs_name=utf8mb4
connection_cl_name=utf8mb4_unicode_ci
view_body_utf8=select `resultatetudiant`.`num` AS `num`,`petal_db`.`utilisateur`.`nom` AS `nom`,`petal_db`.`utilisateur`.`prenom` AS `prenom`,`resultatetudiant`.`nomMatiere` AS `nomMatiere`,round((sum(`resultatetudiant`.`moyenne`) / count(`resultatetudiant`.`moyenne`)),2) AS `moyenne` from (`petal_db`.`resultatetudiant` join `petal_db`.`utilisateur` on((`resultatetudiant`.`num` = `petal_db`.`utilisateur`.`num`))) group by `resultatetudiant`.`num`
